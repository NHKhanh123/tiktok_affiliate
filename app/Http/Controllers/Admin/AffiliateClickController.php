<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateClick;
use Illuminate\Http\Request;

class AffiliateClickController extends Controller
{
    /**
     * Danh sách click + thống kê
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Tổng lượt click
        |--------------------------------------------------------------------------
        */

        $totalClicks = AffiliateClick::count();


        /*
        |--------------------------------------------------------------------------
        | Click hôm nay
        |--------------------------------------------------------------------------
        */

        $todayClicks = AffiliateClick::whereDate(
            'clicked_at',
            today()
        )->count();


        /*
        |--------------------------------------------------------------------------
        | Click tháng này
        |--------------------------------------------------------------------------
        */

        $monthlyClicks = AffiliateClick::whereMonth(
            'clicked_at',
            now()->month
        )
            ->whereYear(
                'clicked_at',
                now()->year
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Danh sách click
        |--------------------------------------------------------------------------
        */

        $clicks = AffiliateClick::with([
            'product',
            'affiliateLink',
        ])
            ->latest('clicked_at')
            ->paginate(10)
            ->withQueryString();


        return view(
            'admin.clicks.index',
            compact(
                'totalClicks',
                'todayClicks',
                'monthlyClicks',
                'clicks'
            )
        );
    }
}
