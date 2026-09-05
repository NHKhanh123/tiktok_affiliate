<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Danh sách danh mục
     */
    public function index()
    {
        $categories = Category::query()
            ->where('status', true)
            ->withCount([
                'products' => function ($query) {
                    $query->where('status', true);
                }
            ])
            ->orderBy('name')
            ->paginate(12);

        return view(
            'categories.index',
            compact('categories')
        );
    }

    /**
     * Sản phẩm theo danh mục
     */
    public function show(Category $category)
    {
        abort_unless($category->status, 404);

        $products = Product::query()
            ->with([
                'category',
                'images' => function ($query) {
                    $query
                        ->orderByDesc('is_primary')
                        ->orderBy('sort_order');
                },
            ])
            ->where('category_id', $category->id)
            ->where('status', true)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view(
            'categories.show',
            compact(
                'category',
                'products'
            )
        );
    }
}
