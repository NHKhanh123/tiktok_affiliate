<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('affiliate_orders', function (Blueprint $table) {

            $table->foreignId('affiliate_click_id')
                ->nullable()
                ->after('affiliate_link_id')
                ->constrained('affiliate_clicks')
                ->nullOnDelete();

            $table->index('affiliate_click_id');
        });
    }

    public function down(): void
    {
        Schema::table('affiliate_orders', function (Blueprint $table) {

            $table->dropForeign([
                'affiliate_click_id'
            ]);

            $table->dropIndex([
                'affiliate_click_id'
            ]);

            $table->dropColumn('affiliate_click_id');
        });
    }
};
