<?php
// app/Exports/TemplatePelakuUsahaExport.php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\NamedRange;

class TemplateImportPelakuUsahaExport implements WithMultipleSheets
{
    public function __construct(
        public array $listJenisUsaha,
        public array $listBentukUsaha,
        public array $listRangePenghasilan = ['< 1 Juta', '1-3 Juta', '3-5 Juta', '> 5 Juta'],
        public array $listKelompokBinaan,
        public array $listKalurahan
    ) {}

    public function sheets(): array
    {
        // Urutan penting: Dataset dibuat dulu supaya bisa direferensikan
        $datasetSheet = new TemplateDatasetSheet(
            listJenisUsaha: $this->listJenisUsaha,
            listBentukUsaha: $this->listBentukUsaha,
            listRangePenghasilan: $this->listRangePenghasilan,
            listKelompokBinaan: $this->listKelompokBinaan,
            listKalurahan: $this->listKalurahan
        );

        $templateSheet = new TemplateMainSheet(
            listJenisUsaha: $this->listJenisUsaha,
            listBentukUsaha: $this->listBentukUsaha,
            listRangePenghasilan: $this->listRangePenghasilan,
            listKelompokBinaan: $this->listKelompokBinaan,
            listKalurahan: $this->listKalurahan
        );

        return [$datasetSheet, $templateSheet];
    }
}

/**
 * Sheet: Dataset (berisi semua referensi di kolom terpisah)
 */
class TemplateDatasetSheet implements FromArray, ShouldAutoSize, WithTitle, WithEvents
{
    public function __construct(
        private array $listJenisUsaha,
        private array $listBentukUsaha,
        private array $listRangePenghasilan,
        private array $listKelompokBinaan,
        private array $listKalurahan
    ) {}

    public function title(): string
    {
        return 'Dataset';
    }

    public function array(): array
    {
        // Header kolom
        $rows = [[
            'Kalurahan',
            'Kelompok Binaan',
            'Jenis Usaha',
            'Bentuk Usaha',
            'Range Penghasilan',
        ]];

        // Maks baris = jumlah terbesar dari semua list
        $max = max(
            count($this->listKalurahan),
            count($this->listKelompokBinaan),
            count($this->listJenisUsaha),
            count($this->listBentukUsaha),
            count($this->listRangePenghasilan),
        );

        for ($i = 0; $i < $max; $i++) {
            $rows[] = [
                $this->listKalurahan[$i]       ?? null,
                $this->listKelompokBinaan[$i]  ?? null,
                $this->listJenisUsaha[$i]      ?? null,
                $this->listBentukUsaha[$i]     ?? null,
                $this->listRangePenghasilan[$i]?? null,
            ];
        }

        return $rows;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $workbook = $sheet->getParent();

                // Hitung last row masing-masing kolom (header di baris 1)
                $lastKalurahan       = 1 + max(1, count($this->listKalurahan));
                $lastKelompokBinaan  = 1 + max(1, count($this->listKelompokBinaan));
                $lastJenisUsaha      = 1 + max(1, count($this->listJenisUsaha));
                $lastBentukUsaha     = 1 + max(1, count($this->listBentukUsaha));
                $lastRangePenghasilan= 1 + max(1, count($this->listRangePenghasilan));

                $sheetName = $sheet->getTitle(); // "Dataset"

                // Buat Named Range agar bisa dipakai DataValidation di sheet lain
                $workbook->addNamedRange(new NamedRange('REF_KALURAHAN',         $sheet, '$A$2:$A$'.$lastKalurahan));
                $workbook->addNamedRange(new NamedRange('REF_KELOMPOK_BINAAN',   $sheet, '$B$2:$B$'.$lastKelompokBinaan));
                $workbook->addNamedRange(new NamedRange('REF_JENIS_USAHA',       $sheet, '$C$2:$C$'.$lastJenisUsaha));
                $workbook->addNamedRange(new NamedRange('REF_BENTUK_USAHA',      $sheet, '$D$2:$D$'.$lastBentukUsaha));
                $workbook->addNamedRange(new NamedRange('REF_RANGE_PENGHASILAN', $sheet, '$E$2:$E$'.$lastRangePenghasilan));
            },
        ];
    }
}

/**
 * Sheet: Template (input utama + data validation mengacu ke Named Range di sheet Dataset)
 */
class TemplateMainSheet implements FromArray, WithEvents, ShouldAutoSize, WithTitle
{
    // Data mulai baris 6, header di baris 5 (mengikuti template lama)
    const START_ROW = 6;
    const END_ROW   = 1005; // ubah jika perlu (1000 baris input)

