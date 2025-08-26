<?php

use Carbon\Carbon;

if (!function_exists('rupiah')) {
    function rupiah($data)
    {
        return 'Rp' . number_format($data, 2, ',', '.');
    }
}

if (!function_exists('tanggal_indonesia')) {
    function tanggal_indonesia($tanggal)
    {
        return Carbon::parse($tanggal)->translatedFormat('d F Y');
    }
}
