<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
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
            ['email' => 'admin@kopigacoan.com'],
            [
                'name' => 'Admin Manager Gacoan',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Kasir / Barista User
        User::updateOrCreate(
            ['email' => 'kasir@kopigacoan.com'],
            [
                'name' => 'Kasir Barista 01 (Tebet)',
                'password' => Hash::make('password123'),
                'role' => 'kasir',
                'email_verified_at' => now(),
            ]
        );

        // Categories
        $categoriesData = [
            [
                'name' => 'Kopi Signature Gacoan',
                'slug' => 'kopi-signature-gacoan',
                'icon' => 'flame',
                'description' => 'Kopi racikan khas dengan sensasi espresso nendang dan sentuhan level pedas/manis yang bikin melek seharian.',
                'badge_text' => 'WAJIB COBA',
                'sort_order' => 1,
            ],
            [
                'name' => 'Kopi Dingin Manja',
                'slug' => 'kopi-dingin-manja',
                'icon' => 'coffee',
                'description' => 'Varian iced coffee creamy, manis legit, dan dingin segar yang cocok buat nemenin nongkrong santai.',
                'badge_text' => 'BEST SELLER',
                'sort_order' => 2,
            ],
            [
                'name' => 'Dimsum & Kudapan Gacoan',
                'slug' => 'dimsum-kudapan-gacoan',
                'icon' => 'utensils',
                'description' => 'Camilan viral pendamping kopi paling juara: Pangsit crispy, Udang Keju lumer, hingga Siomay juicy.',
                'badge_text' => 'GURIH LUMER',
                'sort_order' => 3,
            ],
            [
                'name' => 'Minuman Es Setan Segar',
                'slug' => 'minuman-es-setan-segar',
                'icon' => 'sparkles',
                'description' => 'Minuman non-coffee buah segar, mocktail bersoda, dan racikan sirup tropical yang bikin segar seketika.',
                'badge_text' => 'SEGAR DINGIN',
                'sort_order' => 4,
            ],
            [
                'name' => 'Makanan Utama & Toast',
                'slug' => 'makanan-utama-toast',
                'icon' => 'bowl-food',
                'description' => 'Porsi kenyang harga hemat: Mie pedas khas, Rice bowl geprek, dan Toast tebal topping melimpah.',
                'badge_text' => 'SUPER KENYANG',
                'sort_order' => 5,
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cData) {
            $categories[$cData['slug']] = Category::create($cData);
        }

        // Products
        $products = [
            // Kopi Signature
            [
                'category_id' => $categories['kopi-signature-gacoan']->id,
                'name' => 'Kopi Jagoan Gacoan (Signature Aren)',
                'slug' => 'kopi-jagoan-gacoan-signature-aren',
                'description' => 'Perpaduan double shot espresso arabika robusta pilihan, gula aren murni organik, dan susu fresh milk creamy gurih.',
                'price' => 11500,
                'original_price' => 15000,
                'image_url' => 'https://images.unsplash.com/photo-1541167760496-1628856ab772?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => true,
                'caffeine_level' => 6,
                'spicy_level' => 0,
                'badge' => '🔥 NO.1 BEST SELLER',
                'is_available' => true,
                'rating' => 4.9,
                'review_count' => 1420,
                'serving_type' => 'both',
            ],
            [
                'category_id' => $categories['kopi-signature-gacoan']->id,
                'name' => 'Kopi Iblis Espresso Spicy Caramel',
                'slug' => 'kopi-iblis-espresso-spicy-caramel',
                'description' => 'Sensasi unik pertama di Indonesia! Espresso pekat dengan saus salted caramel dan hint ekstrak cabai hangat yang menggelitik lidah.',
                'price' => 13500,
                'original_price' => 17000,
                'image_url' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => true,
                'caffeine_level' => 8,
                'spicy_level' => 4,
                'badge' => '🌶️ SENSASI PEDAS GACOAN',
                'is_available' => true,
                'rating' => 4.8,
                'review_count' => 890,
                'serving_type' => 'iced',
            ],
            [
                'category_id' => $categories['kopi-signature-gacoan']->id,
                'name' => 'Kopi Hompimpa Vanilla Latte',
                'slug' => 'kopi-hompimpa-vanilla-latte',
                'description' => 'Caffe latte dengan foam susu lembut, sirup french vanilla wangi, dan aroma kopi yang ramah di lambung.',
                'price' => 14000,
                'original_price' => 18000,
                'image_url' => 'https://images.unsplash.com/photo-1572442388796-11668ba69e54?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => false,
                'is_spicy_or_bold' => false,
                'caffeine_level' => 4,
                'spicy_level' => 0,
                'badge' => '☕ COCOK BUAT NUGAS',
                'is_available' => true,
                'rating' => 4.9,
                'review_count' => 650,
                'serving_type' => 'both',
            ],
            [
                'category_id' => $categories['kopi-signature-gacoan']->id,
                'name' => 'Kopi Setan Extra Triple Shot',
                'slug' => 'kopi-setan-extra-triple-shot',
                'description' => 'Buat kamu yang butuh melek full 24 jam! 3 shot ristretto dark roast pekat dengan sentuhan dark cocoa pekat.',
                'price' => 15000,
                'original_price' => 19000,
                'image_url' => 'https://images.unsplash.com/photo-1517256064527-09c73fc73e38?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => true,
                'caffeine_level' => 10,
                'spicy_level' => 0,
                'badge' => '⚡ LEVEL SETAN 10/10',
                'is_available' => true,
                'rating' => 4.9,
                'review_count' => 1120,
                'serving_type' => 'both',
            ],

            // Kopi Dingin Manja
            [
                'category_id' => $categories['kopi-dingin-manja']->id,
                'name' => 'Kopi Susu Regal Manja',
                'slug' => 'kopi-susu-regal-manja',
                'description' => 'Iced coffee susu manis legit dengan topping biskuit Marie Regal melimpah yang renyah dan gurih.',
                'price' => 15500,
                'original_price' => 20000,
                'image_url' => 'https://images.unsplash.com/photo-1577968897966-3d4325b36b61?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => false,
                'caffeine_level' => 3,
                'spicy_level' => 0,
                'badge' => '🍪 TOPPING REGAL MELIMPAH',
                'is_available' => true,
                'rating' => 4.9,
                'review_count' => 1780,
                'serving_type' => 'iced',
            ],
            [
                'category_id' => $categories['kopi-dingin-manja']->id,
                'name' => 'Avocado Coffee Float',
                'slug' => 'avocado-coffee-float',
                'description' => 'Jus alpukat mentega kental asli berpadu dengan espresso arabika dan satu scoop es krim vanila lembut.',
                'price' => 18000,
                'original_price' => 23000,
                'image_url' => 'https://images.unsplash.com/photo-1579954115545-a95591f28bfc?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => false,
                'caffeine_level' => 3,
                'spicy_level' => 0,
                'badge' => '🥑 ALPUKAT ASLI + ICE CREAM',
                'is_available' => true,
                'rating' => 4.9,
                'review_count' => 930,
                'serving_type' => 'iced',
            ],
            [
                'category_id' => $categories['kopi-dingin-manja']->id,
                'name' => 'Matcha Espresso Duo Gacoan',
                'slug' => 'matcha-espresso-duo-gacoan',
                'description' => 'Gradasi warna cantik: Pure Uji Green Tea matcha dipadukan dengan single shot espresso dan susu segar dingin.',
                'price' => 17500,
                'original_price' => 22000,
                'image_url' => 'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => false,
                'is_spicy_or_bold' => false,
                'caffeine_level' => 5,
                'spicy_level' => 0,
                'badge' => '🍵 VIRAL TIKTOK',
                'is_available' => true,
                'rating' => 4.8,
                'review_count' => 540,
                'serving_type' => 'iced',
            ],
            [
                'category_id' => $categories['kopi-dingin-manja']->id,
                'name' => 'Salted Caramel Creamy Cold Brew',
                'slug' => 'salted-caramel-creamy-cold-brew',
                'description' => 'Kopi cold brew diekstraksi 16 jam, disajikan dengan sea salt cloud foam gurih dan saus karamel lumer.',
                'price' => 16500,
                'original_price' => 21000,
                'image_url' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => false,
                'is_spicy_or_bold' => false,
                'caffeine_level' => 7,
                'spicy_level' => 0,
                'badge' => '✨ PREMIUM FOAM',
                'is_available' => true,
                'rating' => 4.8,
                'review_count' => 410,
                'serving_type' => 'iced',
            ],

            // Dimsum & Kudapan Gacoan
            [
                'category_id' => $categories['dimsum-kudapan-gacoan']->id,
                'name' => 'Pangsit Goreng Crispy Gacoan (Isi 4)',
                'slug' => 'pangsit-goreng-crispy-gacoan',
                'description' => 'Pangsit goreng jumbo legendaris super renyah dengan isian daging ayam cincang gurih plus saus asam manis pedas.',
                'price' => 10500,
                'original_price' => 14000,
                'image_url' => 'https://images.unsplash.com/photo-1541696432-82c6da8ce7bf?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => true,
                'caffeine_level' => 0,
                'spicy_level' => 2,
                'badge' => '🥟 WAJIB PESAN BARENG KOPI',
                'is_available' => true,
                'rating' => 5.0,
                'review_count' => 3450,
                'serving_type' => 'food',
            ],
            [
                'category_id' => $categories['dimsum-kudapan-gacoan']->id,
                'name' => 'Udang Keju Lumer Crispy (Isi 3)',
                'slug' => 'udang-keju-lumer-crispy',
                'description' => 'Bola udang cincang berbalut tepung roti emas renyah dengan lelehan keju mozzarella molor di dalamnya.',
                'price' => 12500,
                'original_price' => 16000,
                'image_url' => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => false,
                'caffeine_level' => 0,
                'spicy_level' => 0,
                'badge' => '🧀 KEJU MOLOR BANGET',
                'is_available' => true,
                'rating' => 5.0,
                'review_count' => 2890,
                'serving_type' => 'food',
            ],
            [
                'category_id' => $categories['dimsum-kudapan-gacoan']->id,
                'name' => 'Udang Rambutan Gurih Renyah (Isi 3)',
                'slug' => 'udang-rambutan-gurih-renyah',
                'description' => 'Adonan udang dan ayam lembut dibalut serabut pangsit renyah mirip buah rambutan. Kress di luar, lembut di dalam!',
                'price' => 12500,
                'original_price' => 16000,
                'image_url' => 'https://images.unsplash.com/photo-1496116218417-1a781b1c416c?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => false,
                'caffeine_level' => 0,
                'spicy_level' => 0,
                'badge' => '🍤 EXTRA CRUNCHY',
                'is_available' => true,
                'rating' => 4.9,
                'review_count' => 1950,
                'serving_type' => 'food',
            ],
            [
                'category_id' => $categories['dimsum-kudapan-gacoan']->id,
                'name' => 'Siomay Ayam Chili Oil (Isi 4)',
                'slug' => 'siomay-ayam-chili-oil',
                'description' => 'Siomay kukus hangat dari daging paha ayam segar bertekstur kenyal, disiram chili garlic oil wangi gurih.',
                'price' => 11000,
                'original_price' => 15000,
                'image_url' => 'https://images.unsplash.com/photo-1563245372-f21724e3856d?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => false,
                'is_spicy_or_bold' => true,
                'caffeine_level' => 0,
                'spicy_level' => 3,
                'badge' => '🌶️ AROMA CHILI OIL',
                'is_available' => true,
                'rating' => 4.8,
                'review_count' => 1400,
                'serving_type' => 'food',
            ],

            // Minuman Es Setan Segar
            [
                'category_id' => $categories['minuman-es-setan-segar']->id,
                'name' => 'Es Genderuwo Fresh Tropical Soda',
                'slug' => 'es-genderuwo-fresh-tropical-soda',
                'description' => 'Minuman signature pelepas dahaga: sirup melon manis dingin, sparkling soda, selasih, dan jelly kenyal.',
                'price' => 10000,
                'original_price' => 13000,
                'image_url' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => false,
                'caffeine_level' => 0,
                'spicy_level' => 0,
                'badge' => '🍹 SEGAR MAKSIMAL',
                'is_available' => true,
                'rating' => 4.9,
                'review_count' => 2100,
                'serving_type' => 'iced',
            ],
            [
                'category_id' => $categories['minuman-es-setan-segar']->id,
                'name' => 'Es Pocong Strawberry Yakult Burst',
                'slug' => 'es-pocong-strawberry-yakult-burst',
                'description' => 'Kombinasi asam manis strawberry asli dengan fermentasi susu Yakult dingin dan popping boba pecah di mulut.',
                'price' => 11500,
                'original_price' => 15000,
                'image_url' => 'https://images.unsplash.com/photo-1556881286-fc6915169721?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => false,
                'caffeine_level' => 0,
                'spicy_level' => 0,
                'badge' => '🍓 YAKULT & POPPING BOBA',
                'is_available' => true,
                'rating' => 4.9,
                'review_count' => 1650,
                'serving_type' => 'iced',
            ],
            [
                'category_id' => $categories['minuman-es-setan-segar']->id,
                'name' => 'Es Tuyul Lychee Coconut Mojito',
                'slug' => 'es-tuyul-lychee-coconut-mojito',
                'description' => 'Air kelapa murni dipadukan dengan buah leci segar utuh, daun mint wangi, dan perasan jeruk nipis.',
                'price' => 11000,
                'original_price' => 14000,
                'image_url' => 'https://images.unsplash.com/photo-1536935338788-846bb9981813?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => false,
                'is_spicy_or_bold' => false,
                'caffeine_level' => 0,
                'spicy_level' => 0,
                'badge' => '🥥 KELAPA & BUAH LECI',
                'is_available' => true,
                'rating' => 4.8,
                'review_count' => 870,
                'serving_type' => 'iced',
            ],

            // Makanan Utama & Toast
            [
                'category_id' => $categories['makanan-utama-toast']->id,
                'name' => 'Mie Pedas Kopi Gacoan Level 1 - 8',
                'slug' => 'mie-pedas-kopi-gacoan-level-1-8',
                'description' => 'Mie kenyal gurih bumbu pedas cabai asli dengan taburan ayam cincang melimpah, daun bawang, dan 2 pcs pangsit goreng.',
                'price' => 11500,
                'original_price' => 15000,
                'image_url' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => true,
                'caffeine_level' => 0,
                'spicy_level' => 6,
                'badge' => '🔥 LEGENDARIS GACOAN',
                'is_available' => true,
                'rating' => 5.0,
                'review_count' => 4900,
                'serving_type' => 'food',
            ],
            [
                'category_id' => $categories['makanan-utama-toast']->id,
                'name' => 'Gacoan Spicy Beef & Cheese Toast',
                'slug' => 'gacoan-spicy-beef-cheese-toast',
                'description' => 'Roti brioche bakar mentega tebal dengan isian smoked beef gurih, melted cheddar cheese, telur orak-arik, dan saus pedas manis.',
                'price' => 16000,
                'original_price' => 21000,
                'image_url' => 'https://images.unsplash.com/photo-1525351484163-7529414344d8?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => true,
                'is_spicy_or_bold' => true,
                'caffeine_level' => 0,
                'spicy_level' => 2,
                'badge' => '🥪 TOAST TEBAL JUICY',
                'is_available' => true,
                'rating' => 4.9,
                'review_count' => 1150,
                'serving_type' => 'food',
            ],
            [
                'category_id' => $categories['makanan-utama-toast']->id,
                'name' => 'Rice Bowl Ayam Crispy Sambal Matah',
                'slug' => 'rice-bowl-ayam-crispy-sambal-matah',
                'description' => 'Nasi pulen hangat dengan potongan ayam popcorn renyah melimpah disiram sambal matah serai bali segar pedas gurih.',
                'price' => 18500,
                'original_price' => 24000,
                'image_url' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80',
                'is_best_seller' => false,
                'is_spicy_or_bold' => true,
                'caffeine_level' => 0,
                'spicy_level' => 5,
                'badge' => '🍛 SAMBAL MATAH SEGAR',
                'is_available' => true,
                'rating' => 4.8,
                'review_count' => 780,
                'serving_type' => 'food',
            ],
        ];

        foreach ($products as $pData) {
            Product::create($pData);
        }

        // Outlets
        $outlets = [
            [
                'name' => 'Kopi Gacoan - Jakarta Tebet',
                'city' => 'Jakarta Selatan',
                'address' => 'Jl. Tebet Raya No. 45, Tebet Timur, Jakarta Selatan',
                'phone' => '0812-3456-7890',
                'operating_hours' => '24 Jam Nonstop',
                'google_maps_url' => 'https://maps.google.com/?q=Tebet+Jakarta',
                'is_24_hours' => true,
                'has_wifi' => true,
                'has_drive_thru' => true,
                'has_outdoor' => true,
                'has_musholla' => true,
                'has_colokan' => true,
                'status' => 'Buka',
                'image_url' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => 'Kopi Gacoan - Bandung Dago',
                'city' => 'Bandung',
                'address' => 'Jl. Ir. H. Juanda No. 108, Dago Atas, Bandung',
                'phone' => '0812-3456-7891',
                'operating_hours' => '08:00 - 02:00 WIB',
                'google_maps_url' => 'https://maps.google.com/?q=Dago+Bandung',
                'is_24_hours' => false,
                'has_wifi' => true,
                'has_drive_thru' => false,
                'has_outdoor' => true,
                'has_musholla' => true,
                'has_colokan' => true,
                'status' => 'Buka',
                'image_url' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => 'Kopi Gacoan - Surabaya Gubeng',
                'city' => 'Surabaya',
                'address' => 'Jl. Raya Gubeng No. 62, Gubeng, Surabaya',
                'phone' => '0812-3456-7892',
                'operating_hours' => '24 Jam Nonstop',
                'google_maps_url' => 'https://maps.google.com/?q=Gubeng+Surabaya',
                'is_24_hours' => true,
                'has_wifi' => true,
                'has_drive_thru' => true,
                'has_outdoor' => true,
                'has_musholla' => true,
                'has_colokan' => true,
                'status' => 'Buka',
                'image_url' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => 'Kopi Gacoan - Yogyakarta Kaliurang',
                'city' => 'Yogyakarta',
                'address' => 'Jl. Kaliurang KM 5.5 No. 28, Sleman, DI Yogyakarta',
                'phone' => '0812-3456-7893',
                'operating_hours' => '24 Jam Nonstop',
                'google_maps_url' => 'https://maps.google.com/?q=Kaliurang+Yogyakarta',
                'is_24_hours' => true,
                'has_wifi' => true,
                'has_drive_thru' => false,
                'has_outdoor' => true,
                'has_musholla' => true,
                'has_colokan' => true,
                'status' => 'Buka',
                'image_url' => 'https://images.unsplash.com/photo-1559925393-8be0ec4767c8?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => 'Kopi Gacoan - Malang Suhat (Soekarno Hatta)',
                'city' => 'Malang',
                'address' => 'Jl. Soekarno Hatta No. 88, Lowokwaru, Kota Malang',
                'phone' => '0812-3456-7894',
                'operating_hours' => '08:00 - 01:00 WIB',
                'google_maps_url' => 'https://maps.google.com/?q=Soekarno+Hatta+Malang',
                'is_24_hours' => false,
                'has_wifi' => true,
                'has_drive_thru' => false,
                'has_outdoor' => true,
                'has_musholla' => true,
                'has_colokan' => true,
                'status' => 'Buka',
                'image_url' => 'https://images.unsplash.com/photo-1600093463592-8e36ae95ef56?auto=format&fit=crop&w=600&q=80',
            ],
            [
                'name' => 'Kopi Gacoan - Bali Sunset Road',
                'city' => 'Bali / Denpasar',
                'address' => 'Jl. Sunset Road No. 168, Kuta, Badung, Bali',
                'phone' => '0812-3456-7895',
                'operating_hours' => '24 Jam Nonstop',
                'google_maps_url' => 'https://maps.google.com/?q=Sunset+Road+Bali',
                'is_24_hours' => true,
                'has_wifi' => true,
                'has_drive_thru' => true,
                'has_outdoor' => true,
                'has_musholla' => true,
                'has_colokan' => true,
                'status' => 'Buka',
                'image_url' => 'https://images.unsplash.com/photo-1521017432531-fbd92d768814?auto=format&fit=crop&w=600&q=80',
            ],
        ];

        foreach ($outlets as $oData) {
            Outlet::create($oData);
        }

        // Promotions & Vouchers
        $promotions = [
            [
                'code' => 'GACOANHEMAT',
                'title' => 'Diskon 30% Spesial Menu Signature Kopi',
                'description' => 'Makin hemat nongkrong dengan potongan 30% untuk semua menu kopi dengan minimum transaksi Rp 30.000.',
                'discount_type' => 'percentage',
                'discount_amount' => 30,
                'min_spend' => 30000,
                'max_discount' => 15000,
                'badge_tag' => 'DISKON 30%',
                'banner_gradient' => 'from-[#FF2E63] to-[#FF9900]',
                'expires_at' => now()->addDays(30),
                'is_active' => true,
            ],
            [
                'code' => 'KOPIJAGOAN20',
                'title' => 'Cashback Kilat Rp 10.000 Serbu Gajian',
                'description' => 'Potongan langsung Rp 10.000 untuk pembelian combo Kopi Jagoan + Pangsit Goreng Crispy.',
                'discount_type' => 'fixed',
                'discount_amount' => 10000,
                'min_spend' => 25000,
                'max_discount' => 10000,
                'badge_tag' => 'POTONGAN RP 10.000',
                'banner_gradient' => 'from-[#FF9900] to-[#FFDE59]',
                'expires_at' => now()->addDays(15),
                'is_active' => true,
            ],
            [
                'code' => 'NONGRONGSERU',
                'title' => 'Diskon 50% Khusus Pelajar & Mahasiswa',
                'description' => 'Promo nugas asik di outlet Gacoan! Diskon 50% untuk minuman kedua setiap hari Senin - Jumat.',
                'discount_type' => 'percentage',
                'discount_amount' => 50,
                'min_spend' => 40000,
                'max_discount' => 20000,
                'badge_tag' => 'PROMO PELAJAR',
                'banner_gradient' => 'from-[#9B51E0] to-[#FF2E63]',
                'expires_at' => now()->addDays(60),
                'is_active' => true,
            ],
        ];

        foreach ($promotions as $promo) {
            Promotion::create($promo);
        }

        // Testimonials
        $testimonials = [
            [
                'customer_name' => 'Rian Ardiansyah',
                'customer_handle' => '@rian.ngopi',
                'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'comment' => 'Kopi Jagoan beneran ga ada lawan! Murah banget cuma 11 ribuan tapi rasanya bintang lima, creamy arennya pas. Plus pangsit gorengnya wajib pesen 2 porsi!',
                'favorite_menu' => 'Kopi Jagoan + Pangsit Crispy',
                'outlet_name' => 'Kopi Gacoan Tebet',
                'is_featured' => true,
            ],
            [
                'customer_name' => 'Nabila Putri S.',
                'customer_handle' => '@nabilafnb',
                'avatar_url' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'comment' => 'Tempat nugas paling juara di Jogja. Colokan di setiap meja, AC dingin, Wi-Fi kencang, dan buka 24 jam! Udang keju lumernya juara dunia.',
                'favorite_menu' => 'Udang Keju + Kopi Hompimpa',
                'outlet_name' => 'Kopi Gacoan Kaliurang',
                'is_featured' => true,
            ],
            [
                'customer_name' => 'Dimas Pratama',
                'customer_handle' => '@dimas_foodie',
                'avatar_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'comment' => 'Sensasi Kopi Iblis Spicy Caramel bener-bener nagih! Ada anget-anget pedas di tenggorokan tapi manis gurih. Gokil inovasinya!',
                'favorite_menu' => 'Kopi Iblis Espresso Spicy',
                'outlet_name' => 'Kopi Gacoan Dago',
                'is_featured' => true,
            ],
            [
                'customer_name' => 'Sarah Amanda',
                'customer_handle' => '@sarahmanda',
                'avatar_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'comment' => 'Es Pocong Yakult dan Mie Pedas Level 4 combo maut pas pulang ngantor. Murah meriah, pelayanan cepat!',
                'favorite_menu' => 'Es Pocong + Mie Pedas Level 4',
                'outlet_name' => 'Kopi Gacoan Gubeng',
                'is_featured' => true,
            ],
        ];

        foreach ($testimonials as $tData) {
            Testimonial::create($tData);
        }

        // Demo sample live orders for tracking demonstration
        $firstOutlet = Outlet::first();
        $sampleProduct1 = Product::first();
        $sampleProduct2 = Product::where('id', '>', 1)->first();

        $demoOrder = Order::create([
            'order_number' => 'GC-'.date('Ymd').'-8899',
            'customer_name' => 'Budi Santoso',
            'customer_phone' => '081298765432',
            'customer_email' => 'budi@example.com',
            'order_type' => 'dine_in',
            'table_number' => 'Meja 12 (Outdoor)',
            'outlet_id' => $firstOutlet?->id,
            'subtotal' => 24000,
            'discount_amount' => 7200,
            'tax_amount' => 1680,
            'total_amount' => 18480,
            'voucher_code' => 'GACOANHEMAT',
            'status' => 'brewing',
            'payment_method' => 'qris',
            'payment_status' => 'paid',
            'notes' => 'Kopi less sugar, es batu normal ya min.',
        ]);

        if ($sampleProduct1) {
            $demoOrder->items()->create([
                'product_id' => $sampleProduct1->id,
                'quantity' => 1,
                'unit_price' => $sampleProduct1->price,
                'sugar_level' => 'Less Sugar (50%)',
                'ice_level' => 'Normal Ice',
                'extra_shots' => 0,
                'spicy_level' => 0,
                'notes' => 'Dingin segar',
                'subtotal' => $sampleProduct1->price,
            ]);
        }

        if ($sampleProduct2) {
            $demoOrder->items()->create([
                'product_id' => $sampleProduct2->id,
                'quantity' => 1,
                'unit_price' => $sampleProduct2->price,
                'sugar_level' => 'Normal (100%)',
                'ice_level' => 'Normal Ice',
                'extra_shots' => 1,
                'spicy_level' => 4,
                'notes' => 'Extra 1 shot',
                'subtotal' => $sampleProduct2->price,
            ]);
        }
    }
}
