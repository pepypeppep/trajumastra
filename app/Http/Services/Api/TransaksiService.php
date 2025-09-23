<?php

namespace App\Http\Services\Api;

use App\Models\User;
use App\Models\StokIkan;
use App\Models\HargaIkan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\MasterJenisIkan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;

class TransaksiService
{
    /* Get alls */
    public function getAll($request)
    {
        if (env('LOGIN_TYPE') == 'sso') {
            $userId = $request->user()->id;
        } else {
            $userId = 2;
        }
        $user = User::with('uptd')->find($userId);
        $dataQuery = Transaksi::query();

        if ($user->uptd_id) {
            $dataQuery->where('uptd_id', $user->uptd_id);
        }

        if ($request->has('keyword')) {
            $dataQuery->where('name', 'like', '%' . $request->keyword . '%')
                ->orWhere('invoice_id', 'like', '%' . $request->keyword . '%');
        }

        $data = $dataQuery->orderBy('created_at', 'desc')->paginate(10);

        return $data;
    }

    /* Get products by User */
    public function getProductByUser(Request $request)
    {
        if (env('LOGIN_TYPE') == 'sso') {
            $userId = $request->user()->id;
        } else {
            $userId = 2;
        }
        $user = User::with('uptd')->find($userId);
        $uptdType = $user->uptd?->type;

        $data = HargaIkan::with('jenis_ikan:id,name,type,economic_value')
            ->where('is_active', 1)
            ->whereHas('jenis_ikan', function ($query) use ($uptdType) {
                $query->where('type', $uptdType);
            });

        if ($request->has('keyword')) {
            $data->whereHas('jenis_ikan', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->has('transaction_type')) {
            $data->where('transaction_type', $request->transaction_type);
        }

        $products = $data->get();

        return ProductResource::collectionWithUptdType($products, $uptdType);
    }

    /* Get data by ID */
    public function getById(int $id)
    {
        $data = Transaksi::with('uptd.kalurahan', 'staff:id,name')->find($id);

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
    public function store($user, array $attributes)
    {
        DB::beginTransaction();

        try {
            $user = User::with('uptd')->find(2);
            $transactions = $attributes['transactions'];
            $savedTransactions = [];
            // $amount = 0;
            $retribution = 0;
            $total = 0;

            foreach ($transactions as $transactionData) {
                $fish = HargaIkan::with('jenis_ikan')->where('jenis_ikan_id', $transactionData['master_jenis_ikan_id'])->first();

                if (!$fish) {
                    throw new \Exception('Transaksi tidak dapat dilakukan karena stok ikan tidak tersedia', 500);
                }

                // If fish type is BBI check stock
                if ($fish->jenis_ikan->type == 2) {
                    $fishStock = StokIkan::where('jenis_ikan_id', $transactionData['master_jenis_ikan_id'])
                        ->where('uptd_id', $user->uptd_id)->first();

                    if (!$fishStock) {
                        throw new \Exception('Transaksi tidak dapat dilakukan karena stok ikan tidak tersedia', 500);
                    }

                    if ($fishStock->stock < $transactionData['quantity']) {
                        throw new \Exception('Transaksi tidak dapat dilakukan karena stok ikan tidak mencukupi', 500);
                    }

                    // Update stok ikan
                    $fishStock->decrement('stock', $transactionData['quantity']);
                }

                $transaction = Transaksi::create([
                    'user_id' => $user->id,
                    'uptd_id' => $user->uptd_id,
                    'transaction_type' => $attributes['transaction_type'] ?? 'cash',
                    'name' => $user->name,
                ]);

                $data = [
                    'master_jenis_ikans_id' => $transactionData['master_jenis_ikan_id'],
                    'name' => $fish->jenis_ikan->name,
                    'unit' => $fish->unit,
                    'size' => $fish->size,
                    'price' => $fish->price,
                    'weight' => $fish->weight,
                    'quantity' => $transactionData['quantity']
                ];

                // If fish type is BBI set total from Price
                if ($fish->jenis_ikan->type == 2) {
                    $priceTotal = $transactionData['quantity'] * $fish->price;
                    $data['total'] = $priceTotal;
                }
                // If fish type is TPI set total from Retribution
                else if ($fish->jenis_ikan->type == 1) {
                    $data['total'] = $fish->retribution;
                }

                $transaction->details()->create($data);

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

            throw $e;
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
