<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Outlet;
use App\Models\PartnershipInquiry;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display Admin Dashboard with metrics and analytics.
     */
    public function dashboard(): View
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');
        $totalProducts = Product::count();
        $totalOutlets = Outlet::count();

        $recentOrders = Order::with(['items.product', 'outlet'])->latest()->take(8)->get();
        $recentInquiries = PartnershipInquiry::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalProducts',
            'totalOutlets',
            'recentOrders',
            'recentInquiries'
        ));
    }

    /**
     * Product list management.
     */
    public function products(): View
    {
        $products = Product::with('category')->latest()->paginate(15);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Create product view.
     */
    public function createProduct(): View
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store new product.
     */
    public function storeProduct(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'image_url' => 'nullable|url',
            'is_best_seller' => 'nullable|boolean',
            'is_spicy_or_bold' => 'nullable|boolean',
            'caffeine_level' => 'required|integer|min:0|max:10',
            'spicy_level' => 'required|integer|min:0|max:8',
            'badge' => 'nullable|string|max:50',
            'serving_type' => 'required|in:iced,hot,both,food',
        ]);

        $validated['slug'] = Str::slug($validated['name']).'-'.Str::random(4);
        $validated['is_best_seller'] = $request->has('is_best_seller');
        $validated['is_spicy_or_bold'] = $request->has('is_spicy_or_bold');
        $validated['is_available'] = true;

        if (empty($validated['image_url'])) {
            $validated['image_url'] = 'https://images.unsplash.com/photo-1541167760496-1628856ab772?auto=format&fit=crop&w=600&q=80';
        }

        Product::create($validated);

        return redirect()->route('admin.products')->with('success', 'Menu baru berhasil ditambahkan!');
    }

    /**
     * Edit product view.
     */
    public function editProduct(Product $product): View
    {
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update product.
     */
    public function updateProduct(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'image_url' => 'nullable|url',
            'is_best_seller' => 'nullable|boolean',
            'is_spicy_or_bold' => 'nullable|boolean',
            'caffeine_level' => 'required|integer|min:0|max:10',
            'spicy_level' => 'required|integer|min:0|max:8',
            'badge' => 'nullable|string|max:50',
            'serving_type' => 'required|in:iced,hot,both,food',
            'is_available' => 'nullable|boolean',
        ]);

        $validated['is_best_seller'] = $request->has('is_best_seller');
        $validated['is_spicy_or_bold'] = $request->has('is_spicy_or_bold');
        $validated['is_available'] = $request->has('is_available');

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Menu berhasil diperbarui!');
    }

    /**
     * Delete product.
     */
    public function destroyProduct(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Menu berhasil dihapus.');
    }

    /**
     * Orders manager.
     */
    public function orders(): View
    {
        $orders = Order::with(['items.product', 'outlet'])->latest()->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Update order status.
     */
    public function updateOrderStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,brewing,ready,completed,cancelled',
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', "Status pesanan #{$order->order_number} berhasil diubah menjadi ".strtoupper($validated['status']));
    }

    /**
     * Outlets manager.
     */
    public function outlets(): View
    {
        $outlets = Outlet::latest()->paginate(15);

        return view('admin.outlets.index', compact('outlets'));
    }

    /**
     * Toggle outlet status.
     */
    public function toggleOutletStatus(Request $request, Outlet $outlet): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:Buka,Ramai,Tutup',
        ]);

        $outlet->update(['status' => $validated['status']]);

        return back()->with('success', "Status outlet {$outlet->name} diperbarui.");
    }
}
