<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateLink;
use App\Models\Product;
use Illuminate\Http\Request;

class AffiliateLinkController extends Controller
{
    /**
     * Danh sách affiliate link
     */
    public function index()
    {
        $affiliateLinks = AffiliateLink::with('product')
            ->latest()
            ->paginate(10);

        return view(
            'admin.affiliate-links.index',
            compact('affiliateLinks')
        );
    }


    /**
     * Form tạo affiliate link
     */
    public function create()
    {
        $products = Product::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.affiliate-links.create',
            compact('products')
        );
    }


    /**
     * Lưu affiliate link
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => [
                'required',
                'exists:products,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'affiliate_url' => [
                'required',
                'url',
            ],

            'commission_rate' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Không cho một sản phẩm có nhiều affiliate link
        |--------------------------------------------------------------------------
        */

        if (
            AffiliateLink::where(
                'product_id',
                $validated['product_id']
            )->exists()
        ) {
            return back()
                ->withErrors([
                    'product_id' =>
                    'Sản phẩm này đã có Affiliate Link.'
                ])
                ->withInput();
        }


        $validated['status'] =
            $request->boolean('status');


        AffiliateLink::create($validated);


        return redirect()
            ->route('admin.affiliate-links.index')
            ->with(
                'success',
                'Tạo Affiliate Link thành công.'
            );
    }


    /**
     * Chi tiết affiliate link
     */
    public function show(AffiliateLink $affiliateLink)
    {
        $affiliateLink->load('product');

        return view(
            'admin.affiliate-links.show',
            compact('affiliateLink')
        );
    }


    /**
     * Form chỉnh sửa
     */
    public function edit(AffiliateLink $affiliateLink)
    {
        $products = Product::orderBy('name')
            ->get();

        return view(
            'admin.affiliate-links.edit',
            compact(
                'affiliateLink',
                'products'
            )
        );
    }


    /**
     * Cập nhật affiliate link
     */
    public function update(
        Request $request,
        AffiliateLink $affiliateLink
    ) {
        $validated = $request->validate([
            'product_id' => [
                'required',
                'exists:products,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'affiliate_url' => [
                'required',
                'url',
            ],

            'commission_rate' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Kiểm tra sản phẩm đã có link khác
        |--------------------------------------------------------------------------
        */

        $exists = AffiliateLink::where(
            'product_id',
            $validated['product_id']
        )
            ->where(
                'id',
                '!=',
                $affiliateLink->id
            )
            ->exists();


        if ($exists) {
            return back()
                ->withErrors([
                    'product_id' =>
                    'Sản phẩm này đã có Affiliate Link khác.'
                ])
                ->withInput();
        }


        $validated['status'] =
            $request->boolean('status');


        $affiliateLink->update($validated);


        return redirect()
            ->route('admin.affiliate-links.index')
            ->with(
                'success',
                'Cập nhật Affiliate Link thành công.'
            );
    }


    /**
     * Xóa affiliate link
     */
    public function destroy(
        AffiliateLink $affiliateLink
    ) {
        $affiliateLink->delete();

        return redirect()
            ->route('admin.affiliate-links.index')
            ->with(
                'success',
                'Xóa Affiliate Link thành công.'
            );
    }
}
