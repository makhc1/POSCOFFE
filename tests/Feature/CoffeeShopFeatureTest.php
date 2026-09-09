<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoffeeShopFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Test home page loads with 200 OK and contains Gacoan branding.
     */
    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('KOPI');
        $response->assertSee('GACOAN');
        $response->assertSee('Kopi Jagoan Aren Gacoan');
    }

    /**
     * Test menu catalog and search.
     */
    public function test_menu_catalog_and_filtering(): void
    {
        $response = $this->get(route('menu.index'));
        $response->assertStatus(200);
        $response->assertSee('DAFTAR MENU LENGKAP');

        // Test category filter
        $responseCat = $this->get(route('menu.index', ['category' => 'kopi-signature-gacoan']));
        $responseCat->assertStatus(200);

        // Test search
        $responseSearch = $this->get(route('menu.index', ['q' => 'Pangsit']));
        $responseSearch->assertStatus(200);
        $responseSearch->assertSee('Pangsit Goreng');
    }

    /**
     * Test outlets page loads.
     */
    public function test_outlets_page_loads(): void
    {
        $response = $this->get(route('outlets.index'));
        $response->assertStatus(200);
        $response->assertSee('Jakarta Tebet');
    }

    /**
     * Test promo page and voucher API validation.
     */
    public function test_promo_page_and_api_validation(): void
    {
        $response = $this->get(route('promo.index'));
        $response->assertStatus(200);
        $response->assertSee('GACOANHEMAT');

        // Test API validation
        $apiResponse = $this->postJson(route('api.promo.validate'), [
            'code' => 'GACOANHEMAT',
            'subtotal' => 50000,
        ]);

        $apiResponse->assertStatus(200)
            ->assertJson([
                'valid' => true,
                'code' => 'GACOANHEMAT',
            ]);
    }

    /**
     * Test cart lifecycle (add, get, apply voucher, remove).
     */
    public function test_cart_session_flow(): void
    {
        $product = Product::first();

        // 1. Add to cart
        $addResponse = $this->postJson(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 2,
            'sugar_level' => 'Normal (100%)',
            'ice_level' => 'Normal Ice',
            'extra_shots' => 1,
        ]);

        $addResponse->assertStatus(200)->assertJson(['success' => true]);

        // 2. Get cart data
        $getResponse = $this->getJson(route('cart.get'));
        $getResponse->assertStatus(200)
            ->assertJsonPath('total_items', 2);

        // 3. Apply voucher
        $voucherResponse = $this->postJson(route('cart.apply-voucher'), [
            'code' => 'GACOANHEMAT',
        ]);
        $voucherResponse->assertStatus(200);
    }

    /**
     * Test complete checkout and order placement.
     */
    public function test_checkout_and_place_order(): void
    {
        $product = Product::first();
        $outlet = Outlet::first();

        // Add item to cart session first
        $this->postJson(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        // Submit checkout
        $response = $this->post(route('order.place'), [
            'customer_name' => 'Fahri Ramadhan',
            'customer_phone' => '08123456789',
            'customer_email' => 'fahri@example.com',
            'order_type' => 'dine_in',
            'outlet_id' => $outlet->id,
            'table_number' => 'Meja 08',
            'payment_method' => 'qris',
            'notes' => 'Kopi dingin segar',
        ]);

        $this->assertDatabaseHas('orders', [
            'customer_name' => 'Fahri Ramadhan',
            'table_number' => 'Meja 08',
            'payment_method' => 'qris',
        ]);

        $order = Order::where('customer_name', 'Fahri Ramadhan')->first();
        $response->assertRedirect(route('order.success', $order->order_number));

        // Test live tracking page for this order
        $trackResponse = $this->get(route('order.track', $order->order_number));
        $trackResponse->assertStatus(200);
        $trackResponse->assertSee($order->order_number);
    }

    /**
     * Test login and role access.
     */
    public function test_login_and_role_access(): void
    {
        $loginPage = $this->get(route('login'));
        $loginPage->assertStatus(200);
        $loginPage->assertSee('Login Portal Gacoan');

        // Quick login admin
        $adminLogin = $this->get(route('quick-login', 'admin'));
        $adminLogin->assertRedirect(route('admin.dashboard'));

        // Quick login kasir
        $kasirLogin = $this->get(route('quick-login', 'kasir'));
        $kasirLogin->assertRedirect(route('kasir.pos'));
    }

    /**
     * Test Kasir POS counter and order creation.
     */
    public function test_kasir_pos_and_order_transaction(): void
    {
        $kasir = User::where('role', 'kasir')->first();
        $product = Product::first();
        $outlet = Outlet::first();

        $response = $this->actingAs($kasir)->get(route('kasir.pos'));
        $response->assertStatus(200);
        $response->assertSee('Struk Pesanan Kasir');

        // POS Order POST
        $posResponse = $this->actingAs($kasir)->postJson(route('kasir.order.store'), [
            'customer_name' => 'Pelanggan Meja 05',
            'order_type' => 'dine_in',
            'table_number' => 'Meja 05',
            'outlet_id' => $outlet->id,
            'payment_method' => 'cash',
            'cash_received' => 50000,
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 2,
                    'sugar_level' => 'Normal (100%)',
                    'ice_level' => 'Normal Ice',
                    'extra_shots' => 0,
                ],
            ],
        ]);

        $posResponse->assertStatus(200)->assertJson(['success' => true]);
        $this->assertDatabaseHas('orders', [
            'customer_name' => 'Pelanggan Meja 05',
            'table_number' => 'Meja 05',
        ]);
    }

    /**
     * Test admin dashboard and product management.
     */
    public function test_admin_dashboard_and_crud(): void
    {
        $admin = User::where('role', 'admin')->first();

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Ringkasan Penjualan');

        $category = Category::first();

        // Create new menu item
        $createResponse = $this->actingAs($admin)->post(route('admin.products.store'), [
            'category_id' => $category->id,
            'name' => 'Kopi Viral Gacoan Special Test',
            'description' => 'Menu test rasa mantap',
            'price' => 12500,
            'caffeine_level' => 7,
            'spicy_level' => 0,
            'serving_type' => 'both',
        ]);

        $createResponse->assertRedirect(route('admin.products'));
        $this->assertDatabaseHas('products', [
            'name' => 'Kopi Viral Gacoan Special Test',
        ]);
    }
}
