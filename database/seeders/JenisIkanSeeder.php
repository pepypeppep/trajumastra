<?php

namespace Database\Seeders;

use App\Models\Uptd;
use App\Models\HargaIkan;
use Illuminate\Support\Str;
use App\Models\MasterJenisIkan;
use App\Models\StokIkan;
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
        // Storage::disk('local')->deleteDirectory('ikan');
        // $jenisIkans = MasterJenisIkan::all();
        // foreach ($jenisIkans as $jenisIkan) {
        //     $file = trim(str_replace(" ", "-", strtolower($jenisIkan->name))) . '.png';
        //     $filePath = database_path('datasets/Ikan/') . $file;
        //     $filename = null;
        //     if (file_exists($filePath)) {
        //         $filename = 'ikan/' . Str::uuid() . '.png';
        //         Storage::disk('local')->put($filename, file_get_contents($filePath));
        //     }

        //     $jenisIkan->update([
        //         'image' => $filename
        //     ]);
        // }

        $datas = [
            [
                "no" => 1,
                "name" => "Mas",
                "size" => "ukuran 2-3 cm",
                "unit" => "ekor",
                "price" => "Rp45",
                "spelled" => "empat puluh lima rupiah"
            ],
            [
                "no" => 2,
                "name" => "Mas",
                "size" => "ukuran 3-5 cm",
                "unit" => "ekor",
                "price" => "Rp90",
                "spelled" => "sembilan puluh rupiah"
            ],
            [
                "no" => 3,
                "name" => "Mas",
                "size" => "ukuran 5-7 cm",
                "unit" => "ekor",
                "price" => "Rp150",
                "spelled" => "seratus lima puluh rupiah"
            ],
            [
                "no" => 4,
                "name" => "Mas",
                "size" => "ukuran 7-9 cm",
                "unit" => "ekor",
                "price" => "Rp225",
                "spelled" => "dua ratus dua puluh lima rupiah"
            ],
            [
                "no" => 5,
                "name" => "Mas",
                "size" => "ukuran 9-12 cm",
                "unit" => "kg",
                "price" => "Rp27.000",
                "spelled" => "dua puluh tujuh ribu rupiah"
            ],
            [
                "no" => 6,
                "name" => "Mas",
                "size" => "ukuran >12 cm",
                "unit" => "kg",
                "price" => "Rp25.000",
                "spelled" => "dua puluh lima ribu rupiah"
            ],
            [
                "no" => 7,
                "name" => "Mas",
                "size" => "Konsumsi/ induk afkir",
                "unit" => "kg",
                "price" => "Rp25.000",
                "spelled" => "dua puluh lima ribu rupiah"
            ],
            [
                "no" => 8,
                "name" => "Tawes",
                "size" => "ukuran 2-3 cm",
                "unit" => "ekor",
                "price" => "Rp40",
                "spelled" => "empat puluh rupiah"
            ],
            [
                "no" => 9,
                "name" => "Tawes",
                "size" => "ukuran 3-5 cm",
                "unit" => "ekor",
                "price" => "Rp80",
                "spelled" => "delapan puluh rupiah"
            ],
            [
                "no" => 10,
                "name" => "Tawes",
                "size" => "ukuran 5-7 cm",
                "unit" => "ekor",
                "price" => "Rp125",
                "spelled" => "seratus dua puluh lima rupiah"
            ],
            [
                "no" => 11,
                "name" => "Tawes",
                "size" => "ukuran 7-9 cm",
                "unit" => "ekor",
                "price" => "Rp200",
                "spelled" => "dua ratus rupiah"
            ],
            [
                "no" => 12,
                "name" => "Tawes",
                "size" => "ukuran 9-12 cm",
                "unit" => "kg",
                "price" => "Rp24.000",
                "spelled" => "dua puluh empat ribu rupiah"
            ],
            [
                "no" => 13,
                "name" => "Tawes",
                "size" => "ukuran >12 cm",
                "unit" => "kg",
                "price" => "Rp22.000",
                "spelled" => "dua puluh dua ribu rupiah"
            ],
            [
                "no" => 14,
                "name" => "Tawes",
                "size" => "ukuran Konsumsi/ induk afkir",
                "unit" => "kg",
                "price" => "Rp22.000",
                "spelled" => "dua puluh dua ribu rupiah"
            ],
            [
                "no" => 15,
                "name" => "Nila Hitam",
                "size" => "ukuran 2-3 cm",
                "unit" => "ekor",
                "price" => "Rp40",
                "spelled" => "empat puluh rupiah"
            ],
            [
                "no" => 16,
                "name" => "Nila Hitam",
                "size" => "ukuran 3-5 cm",
                "unit" => "ekor",
                "price" => "Rp80",
                "spelled" => "delapan puluh rupiah"
            ],
            [
                "no" => 17,
                "name" => "Nila Hitam",
                "size" => "ukuran 5-7 cm",
                "unit" => "ekor",
                "price" => "Rp125",
                "spelled" => "seratus dua puluh lima rupiah"
            ],
            [
                "no" => 18,
                "name" => "Nila Hitam",
                "size" => "ukuran 7-9 cm",
                "unit" => "ekor",
                "price" => "Rp200",
                "spelled" => "dua ratus rupiah"
            ],
            [
                "no" => 19,
                "name" => "Nila Hitam",
                "size" => "ukuran 9-12 cm",
                "unit" => "kg",
                "price" => "Rp24.000",
                "spelled" => "dua puluh empat ribu rupiah"
            ],
            [
                "no" => 20,
                "name" => "Nila Hitam",
                "size" => "ukuran >12 cm",
                "unit" => "kg",
                "price" => "Rp22.000",
                "spelled" => "dua puluh dua ribu rupiah"
            ],
            [
                "no" => 21,
                "name" => "Nila Hitam",
                "size" => "Konsumsi/ induk afkir",
                "unit" => "kg",
                "price" => "Rp22.000",
                "spelled" => "dua puluh dua ribu rupiah"
            ],
            [
                "no" => 22,
                "name" => "Nila Merah",
                "size" => "ukuran 2-3 cm",
                "unit" => "ekor",
                "price" => "Rp45",
                "spelled" => "empat puluh lima rupiah"
            ],
            [
                "no" => 23,
                "name" => "Nila Merah",
                "size" => "ukuran 3-5 cm",
                "unit" => "ekor",
                "price" => "Rp90",
                "spelled" => "sembilan puluh rupiah"
            ],
            [
                "no" => 24,
                "name" => "Nila Merah",
                "size" => "ukuran 5-7 cm",
                "unit" => "ekor",
                "price" => "Rp150",
                "spelled" => "seratus lima puluh rupiah"
            ],
            [
                "no" => 25,
                "name" => "Nila Merah",
                "size" => "ukuran 7-9 cm",
                "unit" => "ekor",
                "price" => "Rp225",
                "spelled" => "dua ratus dua puluh lima rupiah"
            ],
            [
                "no" => 26,
                "name" => "Nila Merah",
                "size" => "ukuran 9-12 cm",
                "unit" => "kg",
                "price" => "Rp27.000",
                "spelled" => "dua puluh tujuh ribu rupiah"
            ],
            [
                "no" => 27,
                "name" => "Nila Merah",
                "size" => "ukuran >12 cm",
                "unit" => "kg",
                "price" => "Rp25.000",
                "spelled" => "dua puluh lima ribu rupiah"
            ],
            [
                "no" => 28,
                "name" => "Nila Merah",
                "size" => "Konsumsi/ induk afkir",
                "unit" => "kg",
                "price" => "Rp25.000",
                "spelled" => "dua puluh lima ribu rupiah"
            ],
            [
                "no" => 29,
                "name" => "Lele",
                "size" => "ukuran 2-3 cm",
                "unit" => "ekor",
                "price" => "Rp40",
                "spelled" => "empat puluh rupiah"
            ],
            [
                "no" => 30,
                "name" => "Lele",
                "size" => "ukuran 3-5 cm",
                "unit" => "ekor",
                "price" => "Rp120",
                "spelled" => "seratus dua puluh rupiah"
            ],
            [
                "no" => 31,
                "name" => "Lele",
                "size" => "ukuran 5-7 cm",
                "unit" => "ekor",
                "price" => "Rp200",
                "spelled" => "dua ratus rupiah"
            ],
            [
                "no" => 32,
                "name" => "Lele",
                "size" => "ukuran 7-9 cm",
                "unit" => "ekor",
                "price" => "Rp275",
                "spelled" => "dua ratus tujuh puluh lima rupiah"
            ],
            [
                "no" => 33,
                "name" => "Lele",
                "size" => "ukuran >9 cm",
                "unit" => "kg",
                "price" => "Rp20.000",
                "spelled" => "dua puluh ribu rupiah"
            ],
            [
                "no" => 34,
                "name" => "Lele",
                "size" => "Komsumsi/ induk afkir",
                "unit" => "kg",
                "price" => "Rp17.000",
                "spelled" => "tujuh belas ribu rupiah"
            ],
            [
                "no" => 35,
                "name" => "Calon Induk Lele",
                "size" => "0,5 – 1 kg",
                "unit" => "ekor",
                "price" => "Rp60.000",
                "spelled" => "enam puluh ribu rupiah"
            ],
            [
                "no" => 36,
                "name" => "Calon Induk Lele",
                "size" => "> 1 kg",
                "unit" => "ekor",
                "price" => "Rp85.000",
                "spelled" => "delapan puluh lima ribu rupiah"
            ],
            [
                "no" => 37,
                "name" => "Telur Gurami",
                "size" => "-",
                "unit" => "butir",
                "price" => "Rp70",
                "spelled" => "tujuh puluh rupiah"
            ],
            [
                "no" => 38,
                "name" => "Gurami",
                "size" => "ukuran 1-2 cm",
                "unit" => "ekor",
                "price" => "Rp200",
                "spelled" => "dua ratus rupiah"
            ],
            [
                "no" => 39,
                "name" => "Gurami",
                "size" => "ukuran 2-3 cm",
                "unit" => "ekor",
                "price" => "Rp400",
                "spelled" => "empat ratus rupiah"
            ],
            [
                "no" => 40,
                "name" => "Gurami",
                "size" => "ukuran 3-5 cm",
                "unit" => "ekor",
                "price" => "Rp1.000",
                "spelled" => "seribu rupiah"
            ],
            [
                "no" => 41,
                "name" => "Gurami",
                "size" => "ukuran 5-7 cm",
                "unit" => "ekor",
                "price" => "Rp1.500",
                "spelled" => "seribu lima ratus rupiah"
            ],
            [
                "no" => 42,
                "name" => "Gurami",
                "size" => "ukuran 7-9 cm",
                "unit" => "ekor",
                "price" => "Rp2.500",
                "spelled" => "dua ribu lima ratus rupiah"
            ],
            [
                "no" => 43,
                "name" => "Gurami",
                "size" => "ukuran 9-12 cm",
                "unit" => "ekor",
                "price" => "Rp3.500",
                "spelled" => "tiga ribu lima ratus rupiah"
            ],
            [
                "no" => 44,
                "name" => "Gurami",
                "size" => "ukuran >12 cm",
                "unit" => "kg",
                "price" => "Rp35.000",
                "spelled" => "tiga puluh lima ribu rupiah"
            ],
            [
                "no" => 45,
                "name" => "Gurami",
                "size" => "komsumsi/ induk afkir",
                "unit" => "kg",
                "price" => "Rp33.000",
                "spelled" => "tiga puluh tiga ribu rupiah"
            ],
            [
                "no" => 46,
                "name" => "Koi",
                "size" => "ukuran 3- 5 cm grade A",
                "unit" => "ekor",
                "price" => "Rp2.000",
                "spelled" => "dua ribu rupiah"
            ],
            [
                "no" => 47,
                "name" => "Koi",
                "size" => "ukuran 3- 5 cm grade B",
                "unit" => "ekor",
                "price" => "Rp500",
                "spelled" => "lima ratus rupiah"
            ],
            [
                "no" => 48,
                "name" => "Koi",
                "size" => "ukuran 5- 7 cm grade A",
                "unit" => "ekor",
                "price" => "Rp3.000",
                "spelled" => "tiga ribu rupiah"
            ],
            [
                "no" => 49,
                "name" => "Koi",
                "size" => "ukuran 5- 7 cm grade B",
                "unit" => "ekor",
                "price" => "Rp1.000",
                "spelled" => "seribu rupiah"
            ],
            [
                "no" => 50,
                "name" => "Koi",
                "size" => "ukuran 7- 9 cm grade A",
                "unit" => "ekor",
                "price" => "Rp6.000",
                "spelled" => "enam ribu rupiah"
            ],
            [
                "no" => 51,
                "name" => "Koi",
                "size" => "ukuran 7- 9 cm grade B",
                "unit" => "ekor",
                "price" => "Rp2.000",
                "spelled" => "dua ribu rupiah"
            ],
            [
                "no" => 52,
                "name" => "Koi",
                "size" => "ukuran 9-15 cm grade A",
                "unit" => "ekor",
                "price" => "Rp50.000",
                "spelled" => "lima puluh ribu rupiah"
            ],
            [
                "no" => 53,
                "name" => "Koi",
                "size" => "ukuran 9-15 cm grade B",
                "unit" => "ekor",
                "price" => "Rp25.000",
                "spelled" => "dua puluh lima ribu rupiah"
            ],
            [
                "no" => 54,
                "name" => "Koi",
                "size" => "ukuran 15-25 cm grade A",
                "unit" => "ekor",
                "price" => "Rp100.000",
                "spelled" => "seratus ribu rupiah"
            ],
            [
                "no" => 55,
                "name" => "Koi",
                "size" => "ukuran 15-25 cm grade B",
                "unit" => "ekor",
                "price" => "Rp50.000",
                "spelled" => "lima puluh ribu rupiah"
            ],
            [
                "no" => 56,
                "name" => "Koi",
                "size" => "ukuran > 25 cm grade A",
                "unit" => "ekor",
                "price" => "Rp250.000",
                "spelled" => "dua ratus lima puluh ribu rupiah"
            ],
            [
                "no" => 57,
                "name" => "Koi",
                "size" => "ukuran > 25 cm grade B",
                "unit" => "ekor",
                "price" => "Rp150.000",
                "spelled" => "seratus lima puluh ribu rupiah"
            ],
            [
                "no" => 58,
                "name" => "Komet",
                "size" => "ukuran 5-7 cm",
                "unit" => "ekor",
                "price" => "Rp1.000",
                "spelled" => "seribu rupiah"
            ],
            [
                "no" => 59,
                "name" => "Komet",
                "size" => "ukuran 7-9 cm",
                "unit" => "ekor",
                "price" => "Rp2.000",
                "spelled" => "dua ribu rupiah"
            ],
            [
                "no" => 60,
                "name" => "Komet",
                "size" => "ukuran 9-12 cm",
                "unit" => "ekor",
                "price" => "Rp3.000",
                "spelled" => "tiga ribu rupiah"
            ],
            [
                "no" => 61,
                "name" => "Wader",
                "size" => "ukuran 2-3 cm",
                "unit" => "ekor",
                "price" => "Rp60",
                "spelled" => "enam puluh rupiah"
            ],
            [
                "no" => 62,
                "name" => "Wader",
                "size" => "ukuran 3-5 cm",
                "unit" => "ekor",
                "price" => "Rp125",
                "spelled" => "seratus dua puluh lima rupiah"
            ],
            [
                "no" => 63,
                "name" => "Wader",
                "size" => "ukuran 5-7 cm",
                "unit" => "ekor",
                "price" => "Rp200",
                "spelled" => "dua ratus rupiah"
            ],
            [
                "no" => 64,
                "name" => "Wader",
                "size" => "konsumsi/ induk afkir",
                "unit" => "kg",
                "price" => "Rp30.000",
                "spelled" => "tiga puluh ribu rupiah"
            ],
            [
                "no" => 65,
                "name" => "Nilem",
                "size" => "ukuran 2-3 cm",
                "unit" => "ekor",
                "price" => "Rp40",
                "spelled" => "empat puluh rupiah"
            ],
            [
                "no" => 66,
                "name" => "Nilem",
                "size" => "ukuran 3-5 cm",
                "unit" => "ekor",
                "price" => "Rp80",
                "spelled" => "delapan puluh rupiah"
            ],
            [
                "no" => 67,
                "name" => "Nilem",
                "size" => "ukuran 5-7 cm",
                "unit" => "ekor",
                "price" => "Rp125",
                "spelled" => "seratus dua puluh lima rupiah"
            ],
            [
                "no" => 68,
                "name" => "Nilem",
                "size" => "ukuran 7-9 cm",
                "unit" => "ekor",
                "price" => "Rp200",
                "spelled" => "dua ratus rupiah"
            ],
            [
                "no" => 69,
                "name" => "Nilem",
                "size" => "ukuran 9-12 cm",
                "unit" => "kg",
                "price" => "Rp24.000",
                "spelled" => "dua puluh empat ribu rupiah"
            ],
            [
                "no" => 70,
                "name" => "Nilem",
                "size" => "ukuran >12 cm",
                "unit" => "kg",
                "price" => "Rp22.000",
                "spelled" => "dua puluh dua ribu rupiah"
            ],
            [
                "no" => 71,
                "name" => "Nilem",
                "size" => "konsumsi/ induk afkir",
                "unit" => "kg",
                "price" => "Rp22.000",
                "spelled" => "dua puluh dua ribu rupiah"
            ]
        ];

        foreach ($datas as $data) {
            $jenisIkan = MasterJenisIkan::firstOrCreate([
                'name' => $data['name'],
            ]);

            HargaIkan::firstOrCreate([
                'jenis_ikan_id' => $jenisIkan->id,
                'user_id' => 1,
                'size' => $data['size'],
                'unit' => $data['unit'],
                'price' => str_replace(['Rp', '.', ','], '', $data['price']),
                'spelled' => $data['spelled'],
            ]);
        }

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

        $hargaIkans = HargaIkan::inRandomOrder()->limit(50)->get();
        foreach ($hargaIkans as $hargaIkan) {
            StokIkan::firstOrCreate([
                'uptd_id' => Uptd::inRandomOrder()->first()->id,
                'user_id' => 1,
                'jenis_ikan_id' => MasterJenisIkan::inRandomOrder()->first()->id,
            ], [
                'stock' => fake()->numberBetween(1, 100),
            ]);
        }
    }
}
