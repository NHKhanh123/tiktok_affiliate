<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Danh sách sản phẩm
     */
    public function index(Request $request)
    {
        $query = Product::query()
            ->with([
                'category',
                'images' => function ($query) {
                    $query->orderByDesc('is_primary')
                        ->orderBy('sort_order');
                },
            ])
            ->where('status', true);

        /*
        |--------------------------------------------------------------------------
        | Lọc danh mục
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category')) {

            $query->whereHas('category', function ($q) use ($request) {

                $q->where('slug', $request->category)
                    ->where('status', true);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Sắp xếp
        |--------------------------------------------------------------------------
        */

        switch ($request->get('sort')) {

            case 'price_asc':

                $query->orderByRaw(
                    'COALESCE(sale_price, price) ASC'
                );

                break;

            case 'price_desc':

                $query->orderByRaw(
                    'COALESCE(sale_price, price) DESC'
                );

                break;

            case 'popular':

                $query->orderByDesc('click_count');

                break;

            default:

                $query->latest();

                break;
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $products = $query
            ->paginate(15)
            ->withQueryString();

        return view(
            'products.index',
            compact('products')
        );
    }


    /**
     * Chi tiết sản phẩm
     */
    public function show(Product $product)
    {
        /*
    |--------------------------------------------------------------------------
    | Chỉ cho phép xem sản phẩm đang hoạt động
    |--------------------------------------------------------------------------
    */

        abort_unless($product->status, 404);


        /*
    |--------------------------------------------------------------------------
    | Load dữ liệu sản phẩm
    |--------------------------------------------------------------------------
    */

        $product->load([
            'category',
            'images' => function ($query) {
                $query
                    ->orderByDesc('is_primary')
                    ->orderBy('sort_order');
            },
        ]);


        /*
    |--------------------------------------------------------------------------
    | Kiểm tra Affiliate Link
    |--------------------------------------------------------------------------
    |
    | Lấy link mới nhất của sản phẩm, bất kể đang bật hay tắt.
    | Điều này giúp frontend phân biệt:
    |
    | 1. Chưa từng có Affiliate Link
    | 2. Có Affiliate Link nhưng đã bị tắt
    | 3. Có Affiliate Link đang hoạt động
    |
    */

        $affiliateLink = \App\Models\AffiliateLink::query()
            ->where('product_id', $product->id)
            ->latest('id')
            ->first();


        /*
    |--------------------------------------------------------------------------
    | Xác định trạng thái Affiliate
    |--------------------------------------------------------------------------
    */

        $affiliateStatus = 'none';

        if ($affiliateLink) {

            if (
                $affiliateLink->status &&
                !empty($affiliateLink->affiliate_url)
            ) {

                $affiliateStatus = 'active';
            } elseif (!$affiliateLink->status) {

                $affiliateStatus = 'disabled';
            } else {

                $affiliateStatus = 'invalid';
            }
        }


        /*
    |--------------------------------------------------------------------------
    | Sản phẩm liên quan
    |--------------------------------------------------------------------------
    */

        $relatedProducts = Product::query()
            ->with([
                'category',
                'images' => function ($query) {
                    $query
                        ->orderByDesc('is_primary')
                        ->orderBy('sort_order');
                },
            ])
            ->where('status', true)
            ->where('id', '!=', $product->id)
            ->when(
                $product->category_id,
                function ($query) use ($product) {
                    $query->where(
                        'category_id',
                        $product->category_id
                    );
                }
            )
            ->latest()
            ->limit(8)
            ->get();


        /*
    |--------------------------------------------------------------------------
    | Trả về view
    |--------------------------------------------------------------------------
    */

        return view(
            'products.show',
            compact(
                'product',
                'relatedProducts',
                'affiliateLink',
                'affiliateStatus'
            )
        );
    }


    /**
     * Tìm kiếm
     */
    public function search(Request $request)
    {
        $keyword = trim(
            $request->input('q', '')
        );

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
            ->when(
                $keyword,
                function ($query) use ($keyword) {

                    $query->where(function ($q) use ($keyword) {

                        $q->where(
                            'name',
                            'like',
                            '%' . $keyword . '%'
                        );

                        $q->orWhere(
                            'description',
                            'like',
                            '%' . $keyword . '%'
                        );
                    });
                }
            )
            ->latest()
            ->paginate(24)
            ->withQueryString();

        return view(
            'products.search',
            compact(
                'products',
                'keyword'
            )
        );
    }
}
