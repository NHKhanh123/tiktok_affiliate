<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TikTok\TikTokService;
use Throwable;

class TikTokTestController extends Controller
{
    public function shops(TikTokService $tikTokService)
    {
        try {
            $response = $tikTokService->getAuthorizedShops();

            return response()->json([
                'success' => true,
                'data' => $response,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}