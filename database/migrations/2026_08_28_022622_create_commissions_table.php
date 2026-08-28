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
         Schema::create('commissions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('affiliate_order_id')
                ->constrained('affiliate_orders')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            $table->decimal('commission_rate', 5, 2)
                ->default(0);

            $table->decimal('order_amount', 15, 2)
                ->default(0);

            $table->decimal('commission_amount', 15, 2)
                ->default(0);

            $table->string('status')->default('pending');

            $table->timestamp('settled_at')->nullable();

            $table->timestamps();

            $table->index('affiliate_order_id');
            $table->index('product_id');
            $table->index('status');
            $table->index('settled_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
