<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('affiliate_orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            $table->foreignId('affiliate_link_id')
                ->nullable()
                ->constrained('affiliate_links')
                ->nullOnDelete();

            $table->string('external_order_id')->unique();

            $table->decimal('order_amount', 15, 2)
                ->default(0);

            $table->string('currency', 10)
                ->default('VND');

            $table->string('order_status')->default('pending');

            $table->string('attribution_type')->nullable();

            $table->timestamp('ordered_at')->nullable();

            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            $table->index('product_id');
            $table->index('affiliate_link_id');
            $table->index('order_status');
            $table->index('ordered_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_orders');
    }
};
