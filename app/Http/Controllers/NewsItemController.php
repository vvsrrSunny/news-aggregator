<?php

namespace App\Http\Controllers;

use App\Http\Services\NewsItemService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
    public function post(Request $request, string $id): JsonResponse
    {
        $article = NewsItemService::getGuardianNewsItem($id);

        if (!$article) {
            return  response()->json(['errors' => ["id" => "id not found to pin"]], 422);
        }

        if (!$request->session()->get('pinned_articles', null)) {
            $pinnedArticles = ['the_guardian' => [$id]];
            $request->session()->put('pinned_articles', $pinnedArticles);
            Log::debug(['session_value' => $request->session()->get('pinned_articles')]);
            return response()->json(['data' => "success"]);
        }

        // Retrieve the existing session data
        $pinnedArticles = $request->session()->get('pinned_articles');

        if (is_null($pinnedArticles)) {
            $pinnedArticles = ['the_guardian' => []];
        }

        $pinnedArticles['the_guardian'][] = $id;

        // Save the updated session data
        $request->session()->put('pinned_articles', $pinnedArticles);
        Log::debug(['session_value' => $pinnedArticles]);

        return response()->json(['data' => "success"]);
    }
}
