<?php

namespace App\Http\Controllers;

use App\Models\AffiliateClick;
use App\Models\AffiliateLink;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AffiliateRedirectController extends Controller
{
    public function redirect(
        Request $request,
        Product $product
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Kiểm tra sản phẩm
        |--------------------------------------------------------------------------
        */

        abort_unless($product->status, 404);


        /*
        |--------------------------------------------------------------------------
        | Tìm Affiliate Link đang hoạt động
        |--------------------------------------------------------------------------
        */

        $affiliateLink = AffiliateLink::query()
            ->where('product_id', $product->id)
            ->where('status', true)
            ->whereNotNull('affiliate_url')
            ->where('affiliate_url', '!=', '')
            ->latest('id')
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Không có Affiliate Link hoạt động
        |--------------------------------------------------------------------------
        */

        if (!$affiliateLink) {

            return redirect()
                ->route(
                    'products.show',
                    $product->slug
                )
                ->with(
                    'error',
                    'Liên kết mua hàng của sản phẩm hiện đang tạm thời không khả dụng. Vui lòng quay lại sau.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Ghi nhận Affiliate Click
        |--------------------------------------------------------------------------
        */

        AffiliateClick::create([
            'product_id' => $product->id,

            'affiliate_link_id' => $affiliateLink->id,

            'session_id' =>
            $request->session()->getId(),

            'ip_address' =>
            $request->ip(),

            'user_agent' =>
            $request->userAgent(),

            'referer' =>
            $request->headers->get('referer'),

            'clicked_at' => now(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | Tăng click_count
        |--------------------------------------------------------------------------
        */

        $product->increment('click_count');


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()->away(
            $affiliateLink->affiliate_url
        );
    }
}
