<?php

namespace App\Http\Services\Master;

use App\Models\MasterJenisUsaha;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class JenisUsahaService
{
    /* Get alls */
    public function getAll()
    {
        $data = MasterJenisUsaha::orderBy('name');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';
                // Btn Edit
                if (auth()->user()->can('jenis-usaha.update')) {
                    $btnEdit = '<button href="javascript:void(0);" title="Ubah data pengguna" id="btn-modal-edit"
                        data-id="' . $row->id . '"  data-url-action="' . route('master.jenis-usaha.update', $row->id) . '" data-url-get="' . route('master.jenis-usaha.edit', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('jenis-usaha.delete')) {
                    $btnDelete = '<button href="javascript:void(0);" title="Hapus data pengguna" id="btn-delete" onclick="confirmDelete(this)"
                        data-id="' . $row->id . '"  data-url-action="' . route('master.jenis-usaha.destroy', $row->id) . '"
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
        $data = MasterJenisUsaha::findOrFail($id);

        return $data;
    }

    /* Store new data*/
    public function store(array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();
            $data = MasterJenisUsaha::create([
                'name' => $attributes['name'],
                'category_group_name' => $attributes['category_group_name'],
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Jenis usaha berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Jenis usaha gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }

    /* Update data*/
    public function update($id, array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = MasterJenisUsaha::findOrFail($id);
            // Update data data
            $data->update([
                'name' => $attributes['name'] ?? $data->name,
                'category_group_name' => $attributes['category_group_name'] ?? $data->category_group_name,
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Jenis usaha berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Jenis usaha gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }

    /* Delete data*/
    public function delete($id)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = MasterJenisUsaha::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('master.jenis-usaha.index')->with('success', 'Jenis usaha berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Jenis usaha gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
