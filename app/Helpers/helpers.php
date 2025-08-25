<?php

if (!function_exists('rupiah')) {
    function rupiah($data)
    {
        return 'Rp' . number_format($data, 2, ',', '.');
    }
}
