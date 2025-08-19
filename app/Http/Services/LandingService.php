<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class LandingService
{
    /* Get data news */
    public function getNews()
    {
        $reqNews = Http::withHeaders([
            'x-signature' => env('NEWS_API_KEY'),
        ])->get(env('NEWS_API_URL'))->json();

        if ($reqNews['status'] === true) {
            $news = json_decode(json_encode($reqNews['response']['data']));
        }

        return $news;
    }
}
