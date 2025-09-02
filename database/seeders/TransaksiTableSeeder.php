<?php

namespace Database\Seeders;

use App\Models\HargaIkan;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Uptd;
use Illuminate\Database\Seeder;

class TransaksiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $user = User::find(fake()->numberBetween(2, 3));
            $uptd = Uptd::find(HargaIkan::get()->pluck('uptd_id')->random());
            $amount = fake()->numberBetween(10000, 100000);
            $retribution = fake()->numberBetween(0, 1000);
            $total = $amount + $retribution;

            $transaksi = Transaksi::create([
                'user_id' => $user->id,
                'uptd_id' => $uptd->id,
                'retribution' => $retribution,
                'transaction_type' => 'cash',
                'name' => fake()->name(),
            ]);

            $limit = fake()->numberBetween(1, HargaIkan::where('uptd_id', $uptd->id)->count());
            $ikans = HargaIkan::where('uptd_id', $uptd->id)->inRandomOrder()->take($limit)->get();
            foreach ($ikans as $ikan) {
                $fishAmount = fake()->numberBetween(1, 10);
                $transaksi->details()->create([
                    'master_jenis_ikans_id' => $ikan->jenis_ikan_id,
                    'name' => $ikan->jenis_ikan->name,
                    'unit' => $ikan->unit,
                    'size' => $ikan->size,
                    'price' => $ikan->price,
                    'weight' => null,
                    'quantity' => $fishAmount,
                    'total' => $fishAmount * $ikan->price,
                    'notes' => null,
                ]);
                $total += $fishAmount * $ikan->price;
            }
            $transaksi->update([
                'total' => $total
            ]);
        }
    }
}
