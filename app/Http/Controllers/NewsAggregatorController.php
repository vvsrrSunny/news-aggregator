<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsAggregatorRequest;
use App\Http\Services\TheGuardianService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class NewsAggregatorController extends Controller
{
    /**
     * Display a listing of random data.
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(NewsAggregatorRequest $request): JsonResponse
    {
        $extractedArticles = TheGuardianService::getGuardianNews($request);

        // Check if the pinned_articles cookie exists
        if (!Cookie::has('pinned_articles')) {
            return response()->json(['theGuardian' => $extractedArticles]);
        }

        // Retrieve the existing cookie data
        $cookieData = json_decode(Cookie::get('pinned_articles'), true);

        if (is_null($cookieData)) {
            return response()->json(['theGuardian' => $extractedArticles]);
        }

        $extractedArticles = collect($extractedArticles)->map(function (array $item, int $key) use ($cookieData) {
            Log::debug($item['id'], $cookieData['the_guardian']);

            if (!collect($cookieData['the_guardian'])->contains($item['id'])) {
                $item['isPinned'] = false;
                return $item;
            }

            $item['isPinned'] = true;
            return $item;
        })->toArray();

        return response()->json(['theGuardian' => $extractedArticles]);
    }
}
