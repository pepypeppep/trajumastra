<?php

namespace App\Http\Services\Master;

use Illuminate\Support\Facades\DB;
use App\Models\MasterJenisAlatTangkap;
use Yajra\DataTables\Facades\DataTables;

class AlatTangkapService
{
    /* Get alls */
    public function getAll()
    {
        $data = MasterJenisAlatTangkap::orderBy('name');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';
                // Btn Edit
                if (auth()->user()->can('alat-tangkap.update')) {
                    $btnEdit = '<button type="button" title="Ubah data" id="btn-modal-edit"
                        data-id="' . $row->id . '"  data-url-action="' . route('master.alat-tangkap.update', $row->id) . '" data-url-get="' . route('master.alat-tangkap.edit', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('alat-tangkap.delete')) {
                    // Check if data is used in another table
                    $tablesToCheck = [
                        // Add other tables that reference this data
                    ];

                    // Column foreign key in child tables
                    $column = 'jenis_alat_tangkap_id'; // Adjust this column name as needed

                    // Helper function to check data usage
                    $isUsed = isDataUsed($row->id, $column, $tablesToCheck);

                    if ($isUsed) {
                        $btnDelete = '<button type="button" title="Tidak dapat menghapus data, karena data telah digunakan pada data lain" id="btn-delete" disabled
                            class="btn-disabled-delete items-center px-3 py-2 text-white btn bg-gray-500 border-gray-500 hover:text-white hover:bg-gray-600 hover:border-gray-600 focus:text-white focus:bg-gray-600 focus:border-gray-600 focus:ring focus:ring-gray-100 active:text-white active:bg-gray-600 active:border-gray-600 active:ring active:ring-gray-100 dark:ring-gray-400/20">
                            <i class="ri-delete-bin-line"></i>
                            </button>';
                    }else {
                        $btnDelete = '<button type="button" title="Hapus data" id="btn-delete" onclick="confirmDelete(this)"
                            data-id="' . $row->id . '"  data-url-action="' . route('master.alat-tangkap.destroy', $row->id) . '"
                            class="items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                            <i class="ri-delete-bin-line"></i>
                            </button>';
                    }
                }

                return $btnEdit . ' ' . $btnDelete;
            })
            ->escapeColumns([])
            ->make(true);
    }

    /* Get data by ID */
    public function getById(int $id)
    {
        $data = MasterJenisAlatTangkap::findOrFail($id);

        return $data;
    }

    /* Store new data*/
    public function store(array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();
            $data = MasterJenisAlatTangkap::create([
                'name' => $attributes['name']
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Jenis ikan berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Jenis ikan gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }

    /* Update data*/
    public function update($id, array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = MasterJenisAlatTangkap::findOrFail($id);
            // Update data data
            $data->update([
                'name' => $attributes['name'] ?? $data->name
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Jenis ikan berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Jenis ikan gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }

    /* Delete data*/
    public function delete($id)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = MasterJenisAlatTangkap::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('master.alat-tangkap.index')->with('success', 'Jenis ikan berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Jenis ikan gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
