<?php

namespace App\Exports;

use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnFormatting
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function map($transaksi): array
    {
        static $counter = 1;

        return [
            $counter++,
            $transaksi->invoice_id,
            Carbon::parse($transaksi->created_at)->format('d/m/Y'),
            $transaksi->uptd->name,
            $transaksi->staff->name,
            $transaksi->total, // The value remains numeric, formatting is applied via WithColumnFormatting
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Invoice ID',
            'Tanggal',
            'UPTD',
            'Petugas',
            'Nominal'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            'A' => ['width' => 5],
            'B' => ['width' => 15],
            'C' => ['width' => 12],
            'D' => ['width' => 20],
            'E' => ['width' => 20],
            'F' => ['width' => 15],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => '"Rp"#,##0',
        ];
    }
}
