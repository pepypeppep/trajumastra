<?php

namespace App\Http\Services\Master;

use Illuminate\Support\Str;
use App\Models\MasterJenisIkan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class JenisIkanService
{
    /* Get alls */
    public function getAll()
    {
        $data = MasterJenisIkan::orderBy('name');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('image_data', function ($row) {
                if ($row->image == null) {
                    return '-';
                }
                return '<img src="' . route('api.product.image', $row->id) . '" alt="Gambar" class="w-10 h-10 rounded-full object-cover cursor-pointer" id="btn-modal-image" data-title="' . $row->name . '" data-url-get="' . route('api.product.image', $row->id) . '">';
            })
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';
                // Btn Edit
                if (auth()->user()->can('jenis-ikan.update')) {
                    $btnEdit = '<button href="javascript:void(0);" title="Ubah data pengguna" id="btn-modal-edit"
                        data-id="' . $row->id . '"  data-url-action="' . route('master.jenis-ikan.update', $row->id) . '" data-url-get="' . route('master.jenis-ikan.edit', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('jenis-ikan.delete')) {
                    $btnDelete = '<button href="javascript:void(0);" title="Hapus data pengguna" id="btn-delete" onclick="confirmDelete(this)"
                        data-id="' . $row->id . '"  data-url-action="' . route('master.jenis-ikan.destroy', $row->id) . '"
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

            $filename = null;
            if ($attributes['image']) {
                $filename = Str::uuid() . '.png';
                Storage::disk('local')->put('ikan/' . $filename, file_get_contents($attributes['image']));
            }

            $data = MasterJenisIkan::create([
                'name' => $attributes['name'],
                'image' => 'ikan/' . $filename
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
            $data = MasterJenisIkan::findOrFail($id);

            $filename = $data->image;
            if ($attributes['image']) {
                $filename = Str::uuid() . '.png';
                Storage::disk('local')->put('ikan/' . $filename, file_get_contents($attributes['image']));
            }

            // Update data data
            $data->update([
                'name' => $attributes['name'] ?? $data->name,
                'image' => 'ikan/' . $filename
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
            $data = MasterJenisIkan::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('master.jenis-ikan.index')->with('success', 'Jenis ikan berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Jenis ikan gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
