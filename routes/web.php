<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('admin.login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('admin.login.submit');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('admin.logout');

    Route::middleware('admin')->group(function () {
        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )->name('admin.dashboard');

        Route::get('/products', function () {
            return 'Products';
        })->name('admin.products');

        Route::get('/categories', function () {
            return 'Categories';
        })->name('admin.categories');

        Route::get('/affiliate-links', function () {
            return 'Affiliate Links';
        })->name('admin.affiliate-links');

        Route::get('/clicks', function () {
            return 'Clicks';
        })->name('admin.clicks');

        Route::get('/orders', function () {
            return 'Orders';
        })->name('admin.orders');

        Route::get('/commissions', function () {
            return 'Commissions';
        })->name('admin.commissions');

        Route::get('/withdrawals', function () {
            return 'Withdrawals';
        })->name('admin.withdrawals');

        Route::get('/settings', function () {
            return 'Settings';
        })->name('admin.settings');
    });
});