<?php

namespace App\Imports;

use App\Models\Kalurahan;
use App\Models\PelakuUsaha;
use Illuminate\Support\Str;
use App\Models\KelompokBinaan;
use App\Models\MasterJenisUsaha;
use App\Models\MasterBentukUsaha;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PelakuUsahaImport implements WithMultipleSheets
{
    public function __construct() {
        $this->templateHandler = new PelakuUsahaTemplateSheetImport();
    }

    /**
     * Hanya proses sheet bernama "Template".
     * Sheet lain (mis. "Dataset") akan diabaikan.
     */
    public function sheets(): array
    {
        return [
            'Template' => new PelakuUsahaTemplateSheetImport(),
        ];
    }

    public function getFailedRows(): array
    {
        return $this->templateHandler->getFailedRows();
    }
}

/**
 * Importer khusus untuk sheet "Template"
 */
class PelakuUsahaTemplateSheetImport implements ToCollection, WithHeadingRow
{
    protected array $failedRows = [];

    public function __construct() {}

    public function getFailedRows(): array { return $this->failedRows; }

    private function addFail(int $rowNum, array $values, array $errors): void
    {
        $this->failedRows[] = ['row' => $rowNum, 'values' => $values, 'errors' => $errors];
    }

    private function lookup(array $map, ?string $name): ?int
    {
        if (!$name) return null;
        $key = mb_strtolower(trim($name));
        return $map[$key] ?? null;
    }

    public function headingRow(): int
    {
        // Header berada di baris ke-5 di file Excel.
        return 5;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $i => $row) {
            $excelRow = $this->headingRow() + 1 + $i; // 5 + 1 + 0 = 6
            
            // Abaikan baris kosong total
            if ($row->filter(fn($field) => !is_null($field) && $field !== '')->isEmpty()) {
                continue;
            }

            // Ambil kolom-kolom
            $nama             = (string) ($row['nama_pelaku_usaha'] ?? '');
            $email            = (string) ($row['email'] ?? '');
            $kalurahan        = (string) ($row['kalurahan'] ?? '');
            $address          = (string) ($row['alamat'] ?? '');
            $kelompokBinaan   = (string) ($row['kelompok_binaan'] ?? '');
            $jenisUsaha       = (string) ($row['jenis_usaha'] ?? '');
            $bentukUsaha      = (string) ($row['bentuk_usaha'] ?? '');
            $npwp             = isset($row['npwp']) ? (string) $row['npwp'] : null;
            $nib              = isset($row['nib']) ? (string) $row['nib'] : null;
            $rangePenghasilan = (string) ($row['range_penghasilan'] ?? '');
            $memilikiKapalRaw = (string) ($row['memiliki_kapal'] ?? '');

            // Convert boolean "YA"/"TIDAK" to true/false
            $memilikiKapal = in_array(Str::upper(trim($memilikiKapalRaw)), ['YA','Y','YES','1'], true);

            // Bersihkan NPWP/NIB dari karakter non-digit
            // Simpan hanya digitnya saja
            $npwp = $npwp ? preg_replace('/\D+/', '', $npwp) : null;
            $nib  = $nib  ? preg_replace('/\D+/', '', $nib)  : null;

            // Cek duplikat
            $existing = null;
            if ($nib) {
                $existing = PelakuUsaha::where('siup', $nib)->first();
            }
            if (!$existing && $npwp) {
                $existing = PelakuUsaha::where('npwp', $npwp)->first();
            }
            if (!$existing && $email) {
                $existing = PelakuUsaha::where('email', $email)->first();
            }

            /* Convert String (Kalurahan, Kelompok Binaan, Bentuk Usaha) to Int (Kalurahan ID, Kelompok Binaan ID, Bentuk Usaha ID) For GET ID Reference in Parent DB Table*/
            
            // Validasi referensi
            $errors = [];

            // Kalurahan
            $kalurahanId = null;
            if ($kalurahan) {
                $kalurahanId = Kalurahan::where('name', 'LIKE', $kalurahan)->first()?->id;
                if (!$kalurahanId) {
                    $errors['kalurahan'] = 'Tidak ditemukan di referensi';
                }
            }

            // Kelompok Binaan
            $kelompokBinaanId = null;
            if ($kelompokBinaan) {
                $kelompokBinaanId = KelompokBinaan::where('name', 'LIKE', $kelompokBinaan)->first()?->id;
                if (!$kelompokBinaanId) {
                    $errors['kelompok_binaan'] = 'Tidak ditemukan di referensi';
                }
            }

            // Bentuk Usaha
            $bentukUsahaId = null;
            if ($bentukUsaha) {
                $bentukUsahaId = MasterBentukUsaha::where('name', 'LIKE', $bentukUsaha)->first()?->id;
                if (!$bentukUsahaId) {
                    $errors['bentuk_usaha'] = 'Tidak ditemukan di referensi';
                }
            }

            // Jenis Usaha
            $jenisUsahaId = null;
            if ($jenisUsaha) {
                $jenisUsahaId = MasterJenisUsaha::where('name', 'LIKE', $jenisUsaha)->first()?->id;
                if (!$jenisUsahaId) {
                    $errors['jenis_usaha'] = 'Tidak ditemukan di referensi';
                }
            }

            // Jika ada error, catat & lanjut
            if (!empty($errors)) {
                $this->addFail($excelRow, $row->toArray(), $errors);
                continue;
            }

            $payload = [
                'kalurahan_id'        => $kalurahanId ?: null, // <- idealnya pakai $kalurahanId
                'kelompok_binaan_id'  => $kelompokBinaanId ?: null,
                'bentuk_usaha_id'     => $bentukUsahaId,
                'jenis_usaha_id'      => $jenisUsahaId,
                'name'                => $nama,
                'address'             => $address ?: null,
                'npwp'                => $npwp,
                'siup'                => $nib,
                'email'               => $email ?: null,
                'income_range'        => $rangePenghasilan,
                'is_import'           => 1,
                'have_ship'           => $memilikiKapal,
            ];

            if ($existing) {
                Log::info('Updating existing PelakuUsaha ID ' . $existing->id);
                $existing->update($payload);
            } else {
                Log::info('Creating new PelakuUsaha: ' . json_encode($payload));
                PelakuUsaha::create($payload);
            }
        }
    }
}
