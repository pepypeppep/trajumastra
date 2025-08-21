<?php

namespace App\Http\Services\Api;

use App\Models\HargaIkan;
use App\Models\MasterJenisIkan;
use App\Models\Uptd;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class TransaksiService
{
    /* Get alls */
    public function getAll($request)
    {
        // $user = $request->user();
        $user = User::with('uptd')->find(2);
        $data = Transaksi::with('uptd')->where('user_id', $user->id);

        if ($request->has('keyword')) {
            $data->where('fish_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('abk_name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->has('transaction_type')) {
            $data->where('transaction_type', $request->transaction_type);
        }

        return $data->paginate(10);
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

    /* Store new data*/
    public function store(array $attributes)
    {
        // $user = $request->user();
        $user = User::with('uptd')->find(2);
        $jenisIkan = MasterJenisIkan::find($attributes['master_jenis_ikan_id']);
        $hargaIkan = HargaIkan::where('jenis_ikan_id', $jenisIkan->id)
            ->where('uptd_id', $user->uptd_id)
            ->first();

        $retribution = 0;
        $total = 0;

        try {
            // DB Transaction
            DB::beginTransaction();
            $data = Uptd::create([
                'user_id' => $user->id,
                'uptd_id' => $user->uptd_id,
                'transaction_type' => $attributes['transaction_type'],
                'fish_name' => $jenisIkan->name,
                'fish_price' => $hargaIkan,
                'number_of_fish' => $attributes['number_of_fish'],
                'abk_name' => $attributes['abk_name'],
                'amount' => $attributes['amount'],
                'retribution' => $retribution,
                'total' => $total,
            ]);

            // Return success response
            DB::commit();
            return $data;
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return $e;
        }
    }

    /* Update data*/
    public function update($id, array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = Uptd::findOrFail($id);
            // Update data data
            $data->update([
                'kalurahan_id' => $attributes['kalurahan_id'] ?? $data->kalurahan_id,
                'name' => $attributes['name'] ?? $data->name,
                'dusun' => $attributes['dusun'] ?? $data->dusun,
                'address' => $attributes['address'] ?? $data->address,
                'latitude' => $attributes['latitude'] ?? $data->latitude,
                'longitude' => $attributes['longitude'] ?? $data->longitude,
                'type' => $attributes['type'] ?? $data->type,
                'status' => $attributes['status'] ?? $data->status,
                'user_id' => auth()->user()->id,
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'TPI berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'TPI gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }

    /* Delete data*/
    public function delete($id)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = Uptd::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('kelola.tpi.index')->with('success', 'TPI berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'TPI gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
