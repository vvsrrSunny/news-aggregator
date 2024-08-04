<?php

namespace App\Http\Controllers;

use App\Http\Services\TheGuardianArticleService;
use Illuminate\Http\Request;

class NewsItemController extends Controller
{
    /**
     * Display a listing of random data.
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Http\Requests\NewsSearchRequest
     */
    public function index(string $id)
    {
        $article = TheGuardianArticleService::getGuardianNewsItem($id);

        return response()->json(['data' => $article]);
    }
}
