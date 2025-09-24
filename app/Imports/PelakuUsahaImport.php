<?php

namespace App\Imports;

use App\Models\MasterBentukUsaha;
use App\Models\PelakuUsaha;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PelakuUsahaImport implements ToCollection, WithHeadingRow
{

    public function headingRow(): int
    {
        // Header berada di baris ke-5 di file Excel
        return 5;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Abaikan baris kosong total
            if ($row->filter(fn($v) => !is_null($v) && $v !== '')->isEmpty()) {
                continue;
            }

            // Ambil kolom-kolom kiri template (formatter slug: spasi → underscore)
            $nama             = (string) ($row['nama_pelaku_usaha'] ?? '');
            $email            = (string) ($row['email'] ?? '');
            $address           = (string) ($row['alamat'] ?? '');
            $jenisUsaha       = (string) ($row['jenis_usaha'] ?? '');
            $bentukUsaha      = (string) ($row['bentuk_usaha'] ?? '');
            $npwp             = isset($row['npwp']) ? (string) $row['npwp'] : null;
            $nib              = isset($row['nib']) ? (string) $row['nib'] : null;
            $rangePenghasilan = (string) ($row['range_penghasilan'] ?? '');
            $memilikiKapalRaw = (string) ($row['memiliki_kapal'] ?? '');

            // Normalisasi boolean "YA"/"TIDAK"
            $memilikiKapal = in_array(Str::upper(trim($memilikiKapalRaw)), ['YA','Y','YES','1'], true);

            // (Opsional) bersihkan spasi/strip di NPWP/NIB
            $npwp = $npwp ? preg_replace('/\D+/', '', $npwp) : null;
            $nib  = $nib  ? preg_replace('/\D+/', '', $nib)  : null;

            // Strategi anti-duplikat:
            // - Prioritaskan NIB, fallback ke NPWP, lalu email
            $existing = null;
            if ($nib) {
                $existing = PelakuUsaha::where('nib', $nib)->first();
            }
            if (!$existing && $npwp) {
                $existing = PelakuUsaha::where('npwp', $npwp)->first();
            }
            if (!$existing && $email) {
                $existing = PelakuUsaha::where('email', $email)->first();
            }

            // Get Bentuk Usaha ID
            $bentukUsahaId = MasterId::where('name', 'LIKE', $bentukUsaha)->first()?->id;
            if (!$bentukUsahaId) {
                // Jika bentuk usaha tidak ditemukan, skip baris ini
                continue;
            }
            // Get Jenis Usaha ID
            $jenisUsahaId = MasterBentukUsaha::where('name', 'LIKE', $jenisUsaha)->first()?->id;
            if (!$jenisUsahaId) {
                // Jika jenis usaha tidak ditemukan, skip baris ini
                continue;
            }

            $payload = [
                'nama_pelaku_usaha' => $nama,
                'email'             => $email ?: null,
                'address'            => $address ?: null,
                'jenis_usaha'       => $jenisUsahaId,
                'bentuk_usaha'      => $bentukUsahaId,
                'npwp'              => $npwp,
                'nib'               => $nib,
                'income_range' => $rangePenghasilan,
                'is_import' => 1,
                'have_ship'    => $memilikiKapal,
            ];

            if ($existing) {
                $existing->update($payload);
            } else {
                PelakuUsaha::create($payload);
            }
        }
    }
}
