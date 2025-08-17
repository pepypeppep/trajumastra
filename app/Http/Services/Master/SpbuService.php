<?php

namespace App\Http\Services\Master;

use App\Models\Spbu;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SpbuService
{
    /* Get alls */
    public function getAll()
    {
        $data = Spbu::orderBy('name');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';
                // Btn Edit
                if (auth()->user()->can('spbu.update')) {
                    $btnEdit = '<button href="javascript:void(0);" title="Ubah data spbu" id="btn-modal-edit"
                        data-id="' . $row->id . '"  data-url-action="' . route('master.spbu.update', $row->id) . '" data-url-get="' . route('master.spbu.edit', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('spbu.delete')) {
                    $btnDelete = '<button href="javascript:void(0);" title="Hapus data spbu" id="btn-delete" onclick="confirmDelete(this)"
                        data-id="' . $row->id . '"  data-url-action="' . route('master.spbu.destroy', $row->id) . '"
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
        $data = Spbu::findOrFail($id);

        return $data;
    }

    /* Store new data*/
    public function store(array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();
            $data = Spbu::create([
                'code' => $attributes['code'],
                'name' => $attributes['name'],
                'address' => $attributes['address'],
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'SPBU berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'SPBU gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }

    /* Update data*/
    public function update($id, array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = Spbu::findOrFail($id);
            // Update data data
            $data->update([
                'code' => $attributes['code'] ?? $data->code,
                'name' => $attributes['name'] ?? $data->name,
                'address' => $attributes['address'] ?? $data->address,
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'SPBU berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'SPBU gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }

    /* Delete data*/
    public function delete($id)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = Spbu::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('master.spbu.index')->with('success', 'SPBU berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'SPBU gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
