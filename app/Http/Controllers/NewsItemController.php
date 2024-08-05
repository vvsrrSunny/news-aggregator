<?php

namespace App\Http\Controllers;

use App\Http\Services\NewsItemService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class NewsItemController extends Controller
{
    /**
     * Display a listing of random data.
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(string $id): JsonResponse
    {
        $article = NewsItemService::getGuardianNewsItem($id);

        return response()->json(['data' => $article]);
    }

    /**
     * Display a listing of random data.
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function pin(string $id): JsonResponse
    {
        $article = NewsItemService::getGuardianNewsItem($id);

        if (!$article) {
            return  response()->json(['errors' => ["id" => "id not found to pin"]], 422);
        }

        // Check if the pinned_articles cookie exists
        if (!Cookie::has('pinned_articles')) {
            $cookie = cookie('pinned_articles', json_encode(['the_guardian' => [$id]]), 60 * 24 * 30);
            Log::debug(['cookie_value' => json_decode($cookie->getValue(), true)]);
            return response()->json(['data' => "success"])->cookie($cookie);
        }
        // Retrieve the existing cookie data
        $cookieData = json_decode(Cookie::get('pinned_articles'), true);

        if (is_null($cookieData)) {
            $cookieData = ['the_guardian' => []];
        }

        $cookieData['the_guardian'][] = $id;

        // Create a new cookie with the updated data
        $newCookie = cookie('pinned_articles', json_encode($cookieData), 60 * 24 * 30);
        Log::debug(['cookie_value' => $cookieData]);

        return response()->json(['data' => "success"])->cookie($newCookie);
    }
}
