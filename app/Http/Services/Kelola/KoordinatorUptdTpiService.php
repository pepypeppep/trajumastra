<?php

namespace App\Http\Services\Kelola;

use App\Models\Uptd;
use App\Models\KoordinatorUptd;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KoordinatorUptdTpiService
{
    /* Get alls */
    public function getAll()
    {
        $data = KoordinatorUptd::with('uptd');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';
                // Btn Edit
                if (auth()->user()->can('kelola-koordinator-uptd-tpi.update')) {
                    $btnEdit = '<button href="javascript:void(0);" title="Ubah data koordinator UPTD TPI" id="btn-modal-edit"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.koordinator-uptd-tpi.update', $row->id) . '" data-url-get="' . route('kelola.koordinator-uptd-tpi.edit', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('kelola-koordinator-uptd-tpi.delete')) {
                    $btnDelete = '<button href="javascript:void(0);" title="Hapus data koordinator UPTD TPI" id="btn-delete" onclick="confirmDelete(this)"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.koordinator-uptd-tpi.destroy', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                        <i class="ri-delete-bin-line"></i>
                        </button>';
                }

                return $btnEdit . ' ' . $btnDelete;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function getAllUptd()
    {
        $data = Uptd::get();
        return $data;
    }

    /* Get data by ID */
    public function getById(int $id)
    {
        $data = KoordinatorUptd::findOrFail($id);

        return $data;
    }

    /* Store new data*/
    public function store(array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();
            $data = KoordinatorUptd::create([
                'uptd_id' => $attributes['uptd_id'],
                'nik' => $attributes['nik'],
                'name' => $attributes['name'],
                'phone' => $attributes['phone'],
                'address' => $attributes['address'],
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Koordinator UPTD TPI berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Koordinator UPTD TPI gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }

    /* Update data*/
    public function update($id, array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = KoordinatorUptd::findOrFail($id);
            // Update data data
            $data->update([
                'uptd_id' => $attributes['uptd_id'] ?? $data->uptd_id,
                'nik' => $attributes['nik'] ?? $data->nik,
                'name' => $attributes['name'] ?? $data->name,
                'phone' => $attributes['phone'] ?? $data->phone,
                'address' => $attributes['address'] ?? $data->address,
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Koordinator UPTD TPI berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Koordinator UPTD TPI gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }

    /* Delete data*/
    public function delete($id)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = KoordinatorUptd::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('kelola.koordinator-uptd-tpi.index')->with('success', 'Koordinator UPTD TPI berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Koordinator UPTD TPI gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
