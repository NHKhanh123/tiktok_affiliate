<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tiktok_accounts', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | User của website
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | TikTok account
            |--------------------------------------------------------------------------
            */

            $table->string('open_id')
                ->nullable()
                ->unique();


            /*
            |--------------------------------------------------------------------------
            | Token
            |--------------------------------------------------------------------------
            */

            $table->text('access_token')
                ->nullable();

            $table->text('refresh_token')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Token expiration
            |--------------------------------------------------------------------------
            */

            $table->timestamp('access_token_expires_at')
                ->nullable();

            $table->timestamp('refresh_token_expires_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Granted scopes
            |--------------------------------------------------------------------------
            */

            $table->json('scopes')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | TikTok market
            |--------------------------------------------------------------------------
            */

            $table->string('market')
                ->default('VN');


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')
                ->default(true);


            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('tiktok_accounts');
    }
};
