<?php

namespace App\Http\Services;

use App\Models\Uptd;
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

    /* Get data bbi */
    public function getBbi()
    {
        $data = Uptd::with('kalurahan.kecamatan.kabupaten', 'jenis_ikans')->where('type', Uptd::UPTD)->orderByDesc('created_at')->get();

        return $data;
    }

    /* Get data tpi */
    public function getTpi()
    {
        $data = Uptd::with('kalurahan.kecamatan.kabupaten', 'jenis_ikans')->where('type', Uptd::TPI)->orderByDesc('created_at')->get();

        return $data;
    }
}
