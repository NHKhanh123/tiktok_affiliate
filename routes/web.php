<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\TikTok\TikTokController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AffiliateLinkController;
use App\Http\Controllers\AffiliateClickController;


/*
|--------------------------------------------------------------------------
| Trang chủ
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| Đăng ký tài khoản
|--------------------------------------------------------------------------
*/

Route::get(
    '/register',
    [RegisterController::class, 'showRegistrationForm']
)->name('register.form');

Route::post(
    '/register',
    [RegisterController::class, 'register']
)->name('register');


/*
|--------------------------------------------------------------------------
| Đăng nhập / Đăng xuất
|--------------------------------------------------------------------------
*/

Route::get(
    '/login',
    [AuthController::class, 'showLogin']
)->name('login');

Route::post(
    '/login',
    [AuthController::class, 'login']
)->name('login.submit');

Route::post(
    '/logout',
    [AuthController::class, 'logout']
)->name('logout');


/*
|--------------------------------------------------------------------------
| Email Verification
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Trang thông báo xác minh Email
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/email/verify',
        function () {
            return view('auth.verify-email');
        }
    )->name('verification.notice');


    /*
    |--------------------------------------------------------------------------
    | Xác minh Email
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/email/verify/{id}/{hash}',
        function (EmailVerificationRequest $request) {

            $request->fulfill();

            return redirect()
                ->route('home')
                ->with(
                    'message',
                    'Email của bạn đã được xác minh thành công.'
                );

        }
    )
    ->middleware('signed')
    ->name('verification.verify');


    /*
    |--------------------------------------------------------------------------
    | Gửi lại Email xác minh
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/email/verification-notification',
        function (Request $request) {

            $request->user()->sendEmailVerificationNotification();

            return back()->with(
                'message',
                'Email xác minh đã được gửi lại.'
            );

        }
    )
    ->middleware('throttle:6,1')
    ->name('verification.send');

});


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
|
| Chỉ tài khoản:
|
| 1. Đã đăng nhập
| 2. Đã xác minh Email
| 3. Có role = admin
|
*/

Route::prefix('admin')
    ->middleware([
        'auth',
        'verified',
        'admin',
    ])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Admin Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )->name('admin.dashboard');

           /*
        |--------------------------------------------------------------------------
        | Category Management
        |--------------------------------------------------------------------------
        */

        Route::get('/categories/index', [CategoryController::class, 'index'])->name('admin.categories.index');  
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
        Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');
           /*
        |--------------------------------------------------------------------------
        | Product Management
        |--------------------------------------------------------------------------
        */

        Route::get('/products/index', [ProductController::class, 'index'])->name('admin.products.index');
        route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('admin.products.show');
           /*
        |--------------------------------------------------------------------------
        | Affiliate Link Management
        |--------------------------------------------------------------------------
        */

        Route::get('/affiliate-links/index', [AffiliateLinkController::class, 'index'])->name('admin.affiliate-links.index');
        Route::get('/affiliate-links/create', [AffiliateLinkController::class, 'create'])->name('admin.affiliate-links.create');
        Route::post('/affiliate-links', [AffiliateLinkController::class, 'store'])->name('admin.affiliate-links.store');
        Route::get('/affiliate-links/{affiliateLink}/edit', [AffiliateLinkController::class, 'edit'])->name('admin.affiliate-links.edit');
        Route::put('/affiliate-links/{affiliateLink}', [AffiliateLinkController::class, 'update'])->name('admin.affiliate-links.update');
        Route::delete('/affiliate-links/{affiliateLink}', [AffiliateLinkController::class, 'destroy'])->name('admin.affiliate-links.destroy');
        Route::get('/affiliate-links/{affiliateLink}', [AffiliateLinkController::class, 'show'])->name('admin.affiliate-links.show');
    });

Route::get(
    '/tiktok/authorize',
    [TikTokController::class, 'authorize']
)->name('tiktok.authorize');

Route::get(
    '/tiktok/callback',
    [TikTokController::class, 'callback']
)->name('tiktok.callback');

Route::get(
    '/go/{affiliateLink}',
    [AffiliateClickController::class, 'redirect']
)->name('affiliate.redirect');