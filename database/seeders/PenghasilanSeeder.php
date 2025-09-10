<?php

namespace Database\Seeders;

use App\Models\MasterPenghasilan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenghasilanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterPenghasilan::create(['name' => 'Kurang dari Rp 1.000.000']);
        MasterPenghasilan::create(['name' => 'Rp 1.000.000 - Rp 3.000.000']);
        MasterPenghasilan::create(['name' => 'Rp 3.000.000 - Rp 5.000.000']);
        MasterPenghasilan::create(['name' => 'Rp 5.000.000 - Rp 10.000.000']);
        MasterPenghasilan::create(['name' => 'Rp 10.000.000 - Rp 20.000.000']);
        MasterPenghasilan::create(['name' => 'Rp 20.000.000 - Rp 50.000.000']);
        MasterPenghasilan::create(['name' => 'Rp 50.000.000 - Rp 100.000.000']);
    }
}
