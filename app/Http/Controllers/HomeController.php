<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Danh mục nổi bật
        |--------------------------------------------------------------------------
        */

        $categories = Category::query()
            ->where('status', true)
            ->withCount([
                'products' => function ($query) {
                    $query->where('status', true);
                }
            ])
            ->orderByDesc('products_count')
            ->limit(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Sản phẩm nổi bật
        |--------------------------------------------------------------------------
        */

        $featuredProducts = Product::query()
            ->with([
                'category',
                'images' => function ($query) {
                    $query
                        ->orderByDesc('is_primary')
                        ->orderBy('sort_order');
                },
            ])
            ->where('status', true)
            ->where('featured', true)
            ->latest()
            ->limit(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Sản phẩm mới
        |--------------------------------------------------------------------------
        */

        $latestProducts = Product::query()
            ->with([
                'category',
                'images' => function ($query) {
                    $query
                        ->orderByDesc('is_primary')
                        ->orderBy('sort_order');
                },
            ])
            ->where('status', true)
            ->latest()
            ->limit(8)
            ->get();


        return view(
            'home',
            compact(
                'categories',
                'featuredProducts',
                'latestProducts'
            )
        );
    }
}
