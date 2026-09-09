<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display the full menu catalog.
     */
    public function index(Request $request): View
    {
        $selectedCategorySlug = $request->query('category');
        $search = $request->query('q');
        $level = $request->query('level'); // all, mild, hot, setan

        $categories = Category::withCount('products')->orderBy('sort_order', 'asc')->get();

        $query = Product::with('category')->where('is_available', true);

        if ($selectedCategorySlug) {
            $query->whereHas('category', function ($q) use ($selectedCategorySlug) {
                $q->where('slug', $selectedCategorySlug);
            });
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($level) {
            if ($level === 'setan') {
                $query->where(function ($q) {
                    $q->where('caffeine_level', '>=', 9)->orWhere('spicy_level', '>=', 6);
                });
            } elseif ($level === 'hot') {
                $query->where(function ($q) {
                    $q->whereBetween('caffeine_level', [6, 8])->orWhereBetween('spicy_level', [3, 5]);
                });
            } elseif ($level === 'mild') {
                $query->where(function ($q) {
                    $q->whereBetween('caffeine_level', [1, 5])->orWhere('spicy_level', '<=', 2);
                });
            }
        }

        $products = $query->orderBy('is_best_seller', 'desc')
            ->orderBy('id', 'asc')
            ->paginate(12)
            ->withQueryString();

        $currentCategory = $selectedCategorySlug ? Category::where('slug', $selectedCategorySlug)->first() : null;

        return view('menu.index', compact(
            'products',
            'categories',
            'currentCategory',
            'selectedCategorySlug',
            'search',
            'level'
        ));
    }

    /**
     * Display single product detail.
     */
    public function show(string $slug): View
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('menu.show', compact('product', 'relatedProducts'));
    }

    /**
     * Get product detail as JSON for quick modal view.
     */
    public function apiDetail(int $id): JsonResponse
    {
        $product = Product::with('category')->findOrFail($id);

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'category_name' => $product->category->name,
            'description' => $product->description,
            'price' => (float) $product->price,
            'formatted_price' => $product->formatted_price,
            'original_price' => $product->original_price ? (float) $product->original_price : null,
            'formatted_original_price' => $product->formatted_original_price,
            'image_url' => $product->image_url,
            'badge' => $product->badge,
            'caffeine_level' => $product->caffeine_level,
            'spicy_level' => $product->spicy_level,
            'level_name' => $product->level_name,
            'rating' => $product->rating,
            'review_count' => $product->review_count,
            'serving_type' => $product->serving_type,
        ]);
    }
}
