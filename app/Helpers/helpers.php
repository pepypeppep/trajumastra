<?php

use Carbon\Carbon;

if (!function_exists('rupiah')) {
    function rupiah($data)
    {
        return 'Rp' . number_format($data, 0, ',', '.') . ',-';
    }
}

if (!function_exists('tanggal_indonesia')) {
    function tanggal_indonesia($tanggal)
    {
        return Carbon::parse($tanggal)->translatedFormat('d F Y');
    }
}

// Helpers for check data usage in another table before delete
if (!function_exists('isDataUsed')) {
    function isDataUsed($dataId, $column, array $tables)
    {
        foreach ($tables as $table) {
            if (DB::table($table)->where($column, $dataId)->exists()) {
                return true;
            }
        }
        return false;
    }
}
