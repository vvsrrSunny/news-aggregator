<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsAggregatorRequest;
use App\Http\Services\TheGuardianService;
use Illuminate\Http\Request;

class NewsAggregatorController extends Controller
{
    /**
     * Display a listing of random data.
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(NewsAggregatorRequest $request)
    {
        $extractedArticles = TheGuardianService::getGuardianNews($request);

        return response()->json(['theGuardian' => $extractedArticles]);
    }
}
