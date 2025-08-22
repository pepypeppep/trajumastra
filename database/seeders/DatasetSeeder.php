<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatasetSeeder extends Seeder
{
    public function run()
    {
        // Artisan::call('seed:csv', ['directory' => Storage::disk('local')->path('trajumastra_db/')]);
        Artisan::call('seed:csv', ['directory' => database_path('datasets/2025-08-19/')]);
    }
}
