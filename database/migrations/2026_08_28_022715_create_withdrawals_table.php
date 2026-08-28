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
       Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();

            $table->decimal('amount', 15, 2);

            $table->string('bank_name')->nullable();

            $table->string('account_name')->nullable();

            $table->string('account_number')->nullable();

            $table->string('status')->default('pending');

            $table->timestamp('requested_at')->useCurrent();

            $table->timestamp('completed_at')->nullable();

            $table->text('note')->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index('requested_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
