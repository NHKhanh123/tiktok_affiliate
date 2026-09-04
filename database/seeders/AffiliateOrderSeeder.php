<?php

namespace Database\Seeders;

use App\Models\AffiliateOrder;
use App\Models\Commission;
use App\Models\Product;
use App\Models\AffiliateLink;
use App\Models\AffiliateClick;
use Illuminate\Database\Seeder;

class AffiliateOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Lấy sản phẩm đã có trong ProductSeeder
        |--------------------------------------------------------------------------
        */

        $products = Product::whereIn(
            'tiktok_product_id',
            [
                'TEST001',
                'TEST002',
            ]
        )->get();

        if ($products->isEmpty()) {

            $this->command->error(
                'Không tìm thấy sản phẩm TEST001 / TEST002.'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Lấy Affiliate Link nếu đã có
        |--------------------------------------------------------------------------
        */

        $affiliateLinks = AffiliateLink::limit(5)->get();

        /*
        |--------------------------------------------------------------------------
        | Lấy Affiliate Click nếu đã có
        |--------------------------------------------------------------------------
        */

        $affiliateClicks = AffiliateClick::limit(5)->get();


        /*
        |--------------------------------------------------------------------------
        | Dữ liệu đơn hàng test
        |--------------------------------------------------------------------------
        */

        $orders = [

            // Đơn hoàn tất
            [
                'status' => 'completed',
                'order_amount' => 249000,
                'product_amount' => 249000,
                'refund_amount' => 0,
                'days_ago' => 10,
                'commission_rate' => 10,
            ],

            // Đơn hoàn tất nhưng có hoàn tiền
            [
                'status' => 'completed',
                'order_amount' => 179000,
                'product_amount' => 179000,
                'refund_amount' => 50000,
                'days_ago' => 8,
                'commission_rate' => 10,
            ],

            // Đang xử lý
            [
                'status' => 'processing',
                'order_amount' => 249000,
                'product_amount' => 249000,
                'refund_amount' => 0,
                'days_ago' => 3,
                'commission_rate' => 10,
            ],

            // Chờ xử lý
            [
                'status' => 'pending',
                'order_amount' => 179000,
                'product_amount' => 179000,
                'refund_amount' => 0,
                'days_ago' => 1,
                'commission_rate' => 10,
            ],

            // Đã hoàn tiền
            [
                'status' => 'refunded',
                'order_amount' => 249000,
                'product_amount' => 249000,
                'refund_amount' => 249000,
                'days_ago' => 15,
                'commission_rate' => 10,
            ],

            // Đã hủy
            [
                'status' => 'cancelled',
                'order_amount' => 179000,
                'product_amount' => 179000,
                'refund_amount' => 0,
                'days_ago' => 20,
                'commission_rate' => 10,
            ],

            // Hoàn tất
            [
                'status' => 'completed',
                'order_amount' => 249000,
                'product_amount' => 249000,
                'refund_amount' => 20000,
                'days_ago' => 4,
                'commission_rate' => 10,
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | Tạo đơn hàng
        |--------------------------------------------------------------------------
        */

        foreach ($orders as $index => $data) {

            /*
             * Lấy sản phẩm luân phiên:
             *
             * Đơn 1 -> TEST001
             * Đơn 2 -> TEST002
             * Đơn 3 -> TEST001
             * ...
             */

            $product =
                $products[$index % $products->count()];


            /*
             * Lấy Affiliate Link nếu có
             */

            $affiliateLink =
                $affiliateLinks->isNotEmpty()
                    ? $affiliateLinks[
                        $index % $affiliateLinks->count()
                    ]
                    : null;


            /*
             * Lấy Affiliate Click nếu có
             */

            $affiliateClick =
                $affiliateClicks->isNotEmpty()
                    ? $affiliateClicks[
                        $index % $affiliateClicks->count()
                    ]
                    : null;


            /*
             * Thời gian đặt hàng
             */

            $orderedAt = now()->subDays(
                $data['days_ago']
            );


            /*
             * Thời gian thanh toán
             */

            $paidAt = null;

            if (
                in_array(
                    $data['status'],
                    [
                        'completed',
                        'processing',
                        'refunded',
                    ]
                )
            ) {
                $paidAt = $orderedAt->copy()->addMinutes(15);
            }


            /*
             * Thời gian hoàn tất
             */

            $completedAt = null;

            if ($data['status'] === 'completed') {

                $completedAt =
                    $orderedAt->copy()->addDays(2);
            }


            /*
             * Tạo Affiliate Order
             */

            $order = AffiliateOrder::create([

                /*
                 * Quan hệ nội bộ
                 */

                'product_id' =>
                    $product->id,

                'affiliate_link_id' =>
                    $affiliateLink?->id,

                'affiliate_click_id' =>
                    $affiliateClick?->id,


                /*
                 * Dữ liệu TikTok
                 */

                'tiktok_order_id' =>
                    'TEST-ORDER-' .
                    str_pad(
                        $index + 1,
                        6,
                        '0',
                        STR_PAD_LEFT
                    ),

                'tiktok_product_id' =>
                    $product->tiktok_product_id,

                'tiktok_shop_id' =>
                    $product->tiktok_shop_id,


                /*
                 * Tài chính
                 */

                'order_amount' =>
                    $data['order_amount'],

                'product_amount' =>
                    $data['product_amount'],

                'refund_amount' =>
                    $data['refund_amount'],


                /*
                 * Trạng thái
                 */

                'status' =>
                    $data['status'],


                /*
                 * Thời gian
                 */

                'ordered_at' =>
                    $orderedAt,

                'paid_at' =>
                    $paidAt,

                'completed_at' =>
                    $completedAt,


                /*
                 * Raw data mô phỏng TikTok API
                 */

                'raw_data' => [

                    'source' =>
                        'test_seeder',

                    'test' =>
                        true,

                    'order_id' =>
                        'TEST-ORDER-' .
                        str_pad(
                            $index + 1,
                            6,
                            '0',
                            STR_PAD_LEFT
                        ),

                    'order_status' =>
                        $data['status'],

                    'product_id' =>
                        $product->tiktok_product_id,

                    'shop_id' =>
                        $product->tiktok_shop_id,

                    'amount' =>
                        $data['order_amount'],

                    'refund_amount' =>
                        $data['refund_amount'],
                ],
            ]);


            /*
            |--------------------------------------------------------------------------
            | Tạo Commission
            |--------------------------------------------------------------------------
            |
            | Chỉ tạo hoa hồng cho đơn completed.
            |
            */

            if ($data['status'] === 'completed') {

                /*
                 * Giá trị thực tế sau hoàn
                 */

                $commissionBase =
                    $data['order_amount']
                    - $data['refund_amount'];


                /*
                 * Tính hoa hồng
                 */

                $commissionAmount =
                    $commissionBase
                    * $data['commission_rate']
                    / 100;


                /*
                 * Đơn đầu tiên -> settled
                 * Các đơn completed còn lại -> pending
                 */

                $commissionStatus =
                    $index === 0
                        ? 'settled'
                        : 'pending';


                $settledAt =
                    $commissionStatus === 'settled'
                        ? now()->subDays(2)
                        : null;


                Commission::create([

                    'affiliate_order_id' =>
                        $order->id,

                    'product_id' =>
                        $product->id,

                    'commission_rate' =>
                        $data['commission_rate'],

                    'order_amount' =>
                        $commissionBase,

                    'commission_amount' =>
                        $commissionAmount,

                    'status' =>
                        $commissionStatus,

                    'settled_at' =>
                        $settledAt,
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Thông báo
        |--------------------------------------------------------------------------
        */

        $this->command->info(
            'Đã tạo 7 Affiliate Orders test thành công.'
        );

        $this->command->info(
            'Đã tạo Commission cho các đơn completed.'
        );
    }
}