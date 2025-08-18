<?php

namespace App\Http\Services\Kelola;

use App\Models\Kalurahan;
use App\Models\Uptd;
use App\Models\MasterJenisIkan;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UptdService
{
    /* Get alls */
    public function getAll()
    {
        $data = Uptd::where('type', Uptd::UPTD)->with('kalurahan.kecamatan.kabupaten');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';
                $btnMap = '';
                // Btn Map
                if (auth()->user()->can('kelola-uptd.read')) {
                    $btnMap = '<button href="javascript:void(0);" title="Map data uptd" id="btn-modal-map"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.uptd.update', $row->id) . '" data-url-get="' . route('kelola.uptd.edit', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-sky-500 border-sky-500 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:border-sky-600 active:ring active:ring-sky-100 dark:ring-sky-400/20">
                        <i class="ri-map-pin-line"></i>
                        </button>';
                }

                // Btn Edit
                if (auth()->user()->can('kelola-uptd.update')) {
                    $btnEdit = '<button href="javascript:void(0);" title="Ubah data uptd" id="btn-modal-edit"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.uptd.update', $row->id) . '" data-url-get="' . route('kelola.uptd.edit', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('kelola-uptd.delete')) {
                    $btnDelete = '<button href="javascript:void(0);" title="Hapus data uptd" id="btn-delete" onclick="confirmDelete(this)"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.uptd.destroy', $row->id) . '"
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
                // 'jenis_ikan_id' => $attributes['jenis_ikan_id'],
                'latitude' => $attributes['latitude'],
                'longitude' => $attributes['longitude'],
                'type' => $attributes['type'] ?? 2,
                'status' => $attributes['status'] ?? 1,
                'user_id' => auth()->user()->id,
            ]);

            $jenisIkanIds = [];
            foreach ($attributes['jenis_ikan_id'] as $jenisIkanId) {
                $jenisIkan = MasterJenisIkan::findOrFail($jenisIkanId);
                $jenisIkanIds[] = $jenisIkan->id;
            }

            // Attach to uptd (sync prevents duplicates)
            $data->jenis_ikans()->sync($jenisIkanIds);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'UPTD berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'UPTD gagal ditambahkan. Error :' . $e->getMessage()]);
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
                // 'jenis_ikan_id' => $attributes['jenis_ikan_id'] ?? $data->jenis_ikan_id,
                'latitude' => $attributes['latitude'] ?? $data->latitude,
                'longitude' => $attributes['longitude'] ?? $data->longitude,
                'type' => $attributes['type'] ?? $data->type,
                'status' => $attributes['status'] ?? $data->status,
                'user_id' => auth()->user()->id,
            ]);

            $jenisIkanIds = [];
            foreach ($attributes['jenis_ikan_id'] as $jenisIkanId) {
                $jenisIkan = MasterJenisIkan::findOrFail($jenisIkanId);
                $jenisIkanIds[] = $jenisIkan->id;
            }

            // Attach to uptd (sync prevents duplicates)
            $data->jenis_ikans()->sync($jenisIkanIds);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'UPTD berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'UPTD gagal diperbarui. Error :' . $e->getMessage()]);
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
            return redirect()->route('kelola.uptd.index')->with('success', 'UPTD berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'UPTD gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
