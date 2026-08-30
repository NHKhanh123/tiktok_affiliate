<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Danh sách danh mục
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view(
            'admin.categories.index',
            compact('categories')
        );
    }


    /**
     * Form tạo danh mục
     */
    public function create()
    {
        return view('admin.categories.create');
    }


    /**
     * Lưu danh mục
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:categories,name',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:categories,slug',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Tạo slug
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

        $validated['status'] = $request->boolean('status');


        /*
        |--------------------------------------------------------------------------
        | Upload hình ảnh
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $validated['image'] = $request
                ->file('image')
                ->store('categories', 'public');
        }


        Category::create($validated);


        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Thêm danh mục thành công.'
            );
    }


    /**
     * Hiển thị chi tiết
     */
    public function show(Category $category)
    {
        return view(
            'admin.categories.show',
            compact('category')
        );
    }


    /**
     * Form chỉnh sửa
     */
    public function edit(Category $category)
    {
        return view(
            'admin.categories.edit',
            compact('category')
        );
    }


    /**
     * Cập nhật danh mục
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:categories,name,' . $category->id,
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:categories,slug,' . $category->id,
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => [
                'required',
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


        $validated['status'] = $request->boolean('status');

        /*
        |--------------------------------------------------------------------------
        | Upload hình ảnh mới
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $validated['image'] = $request
                ->file('image')
                ->store('categories', 'public');
        }


        $category->update($validated);


        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Cập nhật danh mục thành công.'
            );
    }


    /**
     * Xóa danh mục
     */
    public function destroy(Category $category)
    {
        /*
        |--------------------------------------------------------------------------
        | Không cho xóa nếu đang có sản phẩm
        |--------------------------------------------------------------------------
        */

        if ($category->products()->exists()) {

            return back()->with(
                'error',
                'Không thể xóa danh mục đang có sản phẩm.'
            );
        }


        $category->delete();


        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Xóa danh mục thành công.'
            );
    }
}
