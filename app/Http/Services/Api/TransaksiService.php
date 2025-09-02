<?php

namespace App\Http\Services\Api;

use App\Models\Uptd;
use App\Models\User;
use App\Models\HargaIkan;
use App\Models\Transaksi;
use App\Models\MasterJenisIkan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TransaksiService
{
    /* Get alls */
    public function getAll($request)
    {
        // $user = $request->user();
        $data = Transaksi::with('uptd')->where('user_id', 2);

        if ($request->has('keyword')) {
            $data->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->has('transaction_type')) {
            $data->where('transaction_type', $request->transaction_type);
        }

        return $data->paginate(10);
    }

    /* Get products by User */
    public function getProductByUser($request)
    {
        // $user = $request->user();
        $data = HargaIkan::with('jenis_ikan:id,name')->where('uptd_id', 2);

        if ($request->has('keyword')) {
            $data->whereHas('jenis_ikan', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->has('transaction_type')) {
            $data->where('transaction_type', $request->transaction_type);
        }

        return $data->get();
    }

    /* Get data by ID */
    public function getById(int $id)
    {
        $data = Transaksi::with('uptd')->find($id);

        if (!$data) {
            return null;
        }

        return $data;
    }

    /* Get image by ID */
    public function getImageById($id)
    {
        $fish = MasterJenisIkan::find($id);

        if (!$fish) {
            return null;
        }

        $data = Storage::disk('local')->get($fish->image);

        if (!$data) {
            return null;
        }

        return response($data, 200)->header('Content-Type', 'image/jpeg');
    }

    /* Store new data*/
    public function store(array $attributes)
    {
        DB::beginTransaction();

        try {
            // $user = $request->user();
            $user = User::with('uptd')->find(2);
            $transactions = $attributes['transactions'];
            $savedTransactions = [];
            // $amount = 0;
            $retribution = 0;
            $total = 0;

            foreach ($transactions as $transactionData) {
                $fish = HargaIkan::with('jenis_ikan')->where('jenis_ikan_id', $attributes['master_jenis_ikan_id'])
                    ->where('uptd_id', 2)
                    ->first();

                if ($fish->stock < $transactionData['quantity']) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Transaksi tidak dapat dilakukan karena stok ikan tidak cukup',
                        'error' => 'Internal server error'
                    ], 500);
                }

                $transaction = Transaksi::create([
                    'user_id' => $user->id,
                    'uptd_id' => $user->uptd_id,
                    'transaction_type' => $attributes['transaction_type'] ?? 'cash',
                    'name' => $user->name,
                ]);

                $priceTotal = $transactionData['quantity'] * $fish->price;
                $transaction->details()->create([
                    'master_jenis_ikan_id' => $transactionData['master_jenis_ikan_id'],
                    'name' => $fish->jenis_ikan->name,
                    'unit' => $fish->unit,
                    'size' => $fish->size,
                    'price' => $fish->price,
                    'weight' => $fish->weight,
                    'quantity' => $transactionData['quantity'],
                    'total' => $priceTotal,
                ]);

                $total += $priceTotal;

                $savedTransactions[] = $transaction;
            }

            $transaction->update([
                'total' => $total
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan',
                'data' => [
                    'transactions' => $savedTransactions,
                    'total_items' => count($savedTransactions)
                ]
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Cashier transaction error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan transaksi',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /* Update data*/
    public function update($id, array $attributes)
    {
        //
    }

    /* Delete data*/
    public function delete($id)
    {
        //
    }
}
