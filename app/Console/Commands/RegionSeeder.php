<?php

namespace App\Console\Commands;

use App\Models\Kabupaten;
use App\Models\Kalurahan;
use App\Models\Kecamatan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RegionSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'region:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill database with regions data from BPS API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reqKab = Http::get('https://sig.bps.go.id/rest-bridging/getwilayah?level=kabupaten&parent=34&periode_merge=2024_1.2025');
        $respKab = $reqKab->json();
        foreach ($respKab as $val) {
            Kabupaten::updateOrCreate([
                'provinsi_id' => 34,
                'kode_bps' => $val['kode_bps'],
                'kode_kemendagri' => $val['kode_dagri'],
                'name' => str_replace('KABUPATEN ', '', $val['nama_dagri']),
            ]);
        }

        $kabs = Kabupaten::all();
        foreach ($kabs as $kab) {
            $reqKec = Http::get('https://sig.bps.go.id/rest-bridging/getwilayah?level=kecamatan&parent=' . $kab->kode_bps . '&periode_merge=2024_1.2025');
            $respKec = $reqKec->json();
            foreach ($respKec as $val) {
                Kecamatan::updateOrCreate([
                    'kabupaten_id' => $kab->id,
                    'kode_bps' => $val['kode_bps'],
                    'kode_kemendagri' => $val['kode_dagri'],
                    'name' => $val['nama_dagri'],
                ]);
            }
        }

        $kecs = Kecamatan::all();
        foreach ($kecs as $kec) {
            $reqKal = Http::get('https://sig.bps.go.id/rest-bridging/getwilayah?level=desa&parent=' . $kec->kode_bps . '&periode_merge=2024_1.2025');
            $respKal = $reqKal->json();
            foreach ($respKal as $val) {
                Kalurahan::updateOrCreate([
                    'kecamatan_id' => $kec->id,
                    'kode_bps' => $val['kode_bps'],
                    'kode_kemendagri' => $val['kode_dagri'],
                    'name' => $val['nama_dagri'],
                ]);
            }
        }
    }
}
