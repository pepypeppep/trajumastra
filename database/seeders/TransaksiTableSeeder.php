<?php

namespace Database\Seeders;

use App\Models\HargaIkan;
use App\Models\User;
use App\Models\Transaksi;
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
            $amount = fake()->numberBetween(10000, 100000);
            $retribution = fake()->numberBetween(0, 1000);
            $total = $amount + $retribution;

            $transaksi = Transaksi::create([
                'user_id' => $user->id,
                'uptd_id' => $user->uptd_id,
                'amount' => $amount,
                'retribution' => $retribution,
                'total' => $total,
                'transaction_type' => 'cash',
                'name' => fake()->name(),
            ]);

            $limit = fake()->numberBetween(1, HargaIkan::where('uptd_id', $user->uptd_id)->count());
            $ikans = HargaIkan::where('uptd_id', $user->uptd_id)->inRandomOrder()->take($limit)->get();
            foreach ($ikans as $ikan) {
                $fishAmount = fake()->numberBetween(1, 10);
                $transaksi->details()->create([
                    'master_jenis_ikans_id' => $ikan->jenis_ikan_id,
                    'name' => $ikan->jenis_ikan->name,
                    'unit' => $ikan->unit,
                    'size' => $ikan->size,
                    'price' => $ikan->price,
                    'weight' => null,
                    'amount' => $fishAmount,
                    'total' => $fishAmount * $ikan->price,
                    'notes' => null,
                ]);
            }
        }
    }
}
