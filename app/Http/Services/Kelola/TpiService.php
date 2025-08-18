<?php

namespace App\Http\Services\Kelola;

use App\Models\Kalurahan;
use App\Models\Uptd;
use App\Models\MasterJenisIkan;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TpiService
{
    /* Get alls */
    public function getAll()
    {
        $data = Uptd::where('type', Uptd::TPI)->with('kalurahan.kecamatan.kabupaten');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';
                // Btn Edit
                if (auth()->user()->can('kelola-tpi.update')) {
                    $btnEdit = '<button href="javascript:void(0);" title="Ubah data tpi" id="btn-modal-edit"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.tpi.update', $row->id) . '" data-url-get="' . route('kelola.tpi.edit', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('kelola-tpi.delete')) {
                    $btnDelete = '<button href="javascript:void(0);" title="Hapus data tpi" id="btn-delete" onclick="confirmDelete(this)"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.tpi.destroy', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                        <i class="ri-delete-bin-line"></i>
                        </button>';
                }

                return $btnEdit . ' ' . $btnDelete;
            })
            ->escapeColumns([])
            ->make(true);
    }

    /* Get kalurahan */
    public function getAllKalurahan()
    {
        $data = Kalurahan::with('kecamatan.kabupaten')->get();
        return $data;
    }

    /* Get jenis ikan */
    public function getAllJenisIkan()
    {
        $data = MasterJenisIkan::get();
        return $data;
    }

    /* Get data by ID */
    public function getById(int $id)
    {
        $data = Uptd::with('kalurahan', 'jenis_ikans')->findOrFail($id);

        return $data;
    }

    /* Store new data*/
    public function store(array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();
            $data = Uptd::create([
                'kalurahan_id' => $attributes['kalurahan_id'],
                'name' => $attributes['name'],
                'dusun' => $attributes['dusun'],
                'address' => $attributes['address'],
                'latitude' => $attributes['latitude'],
                'longitude' => $attributes['longitude'],
                'type' => $attributes['type'] ?? 1,
                'status' => $attributes['status'] ?? 1,
                'user_id' => auth()->user()->id,
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'TPI berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'TPI gagal ditambahkan. Error :' . $e->getMessage()]);
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
