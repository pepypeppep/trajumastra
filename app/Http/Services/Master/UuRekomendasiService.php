<?php

namespace App\Http\Services\Master;

use App\Enums\RoleEnum;
use App\Models\MasterUuSuratRekomendasiBbm;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Container\AttributesDB;
use Yajra\DataTables\Facades\DataTables;

class UuRekomendasiService
{
    /* Get alls */
    public function getAll()
    {
        $data = MasterUuSuratRekomendasiBbm::orderBy('name');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';
                // Btn Edit
                if (auth()->user()->can('uu-rekomendasi.update')) {
                    $btnEdit = '<button href="javascript:void(0);" title="Ubah data uu rekomendasi bbm" id="btn-modal-edit"
                        data-id="' . $row->id . '"  data-url-action="' . route('master.uu-rekomendasi.update', $row->id) . '" data-url-get="' . route('master.uu-rekomendasi.edit', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('uu-rekomendasi.delete')) {
                    $btnDelete = '<button href="javascript:void(0);" title="Hapus data uu rekomendasi bbm" id="btn-delete" onclick="confirmDelete(this)"
                        data-id="' . $row->id . '"  data-url-action="' . route('master.uu-rekomendasi.destroy', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                        <i class="ri-delete-bin-line"></i>
                        </button>';
                }

                return $btnEdit . ' ' . $btnDelete;
            })
            ->escapeColumns([])
            ->make(true);
    }

    /* Get data by ID */
    public function getById(int $id)
    {
        $data = MasterUuSuratRekomendasiBbm::findOrFail($id);

        return $data;
    }

    /* Store new data*/
    public function store(array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();
            $data = MasterUuSuratRekomendasiBbm::create([
                'name' => $attributes['name']
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'UU Rekomendasi BBM berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'UU Rekomendasi BBM gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }

    /* Update data*/
    public function update($id, array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = MasterUuSuratRekomendasiBbm::findOrFail($id);
            // Update data data
            $data->update([
                'name' => $attributes['name'] ?? $data->name
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'UU Rekomendasi BBMberhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'UU Rekomendasi BBM gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }

    /* Delete data*/
    public function delete($id)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = MasterUuSuratRekomendasiBbm::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('master.uu-rekomendasi.index')->with('success', 'UU Rekomendasi BBM berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'UU Rekomendasi BBM gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
