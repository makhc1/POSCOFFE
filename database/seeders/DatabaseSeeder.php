<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@bagelancoffee.com'],
            [
                'name' => 'Admin Manager Bagelan',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Kasir / Barista User
        User::updateOrCreate(
            ['email' => 'kasir@bagelancoffee.com'],
            [
                'name' => 'Kasir Barista 01 (Senopati)',
                'password' => Hash::make('password123'),
                'role' => 'kasir',
                'email_verified_at' => now(),
            ]
        );

        // Categories
        $categoriesData = [
            [
                'name' => 'Signature Arabica Nusantara',
                'slug' => 'signature-arabica-nusantara',
                'icon' => 'coffee',
                'description' => 'Koleksi biji kopi Arabica terbaik dari Sabang sampai Merauke, diseduh untuk menonjolkan aroma dan acidity yang unik.',
                'badge_text' => 'SPECIALTY',
                'sort_order' => 1,
            ],
            [
                'name' => 'Kopi Robusta Klasik',
                'slug' => 'kopi-robusta-klasik',
                'icon' => 'mug-hot',
                'description' => 'Kopi Robusta Indonesia dengan body tebal, rendah acidity, dan sensasi earthy chocolate yang kuat.',
                'badge_text' => 'BOLD',
                'sort_order' => 2,
            ],
            [
                'name' => 'Kopi Susu Gula Aren Asli',
                'slug' => 'kopi-susu-gula-aren-asli',
                'icon' => 'glass-water',
                'description' => 'Kombinasi espresso blend Nusantara dengan kelembutan susu segar dan legitnya gula aren asli nusantara.',
                'badge_text' => 'BEST SELLER',
                'sort_order' => 3,
            ],
            [
                'name' => 'Kudapan Khas Bagelan',
                'slug' => 'kudapan-khas-bagelan',
                'icon' => 'cookie',
                'description' => 'Roti bagelen renyah aneka rasa dan camilan manis pendamping setia secangkir kopi khas Indonesia.',
                'badge_text' => 'WAJIB COBA',
                'sort_order' => 4,
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cData) {
            $categories[$cData['slug']] = Category::updateOrCreate(['slug' => $cData['slug']], $cData);
        }

        // Products
        $products = [
            // Arabica
            [
                'category_id' => $categories['signature-arabica-nusantara']->id,
                'name' => 'Gayo Sumatra (V60 / Espresso)',
                'slug' => 'gayo-sumatra-arabica',
                'description' => 'Kopi Aceh Gayo dengan notes herbal, rempah, dan aroma cokelat gelap yang kuat.',
                'price' => 25000,
                'original_price' => 30000,
                'image_url' => 'https://images.unsplash.com/photo-1559525839-b184a4d698c7?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => false,
                'caffeine_level' => 5,
                'spicy_level' => 0,
                'badge' => '🏆 FAVORIT PENIKMAT',
                'is_available' => true,
                'rating' => 4.9,
                'review_count' => 1240,
                'serving_type' => 'both',
            ],
            [
                'category_id' => $categories['signature-arabica-nusantara']->id,
                'name' => 'Toraja Celebes (Manual Brew)',
                'slug' => 'toraja-celebes-arabica',
                'description' => 'Aroma floral dan fruity dengan sentuhan nutty yang lembut khas tanah Sulawesi.',
                'price' => 28000,
                'original_price' => 35000,
                'image_url' => 'https://images.unsplash.com/photo-1497935586351-b67a49e012bf?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => false,
                'is_spicy_or_bold' => false,
                'caffeine_level' => 4,
                'spicy_level' => 0,
                'badge' => '🌸 FLORAL NOTES',
                'is_available' => true,
                'rating' => 4.8,
                'review_count' => 890,
                'serving_type' => 'hot',
            ],
            [
                'category_id' => $categories['signature-arabica-nusantara']->id,
                'name' => 'Bali Kintamani (Iced / Hot)',
                'slug' => 'bali-kintamani-arabica',
                'description' => 'Sensasi segar dengan hint buah jeruk citrus (orange-like acidity) yang unik dari perkebunan Bali.',
                'price' => 27000,
                'original_price' => 32000,
                'image_url' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => false,
                'caffeine_level' => 4,
                'spicy_level' => 0,
                'badge' => '🍊 CITRUS SENSATION',
                'is_available' => true,
                'rating' => 4.9,
                'review_count' => 1400,
                'serving_type' => 'both',
            ],

            // Robusta
            [
                'category_id' => $categories['kopi-robusta-klasik']->id,
                'name' => 'Lampung Robusta Tubruk',
                'slug' => 'lampung-robusta-tubruk',
                'description' => 'Sajian khas Indonesia, kopi tubruk pekat dari biji robusta Lampung dengan earthy profile yang kuat.',
                'price' => 18000,
                'original_price' => 22000,
                'image_url' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => true,
                'caffeine_level' => 8,
                'spicy_level' => 0,
                'badge' => '💪 PEKAT & KUAT',
                'is_available' => true,
                'rating' => 4.8,
                'review_count' => 1890,
                'serving_type' => 'hot',
            ],
            [
                'category_id' => $categories['kopi-robusta-klasik']->id,
                'name' => 'Java Dampit (Espresso Extra Shot)',
                'slug' => 'java-dampit-espresso',
                'description' => 'Biji Robusta pilihan dari Malang dengan sentuhan rasa caramel, full body, dan aftertaste coklat pekat.',
                'price' => 20000,
                'original_price' => 25000,
                'image_url' => 'https://images.unsplash.com/photo-1517256064527-09c73fc73e38?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => false,
                'is_spicy_or_bold' => true,
                'caffeine_level' => 9,
                'spicy_level' => 0,
                'badge' => '⚡ EXTRA CAFFEINE',
                'is_available' => true,
                'rating' => 4.7,
                'review_count' => 950,
                'serving_type' => 'both',
            ],

            // Kopi Susu
            [
                'category_id' => $categories['kopi-susu-gula-aren-asli']->id,
                'name' => 'Kopi Susu Bagelan Signature',
                'slug' => 'kopi-susu-bagelan-signature',
                'description' => 'Racikan espresso house blend (70% Arabica, 30% Robusta) dengan susu krim dan gula aren organik.',
                'price' => 22000,
                'original_price' => 28000,
                'image_url' => 'https://images.unsplash.com/photo-1577968897966-3d4325b36b61?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => false,
                'caffeine_level' => 5,
                'spicy_level' => 0,
                'badge' => '🥇 MUST TRY',
                'is_available' => true,
                'rating' => 5.0,
                'review_count' => 3120,
                'serving_type' => 'iced',
            ],

            // Kudapan
            [
                'category_id' => $categories['kudapan-khas-bagelan']->id,
                'name' => 'Roti Bagelen Original (Keju & Mentega)',
                'slug' => 'roti-bagelen-original',
                'description' => 'Roti kering renyah legendaris Indonesia yang diolesi mentega melimpah dan taburan keju manis.',
                'price' => 15000,
                'original_price' => 18000,
                'image_url' => 'https://images.unsplash.com/photo-1601000938259-9e92002320b2?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => false,
                'caffeine_level' => 0,
                'spicy_level' => 0,
                'badge' => '🥨 RENYAH GURIH',
                'is_available' => true,
                'rating' => 4.9,
                'review_count' => 2800,
                'serving_type' => 'food',
            ],
            [
                'category_id' => $categories['kudapan-khas-bagelan']->id,
                'name' => 'Roti Bagelen Mocha Cokelat',
                'slug' => 'roti-bagelen-mocha',
                'description' => 'Bagelen panggang dengan olesan krim moka dan taburan meises cokelat premium khas Belanda-Indonesia.',
                'price' => 16000,
                'original_price' => 20000,
                'image_url' => 'https://images.unsplash.com/photo-1541696432-82c6da8ce7bf?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => false,
                'is_spicy_or_bold' => false,
                'caffeine_level' => 0,
                'spicy_level' => 0,
                'badge' => '🍫 MANIS LUMER',
                'is_available' => true,
                'rating' => 4.8,
                'review_count' => 1650,
                'serving_type' => 'food',
            ],
        ];

        foreach ($products as $pData) {
            Product::create($pData);
        }

        // Outlets
        $outlets = [
            [
                'name' => 'Bagelan Coffee - Jakarta Senopati',
                'city' => 'Jakarta Selatan',
                'address' => 'Jl. Senopati No. 45, Kebayoran Baru, Jakarta Selatan',
                'phone' => '0812-1111-2222',
                'operating_hours' => '07:00 - 23:00 WIB',
                'google_maps_url' => 'https://maps.google.com/?q=Senopati+Jakarta',
                'is_24_hours' => false,
                'has_wifi' => true,
                'has_drive_thru' => false,
                'has_outdoor' => true,
                'has_musholla' => true,
                'has_colokan' => true,
                'status' => 'Buka',
                'image_url' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=600&q=80',
            ],
        ];

        foreach ($outlets as $oData) {
            Outlet::create($oData);
        }

        // Promotions & Vouchers
        $promotions = [
            [
                'code' => 'BAGELAN30',
                'title' => 'Diskon 30% Kopi Nusantara',
                'description' => 'Eksplorasi kopi Indonesia dengan potongan 30% minimum transaksi Rp 50.000.',
                'discount_type' => 'percentage',
                'discount_amount' => 30,
                'min_spend' => 50000,
                'max_discount' => 25000,
                'badge_tag' => 'DISKON 30%',
                'banner_gradient' => 'from-[#4E342E] to-[#3E2723]',
                'expires_at' => now()->addDays(30),
                'is_active' => true,
            ],
        ];

        foreach ($promotions as $promo) {
            Promotion::create($promo);
        }

        // Testimonials
        $testimonials = [
            [
                'customer_name' => 'Dimas Ekky',
                'customer_handle' => '@dimas.kopi',
                'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'comment' => 'Kopi tubruk Robustanya bener-bener tebal. Plus bagelen kejunya pas buat temen ngopi.',
                'favorite_menu' => 'Lampung Robusta Tubruk',
                'outlet_name' => 'Bagelan Coffee Senopati',
                'is_featured' => true,
            ],
        ];

        foreach ($testimonials as $tData) {
            Testimonial::create($tData);
        }
    }
}
