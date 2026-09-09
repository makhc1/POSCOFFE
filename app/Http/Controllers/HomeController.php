<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Display the energetic landing page.
     */
    public function index(): View
    {
        $categories = Category::with(['products' => function ($q) {
            $q->where('is_available', true)->take(8);
        }])->orderBy('sort_order', 'asc')->get();

        $bestSellers = Product::with('category')
            ->where('is_available', true)
            ->where('is_best_seller', true)
            ->take(6)
            ->get();

        $promotions = Promotion::where('is_active', true)
            ->orderBy('id', 'asc')
            ->take(3)
            ->get();

        $outlets = Outlet::orderBy('city', 'asc')->take(6)->get();
        $cities = Outlet::select('city')->distinct()->pluck('city');
        $testimonials = Testimonial::where('is_featured', true)->take(4)->get();

        return view('home', compact(
            'categories',
            'bestSellers',
            'promotions',
            'outlets',
            'cities',
            'testimonials'
        ));
    }
}
