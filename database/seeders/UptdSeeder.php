<?php

namespace Database\Seeders;

use App\Models\Uptd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UptdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uptds = Uptd::get();

        foreach ($uptds as $uptd) {
            $uptd->update([
                'phone' => fake()->phoneNumber
            ]);
        }
    }
}
