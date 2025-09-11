<?php

namespace App\Http\Services;

use App\Models\Uptd;
use App\Models\Kalurahan;
use App\Models\Transaksi;
use App\Models\KelompokBinaan;
use App\Models\MasterJenisUsaha;
use App\Models\MasterBentukUsaha;
use App\Models\MasterPenghasilan;
use App\Models\PelakuUsaha;
use Illuminate\Support\Facades\DB;
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

    /* Get data transaction */
    public function getTransaction()
    {
        $data = Transaksi::with('uptd')->orderByDesc('created_at')->limit(15)->get();

        return $data;
    }

    /* Get data Jenis Usaha */
    public function getJenisUsaha()
    {
        $data = MasterJenisUsaha::all();
        return $data;
    }

    /* Get data Bentuk Usaha */
    public function getBentukUsaha()
    {
        $data = MasterBentukUsaha::all();
        return $data;
    }

    /* Get data Kelompok Binaan */
    public function getKelompokBinaan()
    {
        $data = KelompokBinaan::all();
        return $data;
    }

    /* Get data Penghasilan */
    public function getPenghasilan()
    {
        $data = MasterPenghasilan::all();
        return $data;
    }

    /* Get data Kalurahan */
    public function getKalurahan()
    {
        $data = Kalurahan::with('kecamatan.kabupaten')->get();
        return $data;
    }

    public function store(array $attributes)
    {
        try {
            DB::beginTransaction();

            $data = PelakuUsaha::create([
                'kalurahan_id' => $attributes['kalurahan'],
                'kelompok_binaan_id' => $attributes['kelompokBinaan'],
                'bentuk_usaha_id' => $attributes['bentukUsaha'],
                'jenis_usaha_id' => $attributes['jenisUsaha'],
                'address' => $attributes['alamat'],
                'npwp' => $attributes['npwp'],
                'siup' => $attributes['siup'],
                'phone' => $attributes['phone'],
                'email' => $attributes['email'],
                'income_range' => $attributes['rangePenghasilan'],
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Data gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }
}
