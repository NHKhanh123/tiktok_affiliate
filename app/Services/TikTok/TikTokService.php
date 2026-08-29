<?php

namespace App\Services\TikTok;

class TikTokService
{
    /**
     * App Key của TikTok
     */
    protected string $appKey;

    /**
     * App Secret của TikTok
     */
    protected string $appSecret;

    /**
     * Redirect URI
     */
    protected string $redirectUri;


    public function __construct()
    {
        $this->appKey = config('tiktok.app_key');

        $this->appSecret = config('tiktok.app_secret');

        $this->redirectUri = config('tiktok.redirect_uri');
    }


    /**
     * Lấy URL để Creator thực hiện authorization
     */
    public function getAuthorizationUrl(string $state): string
    {
        // Sẽ triển khai sau khi TikTok cấp API

        return '';
    }


    /**
     * Đổi authorization code lấy access token
     */
    public function getAccessToken(string $code): array
    {
        // Sẽ triển khai sau

        return [];
    }
}
