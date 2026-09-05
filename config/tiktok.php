<?php

return [

    /*
    |--------------------------------------------------------------------------
    | TikTok Shop API
    |--------------------------------------------------------------------------
    */

    'base_url' => env(
        'TIKTOK_BASE_URL',
        'https://open-api.tiktokglobalshop.com'
    ),

    /*
    |--------------------------------------------------------------------------
    | App credentials
    |--------------------------------------------------------------------------
    */

    'app_key' => env('TIKTOK_APP_KEY'),

    'app_secret' => env('TIKTOK_APP_SECRET'),

    'redirect_uri' => env('TIKTOK_REDIRECT_URI'),

    /*
    |--------------------------------------------------------------------------
    | Access token
    |--------------------------------------------------------------------------
    |
    | Tạm thời dùng ENV để test.
    | Sau này nên lưu token vào database vì token có thể
    | thay đổi và cần refresh.
    |
    */

    'access_token' => env('TIKTOK_ACCESS_TOKEN'),

];