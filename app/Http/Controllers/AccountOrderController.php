<?php

namespace App\Http\Controllers;

use App\Models\AffiliateOrder;
use Illuminate\Http\Request;

class AccountOrderController extends Controller
{
    /**
     * Danh sách đơn hàng của user
     */
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless($user, 401);

        $query = AffiliateOrder::query()
            ->with([
                'product',
                'commission',
            ])
            ->where('user_id', $user->id);


        /*
        |--------------------------------------------------------------------------
        | Tìm kiếm
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'external_order_id',
                    'like',
                    '%' . $search . '%'
                );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Lọc trạng thái
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'order_status',
                $request->status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Orders
        |--------------------------------------------------------------------------
        */

        $orders = $query
            ->latest('ordered_at')
            ->paginate(10)
            ->withQueryString();


        return view(
            'account.orders.index',
            compact('orders')
        );
    }


    /**
     * Chi tiết đơn hàng
     */
    public function show(Request $request, AffiliateOrder $order)
    {
        $user = $request->user();

        abort_unless(
            $user && $order->user_id === $user->id,
            403
        );

        $order->load([
            'product',
            'affiliateLink',
            'commission',
        ]);

        return view(
            'account.orders.show',
            compact('order')
        );
    }
}