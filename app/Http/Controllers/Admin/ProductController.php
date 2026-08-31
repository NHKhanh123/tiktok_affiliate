<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Danh sách sản phẩm
     */
    public function index(Request $request)
    {
        $query = Product::with('category');


        /*
        |--------------------------------------------------------------------------
        | Tìm kiếm
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere(
                        'tiktok_product_id',
                        'like',
                        '%' . $search . '%'
                    );
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Lọc danh mục
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category_id')) {

            $query->where(
                'category_id',
                $request->category_id
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Lọc trạng thái
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Sản phẩm nổi bật
        |--------------------------------------------------------------------------
        */

        if ($request->filled('featured')) {

            $query->where(
                'featured',
                $request->featured
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Danh sách
        |--------------------------------------------------------------------------
        */

        $products = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        $categories = Category::orderBy('name')->get();


        /*
        |--------------------------------------------------------------------------
        | Thống kê
        |--------------------------------------------------------------------------
        */

        $totalProducts = Product::count();

        $activeProducts = Product::where(
            'status',
            true
        )->count();

        $featuredProducts = Product::where(
            'featured',
            true
        )->count();


        return view(
            'admin.products.index',
            compact(
                'products',
                'categories',
                'totalProducts',
                'activeProducts',
                'featuredProducts'
            )
        );
    }


    /**
     * Form tạo sản phẩm
     */
    public function create()
    {
        $categories = Category::where(
            'status',
            true
        )
            ->orderBy('name')
            ->get();


        return view(
            'admin.products.create',
            compact('categories')
        );
    }


    /**
     * Lưu sản phẩm
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'category_id' => [
                'nullable',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:products,name',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:products,slug',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'sale_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'tiktok_product_id' => [
                'nullable',
                'string',
                'max:255',
            ],

            'tiktok_shop_id' => [
                'nullable',
                'string',
                'max:255',
            ],

            'tiktok_url' => [
                'nullable',
                'url',
                'max:1000',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'featured' => [
                'nullable',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        $validated['slug'] = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);


        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        $validated['status'] = $request->boolean(
            'status'
        );


        /*
        |--------------------------------------------------------------------------
        | Featured
        |--------------------------------------------------------------------------
        */

        $validated['featured'] = $request->boolean(
            'featured'
        );


        /*
        |--------------------------------------------------------------------------
        | Click mặc định
        |--------------------------------------------------------------------------
        */

        $validated['click_count'] = 0;


        Product::create($validated);


        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Thêm sản phẩm thành công.'
            );
    }


    /**
     * Chi tiết sản phẩm
     */
    public function show(Product $product)
    {
        $product->load('category');


        return view(
            'admin.products.show',
            compact('product')
        );
    }


    /**
     * Form chỉnh sửa
     */
    public function edit(Product $product)
    {
        $categories = Category::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.products.edit',
            compact(
                'product',
                'categories'
            )
        );
    }


    /**
     * Cập nhật sản phẩm
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => [
                'nullable',
                'exists:categories,id',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'featured' => [
                'nullable',
                'boolean',
            ],
        ]);

        $product->update([
            'category_id' => $validated['category_id'] ?? null,

            'status' => $request->boolean('status'),

            'featured' => $request->boolean('featured'),
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Cập nhật thông tin sản phẩm thành công.'
            );
    }


    /**
     * Xóa sản phẩm
     */
    public function destroy(Product $product)
    {
        $product->delete();


        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Xóa sản phẩm thành công.'
            );
    }
}
