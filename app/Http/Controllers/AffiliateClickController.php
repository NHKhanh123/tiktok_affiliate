<?php

namespace App\Http\Controllers;

use App\Models\AffiliateClick;
use App\Models\AffiliateLink;
use Illuminate\Http\Request;

class AffiliateClickController extends Controller
{
    /**
     * Ghi nhận click và chuyển sang Affiliate URL
     */
    public function redirect(
        Request $request,
        AffiliateLink $affiliateLink
    ) {
        /*
        |--------------------------------------------------------------------------
        | Kiểm tra Affiliate Link
        |--------------------------------------------------------------------------
        */

        if (!$affiliateLink->status) {
            abort(
                404,
                'Affiliate Link không còn hoạt động.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Lấy sản phẩm
        |--------------------------------------------------------------------------
        */

        $product = $affiliateLink->product;

        if (!$product) {
            abort(
                404,
                'Không tìm thấy sản phẩm.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Lưu lịch sử click
        |--------------------------------------------------------------------------
        */

        AffiliateClick::create([
            'product_id' => $product->id,

            'affiliate_link_id' => $affiliateLink->id,

            'session_id' => $request
                ->session()
                ->getId(),

            'ip_address' => $request->ip(),

            'user_agent' => $request->userAgent(),

            'referer' => $request->header('referer'),

            'clicked_at' => now(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | Tăng tổng lượt click của sản phẩm
        |--------------------------------------------------------------------------
        */

        $product->increment('click_count');


        /*
        |--------------------------------------------------------------------------
        | Chuyển sang TikTok
        |--------------------------------------------------------------------------
        */

        return redirect()->away(
            $affiliateLink->affiliate_url
        );
    }
}