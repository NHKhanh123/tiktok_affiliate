<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateClick;
use App\Models\AffiliateOrder;
use App\Models\Commission;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalProducts = Product::count();

        $totalClicks = AffiliateClick::count();

        $totalOrders = AffiliateOrder::count();

        $monthlyCommission = Commission::query()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('commission_amount');

        return view('admin.dashboard', [
            'totalProducts' => $totalProducts,
            'totalClicks' => $totalClicks,
            'totalOrders' => $totalOrders,
            'monthlyCommission' => $monthlyCommission,
        ]);
    }
}