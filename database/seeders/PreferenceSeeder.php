<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'group' => 'site',
                'name' => 'app_name',
                'is_asset' => false,
                'value' => 'Trajumastra',
            ],
            [
                'group' => 'site',
                'name' => 'title',
                'is_asset' => false,
                'value' => 'Trajumastra',
            ],
            [
                'group' => 'site',
                'name' => 'copyright',
                'is_asset' => false,
                'value' => '2025 &copy; Copyright <strong><span>Trajumastra</span></strong>. All Rights Reserved',
            ],
            [
                'group' => 'site',
                'name' => 'credits',
                'is_asset' => false,
                'value' => 'Designed by <a href="https://my_project.com/">Trajumastra</a>',
            ],
            [
                'group' => 'site',
                'name' => 'logo',
                'is_asset' => true,
                // 'value' => 'assets/images/trajumastra_logo.svg', // (Bentuk persegi)
                'value' => 'assets/images/logo.svg',
            ],
            [
                'group' => 'site',
                'name' => 'favicon',
                'is_asset' => true,
                'value' => 'assets/images/trajumastra.svg',
            ]
        ];
        
        DB::table('preferences')->insert($data);
    }
}
