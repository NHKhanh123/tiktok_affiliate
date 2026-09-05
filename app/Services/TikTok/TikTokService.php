<?php

namespace App\Services\TikTok;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class TikTokService
{
    /**
     * TikTok Shop API base URL
     */
    protected string $baseUrl;

    /**
     * App Key
     */
    protected string $appKey;

    /**
     * App Secret
     */
    protected string $appSecret;

    /**
     * Redirect URI
     */
    protected string $redirectUri;

    /**
     * Access Token
     */
    protected ?string $accessToken;

    public function __construct()
    {
        $this->baseUrl = config(
            'tiktok.base_url',
            'https://open-api.tiktokglobalshop.com'
        );

        $this->appKey = config('tiktok.app_key');

        $this->appSecret = config('tiktok.app_secret');

        $this->redirectUri = config('tiktok.redirect_uri');

        $this->accessToken = config('tiktok.access_token');
    }

    /**
     * Lấy URL để Creator thực hiện authorization.
     */
    public function getAuthorizationUrl(string $state): string
    {
        return 'https://shop.tiktok.com/alliance/creator/auth'
            . '?' . http_build_query([
                'app_key' => $this->appKey,
                'state' => $state,
            ]);
    }

    /**
     * Đổi authorization code lấy access token.
     *
     * Phần này sẽ hoàn thiện khi xử lý OAuth.
     */
    public function getAccessToken(string $code): array
    {
        throw new RuntimeException(
            'TikTok OAuth token exchange chưa được triển khai.'
        );
    }

    /**
     * Gọi TikTok Shop API.
     *
     * @param string $method
     * @param string $path
     * @param array $query
     * @param array $body
     */
    public function request(
        string $method,
        string $path,
        array $query = [],
        array $body = []
    ): array {

        if (!$this->appKey || !$this->appSecret) {
            throw new RuntimeException(
                'TikTok App Key hoặc App Secret chưa được cấu hình.'
            );
        }

        if (!$this->accessToken) {
            throw new RuntimeException(
                'TikTok Access Token chưa được cấu hình.'
            );
        }


        /*
    |--------------------------------------------------------------------------
    | Timestamp
    |--------------------------------------------------------------------------
    */

        $timestamp = time();


        /*
    |--------------------------------------------------------------------------
    | Query parameters
    |--------------------------------------------------------------------------
    */

        $query['app_key'] = $this->appKey;

        $query['timestamp'] = $timestamp;


        /*
    |--------------------------------------------------------------------------
    | Generate signature
    |--------------------------------------------------------------------------
    */

        $query['sign'] = $this->generateSignature(
            $path,
            $query,
            $body
        );


        /*
    |--------------------------------------------------------------------------
    | Request
    |--------------------------------------------------------------------------
    */

        $response = Http::acceptJson()
            ->withHeaders([
                'content-type' => 'application/json',
                'x-tts-access-token' => $this->accessToken,
            ])
            ->send(
                strtoupper($method),
                $this->baseUrl . $path,
                [
                    'query' => $query,
                    'json' => $body,
                ]
            );


        /*
    |--------------------------------------------------------------------------
    | HTTP error
    |--------------------------------------------------------------------------
    */

        if ($response->failed()) {

            throw new RuntimeException(
                'Lỗi HTTP API TikTok: '
                    . $response->status()
                    . ' - '
                    . $response->body()
            );
        }


        /*
    |--------------------------------------------------------------------------
    | Parse JSON
    |--------------------------------------------------------------------------
    */

        $data = $response->json();


        if (!is_array($data)) {

            throw new RuntimeException(
                'TikTok API trả về dữ liệu không hợp lệ.'
            );
        }


        /*
    |--------------------------------------------------------------------------
    | TikTok API error
    |--------------------------------------------------------------------------
    */

        if (($data['code'] ?? null) !== 0) {

            throw new RuntimeException(
                'Lỗi API TikTok: '
                    . ($data['message'] ?? 'Unknown error')
            );
        }


        return $data;
    }

    /**
     * Tạo signature theo TikTok Shop API.
     */
    protected function generateSignature(
        string $path,
        array $query,
        array $body = []
    ): string {
        /*
    |--------------------------------------------------------------------------
    | 1. Loại bỏ sign và access_token
    |--------------------------------------------------------------------------
    */

        unset(
            $query['sign'],
            $query['access_token']
        );


        /*
    |--------------------------------------------------------------------------
    | 2. Sắp xếp query parameter theo alphabet
    |--------------------------------------------------------------------------
    */

        ksort($query);


        /*
    |--------------------------------------------------------------------------
    | 3. Ghép query theo dạng key + value
    |--------------------------------------------------------------------------
    */

        $queryString = '';

        foreach ($query as $key => $value) {

            if (is_array($value)) {
                $value = implode(',', $value);
            }

            $queryString .= $key . $value;
        }


        /*
    |--------------------------------------------------------------------------
    | 4. Path + Query
    |--------------------------------------------------------------------------
    */

        $signString = $path . $queryString;


        /*
    |--------------------------------------------------------------------------
    | 5. Nếu có body thì nối body JSON
    |--------------------------------------------------------------------------
    */

        if (!empty($body)) {

            $bodyString = json_encode(
                $body,
                JSON_UNESCAPED_SLASHES
                    | JSON_UNESCAPED_UNICODE
            );

            $signString .= $bodyString;
        }


        /*
    |--------------------------------------------------------------------------
    | 6. Bọc bằng App Secret
    |--------------------------------------------------------------------------
    */

        $signString =
            $this->appSecret
            . $signString
            . $this->appSecret;


        /*
    |--------------------------------------------------------------------------
    | 7. HMAC-SHA256
    |--------------------------------------------------------------------------
    */

        return hash_hmac(
            'sha256',
            $signString,
            $this->appSecret
        );
    }
    /**
     * Lấy danh sách TikTok Shop đã authorize.
     */
    public function getAuthorizedShops(): array
    {
        return $this->request(
            'GET',
            '/authorization/202309/shops'
        );
    }
}
