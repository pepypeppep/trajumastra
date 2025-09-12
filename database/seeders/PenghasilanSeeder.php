<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterRangePenghasilan;

class PenghasilanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterRangePenghasilan::create(['name' => 'Kurang dari Rp 1.000.000']);
        MasterRangePenghasilan::create(['name' => 'Rp 1.000.000 - Rp 3.000.000']);
        MasterRangePenghasilan::create(['name' => 'Rp 3.000.000 - Rp 5.000.000']);
        MasterRangePenghasilan::create(['name' => 'Rp 5.000.000 - Rp 10.000.000']);
        MasterRangePenghasilan::create(['name' => 'Rp 10.000.000 - Rp 20.000.000']);
        MasterRangePenghasilan::create(['name' => 'Rp 20.000.000 - Rp 50.000.000']);
        MasterRangePenghasilan::create(['name' => 'Rp 50.000.000 - Rp 100.000.000']);
    }
}
