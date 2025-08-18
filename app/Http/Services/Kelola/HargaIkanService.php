<?php

namespace App\Http\Services\Kelola;

use App\Models\Uptd;
use App\Models\HargaIkan;
use App\Models\MasterJenisIkan;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class HargaIkanService
{
    /* Get alls */
    public function getAll()
    {
        $data = HargaIkan::select([
            'harga_ikans.id as harga_id',
            'harga_ikans.uptd_id',
            'harga_ikans.jenis_ikan_id',
            'harga_ikans.stock',
            'harga_ikans.size',
            'harga_ikans.price',
            'harga_ikans.unit',
        ])
            ->with('uptd:id,name', 'jenis_ikan:id,name');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';
                // Btn Edit
                if (auth()->user()->can('kelola-harga-ikan.update')) {
                    $btnEdit = '<button href="javascript:void(0);" title="Ubah data harga ikan" id="btn-modal-edit"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.harga-ikan.update', $row->harga_id) . '" data-url-get="' . route('kelola.harga-ikan.edit', $row->harga_id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('kelola-harga-ikan.delete')) {
                    $btnDelete = '<button href="javascript:void(0);" title="Hapus data harga ikan" id="btn-delete" onclick="confirmDelete(this)"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.harga-ikan.destroy', $row->harga_id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                        <i class="ri-delete-bin-line"></i>
                        </button>';
                }

                return $btnEdit . ' ' . $btnDelete;
            })
            ->escapeColumns([])
            ->make(true);
    }

    /* Get uptd */
    public function getAllUptd()
    {
        $data = Uptd::get();
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
        $data = HargaIkan::findOrFail($id);

        return $data;
    }

    /* Store new data*/
    public function store(array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();
            $data = HargaIkan::create([
                'uptd_id' => $attributes['uptd_id'],
                'jenis_ikan_id' => $attributes['jenis_ikan_id'],
                'stock' => $attributes['stock'],
                'size' => $attributes['size'],
                'price' => $attributes['price'],
                'unit' => $attributes['unit'],
                'user_id' => auth()->user()->id,
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Stok Ikan berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Stok Ikan gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }

    /* Update data*/
    public function update($id, array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = HargaIkan::findOrFail($id);
            // Update data data
            $data->update([
                'uptd_id' => $attributes['uptd_id'] ?? $data->uptd_id,
                'jenis_ikan_id' => $attributes['jenis_ikan_id'] ?? $data->jenis_ikan_id,
                'stock' => $attributes['stock'] ?? $data->stock,
                'size' => $attributes['size'] ?? $data->size,
                'price' => $attributes['price'] ?? $data->price,
                'unit' => $attributes['unit'] ?? $data->unit,
                'user_id' => auth()->user()->id,
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Stok Ikan berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Stok Ikan gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }

    /* Delete data*/
    public function delete($id)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = HargaIkan::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('kelola.harga-ikan.index')->with('success', 'Stok Ikan berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Stok Ikan gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
