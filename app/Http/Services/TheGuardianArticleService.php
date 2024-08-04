<?php

namespace App\Http\Services;

use App\Http\Requests\NewsSearchRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class TheGuardianArticleService
{
    public static function getGuardianNewsItem(string $id)
    {
        $baseUrl = env('GUARDIAN_API_BASE_URL');

        $response =  Http::get("{$baseUrl}/{$id}", [
            'api-key' => env('GUARDIAN_API_KEY'),
            'show-fields' => 'standfirst,headline,thumbnail,short-url',
        ]);

        if ($response->ok() !== true) {
            return collect([]);
        }

        $article = $response->json()["response"]["content"];

        $extractedArticles = [
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

        return $extractedArticles;
    }
}
