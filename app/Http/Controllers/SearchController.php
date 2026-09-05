<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Tìm kiếm sản phẩm
     */
    public function index(Request $request)
    {
        $keyword = trim($request->input('q', ''));

        $products = Product::query()
            ->with([
                'category',
                'images' => function ($query) {
                    $query
                        ->orderByDesc('is_primary')
                        ->orderBy('sort_order');
                },
            ])
            ->where('status', true)
            ->when($keyword !== '', function ($query) use ($keyword) {

                $query->where(function ($q) use ($keyword) {

                    $q->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere(
                            'description',
                            'like',
                            '%' . $keyword . '%'
                        );
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::query()
            ->where('status', true)
            ->withCount([
                'products' => function ($query) {
                    $query->where('status', true);
                }
            ])
            ->orderBy('name')
            ->get();

        return view(
            'search.index',
            compact(
                'products',
                'categories',
                'keyword'
            )
        );
    }
}
