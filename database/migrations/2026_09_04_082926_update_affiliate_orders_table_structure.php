<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('affiliate_orders', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Đổi tên các trường cũ
            |--------------------------------------------------------------------------
            */

            $table->renameColumn(
                'external_order_id',
                'tiktok_order_id'
            );

            $table->renameColumn(
                'order_status',
                'status'
            );


            /*
            |--------------------------------------------------------------------------
            | Thêm thông tin TikTok
            |--------------------------------------------------------------------------
            */

            $table->string('tiktok_product_id')
                ->nullable()
                ->after('tiktok_order_id');

            $table->string('tiktok_shop_id')
                ->nullable()
                ->after('tiktok_product_id');


            /*
            |--------------------------------------------------------------------------
            | Thông tin tiền
            |--------------------------------------------------------------------------
            */

            $table->decimal('product_amount', 15, 2)
                ->default(0)
                ->after('order_amount');

            $table->decimal('refund_amount', 15, 2)
                ->default(0)
                ->after('product_amount');


            /*
            |--------------------------------------------------------------------------
            | Thanh toán
            |--------------------------------------------------------------------------
            */

            $table->timestamp('paid_at')
                ->nullable()
                ->after('ordered_at');


            /*
            |--------------------------------------------------------------------------
            | Dữ liệu TikTok gốc
            |--------------------------------------------------------------------------
            */

            $table->json('raw_data')
                ->nullable()
                ->after('completed_at');
        });


        /*
        |--------------------------------------------------------------------------
        | Xóa các trường không còn sử dụng
        |--------------------------------------------------------------------------
        */

        Schema::table('affiliate_orders', function (Blueprint $table) {

            $table->dropIndex([
                'order_status'
            ]);

            $table->dropColumn([
                'currency',
                'attribution_type',
            ]);


            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */

            $table->index('tiktok_product_id');
            $table->index('tiktok_shop_id');
            $table->index('status');
        });
    }


    public function down(): void
    {
        Schema::table('affiliate_orders', function (Blueprint $table) {

            $table->dropIndex([
                'tiktok_product_id'
            ]);

            $table->dropIndex([
                'tiktok_shop_id'
            ]);

            $table->dropIndex([
                'status'
            ]);

            $table->dropColumn([
                'tiktok_product_id',
                'tiktok_shop_id',
                'product_amount',
                'refund_amount',
                'paid_at',
                'raw_data',
            ]);

            $table->renameColumn(
                'tiktok_order_id',
                'external_order_id'
            );

            $table->renameColumn(
                'status',
                'order_status'
            );

            $table->string('currency', 10)
                ->default('VND');

            $table->string('attribution_type')
                ->nullable();

            $table->index('order_status');
        });
    }
};