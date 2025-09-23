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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StokIkanService
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
        $uptdType = $user->uptd?->type;

        $data = StokIkan::with('jenis_ikan')->where('uptd_id', $user->uptd_id);

        if ($request->has('keyword')) {
            $data->whereHas('jenis_ikan', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($uptdType == 2) {
            $perPage = $request->get('per_page', 10);

            $results = $data->join('master_jenis_ikans', 'stok_ikans.jenis_ikan_id', '=', 'master_jenis_ikans.id')
                ->orderBy('master_jenis_ikans.name', 'asc')
                ->select('stok_ikans.*')
                ->paginate($perPage);

            $results->load('jenis_ikan');
        } else {
            $results = [];
        }

        return $results;
    }

    /* Get data by ID */
    public function getById($request, $id)
    {
        if (env('LOGIN_TYPE') == 'sso') {
            $userId = $request->user()->id;
        } else {
            $userId = 2;
        }

        $user = User::with('uptd')->find($userId);

        $data = StokIkan::with('jenis_ikan')->where('uptd_id', $user->uptd_id)->find($id);

        if (!$data) {
            return null;
        }

        return $data;
    }

    /* Update data*/
    public function update($request, $id, array $attributes)
    {
        if (env('LOGIN_TYPE') == 'sso') {
            $userId = $request->user()->id;
        } else {
            $userId = 2;
        }

        $user = User::with('uptd')->find($userId);

        $data = StokIkan::with('jenis_ikan')->where('uptd_id', $user->uptd_id)->find($id);

        $data->update([
            'stock' => $attributes['stock']
        ]);

        return $data;
    }

    /* Delete data*/
    public function delete($id)
    {
        //
    }
}
