<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateOrder;
use App\Models\Commission;

class AffiliateOrderController extends Controller
{
    /**
     * Danh sách đơn hàng
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Danh sách đơn hàng
        |--------------------------------------------------------------------------
        */

        $orders = AffiliateOrder::with([
            'product',
            'affiliateLink',
            'affiliateClick',
            'commission',
        ])
            ->latest('ordered_at')
            ->paginate(20)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Thống kê tổng quan
        |--------------------------------------------------------------------------
        */

        // Tổng số đơn hàng
        $totalOrders = AffiliateOrder::count();


        // Tổng số đơn hoàn tất
        $completedOrders = AffiliateOrder::where(
            'status',
            'completed'
        )->count();


        // Tổng doanh số của các đơn hoàn tất
        $totalRevenue = AffiliateOrder::where(
            'status',
            'completed'
        )->sum('order_amount');


        // Tổng tiền đã hoàn lại
        $totalRefund = AffiliateOrder::where(
            'refund_amount',
            '>',
            0
        )->sum('refund_amount');


        /*
        |--------------------------------------------------------------------------
        | Thống kê Commission
        |--------------------------------------------------------------------------
        */

        // Tổng hoa hồng của các đơn hoàn tất
        $totalCommission = Commission::whereHas(
            'affiliateOrder',
            function ($query) {
                $query->where('status', 'completed');
            }
        )->sum('commission_amount');


        // Hoa hồng đã quyết toán
        $settledCommission = Commission::where(
            'status',
            'settled'
        )->sum('commission_amount');


        /*
        |--------------------------------------------------------------------------
        | Lợi nhuận / doanh thu thực tế
        |--------------------------------------------------------------------------
        |
        | Doanh số thực tế sau hoàn tiền
        |
        */

        $netRevenue = $totalRevenue - $totalRefund;


        /*
        |--------------------------------------------------------------------------
        | Tỷ lệ hoàn tất
        |--------------------------------------------------------------------------
        */

        $completionRate = $totalOrders > 0
            ? round(
                ($completedOrders / $totalOrders) * 100,
                2
            )
            : 0;


        /*
        |--------------------------------------------------------------------------
        | Trả dữ liệu về View
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.affiliate-orders.index',
            compact(
                'orders',

                // Đơn hàng
                'totalOrders',
                'completedOrders',

                // Doanh thu
                'totalRevenue',
                'totalRefund',
                'netRevenue',

                // Commission
                'totalCommission',
                'settledCommission',

                // Tỷ lệ
                'completionRate'
            )
        );
    }


    /**
     * Chi tiết đơn hàng
     */
    public function show(AffiliateOrder $affiliateOrder)
    {
        $affiliateOrder->load([
            'product',
            'affiliateLink',
            'affiliateClick',
            'commission',
        ]);

        return view(
            'admin.affiliate-orders.show',
            compact('affiliateOrder')
        );
    }
}