    public function __construct(
        private array $listJenisUsaha,
        private array $listBentukUsaha,
        private array $listRangePenghasilan,
        private array $listKelompokBinaan,
        private array $listKalurahan
    ) {}

    public function title(): string
    {
        return 'Template';
    }

    public function array(): array
    {
        // Baris 1-4: instruksi (opsional)
        $rows = [
            ['TEMPLATE IMPORT DATA PELAKU USAHA'],
            ['WAJIB GUNAKAN TEMPLATE INI KETIKA INGIN IMPORT'],
            ['Perhatian : Isikan data pelaku usaha sesuai kolom'],
            [null],
        ];

        // Baris 5: header (samakan persis dengan saat import)
        $rows[] = ['No','Nama Pelaku Usaha','Email','Kalurahan','Alamat','Kelompok Binaan','Jenis Usaha','Bentuk Usaha','NPWP','NIB','Range Penghasilan','Memiliki Kapal'];

        // (opsional) 1 baris contoh kosong
        $rows[] = ['1', null, null, null, null, null, null, null, null, null, null, null];

        return $rows;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet    = $event->sheet->getDelegate();

                // Helper: bikin DataValidation LIST (pakai Named Range)
                $makeListValidation = function(string $namedRange): DataValidation {
                    $dv = new DataValidation();
                    $dv->setType(DataValidation::TYPE_LIST);
                    $dv->setErrorStyle(DataValidation::STYLE_STOP);
                    $dv->setAllowBlank(true);
                    $dv->setShowInputMessage(true);
                    $dv->setShowErrorMessage(true);
                    $dv->setShowDropDown(true);
                    $dv->setErrorTitle('Pilihan tidak valid');
                    $dv->setError('Nilai tidak ada di daftar referensi.');
                    $dv->setPromptTitle('Pilih dari daftar');
                    $dv->setPrompt('Gunakan dropdown untuk memilih nilai yang valid.');
                    // Penting: referensi ke Named Range (bukan ke sheet langsung)
                    $dv->setFormula1("={$namedRange}");
                    return $dv;
                };

                // Data validation berdasarkan Named Range yang dibuat di sheet Dataset
                $dvKalurahan       = $makeListValidation('REF_KALURAHAN');          // kolom D
                $dvKelompokBinaan  = $makeListValidation('REF_KELOMPOK_BINAAN');    // kolom F
                $dvJenisUsaha      = $makeListValidation('REF_JENIS_USAHA');        // kolom G
                $dvBentukUsaha     = $makeListValidation('REF_BENTUK_USAHA');       // kolom H
                $dvIncomeRange     = $makeListValidation('REF_RANGE_PENGHASILAN');  // kolom K

                // Memiliki Kapal: daftar statis "YA","TIDAK"
                $dvKapal = new DataValidation();
                $dvKapal->setType(DataValidation::TYPE_LIST);
                $dvKapal->setErrorStyle(DataValidation::STYLE_STOP);
                $dvKapal->setAllowBlank(true);
                $dvKapal->setShowInputMessage(true);
                $dvKapal->setShowErrorMessage(true);
                $dvKapal->setShowDropDown(true);
                $dvKapal->setErrorTitle('Pilihan tidak valid');
                $dvKapal->setError('Pilih YA atau TIDAK.');
                $dvKapal->setPromptTitle('Pilih dari daftar');
                $dvKapal->setPrompt('Gunakan dropdown.');
                $dvKapal->setFormula1('"YA,TIDAK"'); // list literal

                // Terapkan ke rentang input dari START_ROW..END_ROW
                for ($row = self::START_ROW; $row <= self::END_ROW; $row++) {
                    $sheet->getCell("D{$row}")->setDataValidation(clone $dvKalurahan);
                    $sheet->getCell("F{$row}")->setDataValidation(clone $dvKelompokBinaan);
                    $sheet->getCell("G{$row}")->setDataValidation(clone $dvJenisUsaha);
                    $sheet->getCell("H{$row}")->setDataValidation(clone $dvBentukUsaha);
                    $sheet->getCell("K{$row}")->setDataValidation(clone $dvIncomeRange);
                    $sheet->getCell("L{$row}")->setDataValidation(clone $dvKapal);
                }

                // (Opsional) Freeze header di baris 6 (baris data pertama)
                $sheet->freezePane('A6');

                // (Opsional) Tambah format minimal di header
                $event->sheet->getStyle('A5:L5')->getFont()->setBold(true);
            },
        ];
    }
}
