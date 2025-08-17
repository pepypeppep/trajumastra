<?php

namespace App\Http\Services\Master;

use App\Enums\RoleEnum;
use App\Models\MasterJenisIkan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Container\AttributesDB;
use Yajra\DataTables\Facades\DataTables;

class JenisPerairanService
{
    /* Get alls */
    public function getAll()
    {
        $data = MasterJenisIkan::orderBy('name');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';
                // Btn Edit
                if (auth()->user()->can('jenis-perairan.update')) {
                    $btnEdit = '<button href="javascript:void(0);" title="Edit data pengguna" id="btn-modal-edit-user"
                        data-id="' . $row->id . '"  data-url-action="' . route('master.jenis-perairan.update', $row->id) . '" data-url-get="' . route('master.jenis-perairan.edit', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('jenis-perairan.delete')) {
                    $btnDelete = '<button href="javascript:void(0);" title="Hapus data pengguna" id="btn-delete-user" onclick="confirmDelete(this)"
                        data-id="' . $row->id . '"  data-url-action="' . route('master.jenis-perairan.destroy', $row->id) . '"
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
        $data = MasterJenisIkan::findOrFail($id);

        return $data;
    }

    /* Store new data*/
    public function store(array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();
            $data = MasterJenisIkan::create([
                'name' => $attributes['name']
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Jenis perairan berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Jenis perairan gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }

    /* Update data*/
    public function update($id, array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = MasterJenisIkan::findOrFail($id);
            // Update data data
            $data->update([
                'name' => $attributes['name'] ?? $data->name
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Jenis perairan berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Jenis perairan gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }

    /* Delete data*/
    public function delete($id)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = MasterJenisIkan::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('master.jenis-perairan.index')->with('success', 'Jenis perairan berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Jenis perairan gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
