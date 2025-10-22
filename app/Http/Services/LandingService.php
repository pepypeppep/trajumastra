<?php

namespace App\Http\Services;

use App\Models\Uptd;
use App\Models\Kalurahan;
use App\Models\Transaksi;
use App\Models\PelakuUsaha;
use App\Models\KelompokBinaan;
use App\Models\JadwalPenyuluhan;
use App\Models\MasterJenisUsaha;
use App\Models\MasterBentukUsaha;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\MasterRangePenghasilan;
use Illuminate\Support\Facades\Storage;
use App\Enums\JadwalPenyuluhanStatusEnum;

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
        $data = Uptd::with('kalurahan.kecamatan.kabupaten', 'jenis_ikans', 'stok_ikans')->where('type', Uptd::UPTD)->orderByDesc('created_at')->get();

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
        $data = MasterRangePenghasilan::all();
        return $data;
    }

    /* Get data Kalurahan */
    public function getKalurahan()
    {
        $data = Kalurahan::with('kecamatan.kabupaten')->get();
        return $data;
    }

    /* Get data chart pelaku usaha */
    public function getPelakuUsahaChart()
    {
        $data = DB::table('pelaku_usahas')
            ->join('kalurahans', 'pelaku_usahas.kalurahan_id', '=', 'kalurahans.id')
            ->whereNotNull('pelaku_usahas.kalurahan_id')
            ->select('kalurahans.name', DB::raw('COUNT(pelaku_usahas.id) as count'))
            ->groupBy('pelaku_usahas.kalurahan_id', 'kalurahans.name')
            ->orderBy('kalurahans.name')
            ->get();

        $result = [
            'data' => $data->pluck('count')->toArray(),
            'categories' => $data->pluck('name')->toArray()
        ];

        return $result;
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

    /* GET : All Jadwal Penyuluhan */
    public function getJadwalPenyuluhan()
    {
        $data = JadwalPenyuluhan::with('jenisPenyuluhan', 'kategori', 'penyuluhs')
            ->where('status', JadwalPenyuluhanStatusEnum::VERIFIED->value)
            ->orderBy('start', 'desc')
            ->get();
        
        $data->map(function ($item) {
            // Limit Name to 25 characters
            if (strlen($item->name) > 25) {
                $item->name = substr($item->name, 0, 25) . '...';
            } else {
                $item->name = $item->name;
            }

            // Limit Description to 50 characters
            if (strlen(strip_tags($item->description)) > 50) {
                // Limit Description to 50 characters
                $item->description = substr(strip_tags($item->description), 0, 50) . '...';
            } else {
                $item->description = strip_tags($item->description);
            }
            return $item;
        });

        return $data;
    }

    /* GET : Data jadwal penyuluhan by ID */
    public function getJadwalPenyuluhanById($id)
    {
        $jadwal = JadwalPenyuluhan::with('jenisPenyuluhan', 'kategori', 'penyuluhs')
            ->where('id', $id)
            ->first();

        $jadwal->penyuluhs->pluck('user.name');
        // validation attachment file is exists
        if ($jadwal->attachment && Storage::disk('local')->exists($jadwal->attachment)) {
            $jadwal->attachment_can_download = true;
        } else {
            $jadwal->attachment_can_download = false;
        }

        return $jadwal;
    }

    /* Download Jadwal Penyuluhan Attachment */
    public function downloadJadwalPenyuluhanAttachment($id)
    {
        $jadwal = JadwalPenyuluhan::findOrFail($id);

        if ($jadwal->attachment && Storage::disk('local')->exists($jadwal->attachment)) {
            return Storage::download($jadwal->attachment);
        } else {
            return redirect()->back()->withErrors(['error' => 'File lampiran tidak ditemukan.']);
        }
    }
}
