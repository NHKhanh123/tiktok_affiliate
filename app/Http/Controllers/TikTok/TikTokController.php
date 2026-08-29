<?php

namespace App\Http\Controllers\TikTok;

use App\Http\Controllers\Controller;
use App\Services\TikTok\TikTokService;

class TikTokController extends Controller
{
    protected TikTokService $tikTokService;


    public function __construct(
        TikTokService $tikTokService
    ) {
        $this->tikTokService = $tikTokService;
    }


    /**
     * Bắt đầu quá trình TikTok authorization
     */
    public function authorize()
    {
        return response()->json([
            'message' => 'TikTok authorization chua duoc trien khai.',
        ]);
    }


    /**
     * TikTok callback
     */
    public function callback()
    {
        return response()->json([
            'message' => 'TikTok callback chua duoc trien khai.',
        ]);
    }
}
