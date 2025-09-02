<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\MasterJenisIkan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisIkanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::disk('local')->deleteDirectory('ikan');
        $jenisIkans = MasterJenisIkan::all();
        foreach ($jenisIkans as $jenisIkan) {
            $file = trim(str_replace(" ", "-", strtolower($jenisIkan->name))) . '.png';
            $filePath = database_path('datasets/Ikan/') . $file;
            $filename = null;
            if (file_exists($filePath)) {
                $filename = 'ikan/' . Str::uuid() . '.png';
                Storage::disk('local')->put($filename, file_get_contents($filePath));
            }

            $jenisIkan->update([
                'image' => $filename
            ]);
        }
    }
}
