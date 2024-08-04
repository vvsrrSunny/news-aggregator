<?php

namespace App\Http\Services;

use App\Http\Requests\NewsAggregatorRequest;
use App\Http\Requests\NewsSearchRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class TheGuardianService
{
    public static function getGuardianNews(NewsAggregatorRequest $request)
    {
        // $responseBody = file_get_contents(storage_path("app/response.json"));

        // // Decode JSON response
        // $response = json_decode($responseBody, true);
        // $results = $response["response"]["results"];

        if ($request->search == null) {
            return collect([]);
        }

        // Get base URL from environment variable
        $baseUrl = env('GUARDIAN_API_BASE_URL');

        $response =  Http::get("{$baseUrl}/search", [
            'api-key' => env('GUARDIAN_API_KEY'),
            // 'tag' => 'film/film,tone/reviews',
            // 'from-date' => '2020-01-01',
            // 'to-date' => '2024-08-02',
            'order-by' => 'relevance',
            'show-fields' => 'headline,thumbnail,short-url',
            'page-size' => 10,
            'page' => 1,
            'q' => $request->search,
        ]);

        if ($response->ok() !== true) {
            return collect([]);
        }

        $results = $response->json()["response"]["results"];

        $extractedArticles = collect($results)->map(function ($article) {
            return [
                'id' => $article['id'] ?? null,
                'title' => $article['webTitle'] ?? null,
                'newsSource' => 'The Guardian',
                'section' => $article['sectionName'] ?? null,
                'sectionId' => $article['sectionId'] ?? null,
                'link' => $article['fields']['shortUrl'] ?? null,
                'headline' => $article['fields']['headline'] ?? null,
                'thumbnail' => $article['fields']['thumbnail'] ?? null,
                'publicationDate' => $article['webPublicationDate'] ? Carbon::parse($article['webPublicationDate'] ?? '')->format('F j, Y g:i A') : null,
            ];
        });

        return $extractedArticles;
    }
}
