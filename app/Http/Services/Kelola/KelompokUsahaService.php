<?php

namespace App\Http\Services\Kelola;

use App\Models\Kalurahan;
use Illuminate\Support\Str;
use App\Models\KelompokUsaha;
use App\Models\KelompokBinaan;
use App\Models\MasterBentukUsaha;
use Illuminate\Support\Facades\DB;
use App\Models\MasterRangePenghasilan;
use Yajra\DataTables\Facades\DataTables;
use App\Enums\BentukUsahaKelompokUsahaEnum;

class KelompokUsahaService
{
    /* Get alls */
    public function getAll()
    {
        $data = KelompokUsaha::with('kalurahan.kecamatan.kabupaten', 'bentuk_usaha')
                ->select('kelompok_usahas.*');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';

                // Btn Edit
                if (auth()->user()->can('kelola-kelompok-usaha.update')) {
                    $btnEdit = '<button href="javascript:void(0);" title="Ubah data pokdakan" id=""
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.kelompok-usaha.update', $row->id) . '" data-url-get="' . route('kelola.kelompok-usaha.edit', $row->id) . '"
                        class="btn-modal-edit items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('kelola-kelompok-usaha.delete')) {
                    $btnDelete = '<button href="javascript:void(0);" title="Hapus data pokdakan" id="" onclick="confirmDelete(this)"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.kelompok-usaha.destroy', $row->id) . '"
                        class="btn-delete items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                        <i class="ri-delete-bin-line"></i>
                        </button>';
                }

                return $btnEdit . ' ' . $btnDelete;
            })
            ->escapeColumns([])
            ->make(true);
    }

    /* Get data kalurahan */
    public function getAllKalurahan()
    {
        $data = Kalurahan::with('kecamatan.kabupaten')->orderBy('name')->get();
        return $data;
    }

    /* Get kelompok Binaan yang belum memiliki kelompok usaha */
    public function getKelompokBinaanHasntKelompokUsaha()
    {
        // Get all kelompok binaan id that already have kelompok usaha
        $kelompokUsaha = KelompokUsaha::pluck('kelompok_binaan_id')->toArray();
        // Get all kelompok binaan that not in the above array
        $data = KelompokBinaan::with('jenis_usahas')
                ->whereNotIn('id', $kelompokUsaha)->orderBy('name')->get();
        // dd($data);
        return $data;
    }

    /* Kelompok Binaan By Id */
    public function getKelompokBinaanById($id)
    {
        $data = KelompokBinaan::findOrFail($id);
        return $data;
    }

    /* Get all bentuk usaha */
    public function getAllBentukUsaha()
    {
        $data = MasterBentukUsaha::orderBy('name')->get();
        return $data;
    }

    /* Get all range penghasilan */
    public function getRangePenghasilan()
    {
        $data = MasterRangePenghasilan::orderBy('name')->get();
        return $data;
    }

    /* Get data by ID */
    public function getById(int $id)
    {
        $data = KelompokUsaha::with('kelompok_binaan.jenis_usahas')->findOrFail($id);
        return $data;
    }

    /* Store new data*/
    public function store(array $datas)
    {
        try {
            // DB Transaction
            DB::beginTransaction();
            $kelompokUsaha = KelompokUsaha::create([
                'kelompok_binaan_id' => $datas['kelompok_binaan_id'],
                'kalurahan_id' => $datas['kalurahan_id'],
                'bentuk_usaha_id' => $datas['bentuk_usaha_id'],
                'name' => $datas['name'],
                'address' => $datas['address'],
                'phone' => $datas['phone'],
                'year' => $datas['year'],
                'leader' => $datas['leader'],
                'members' => $datas['members'],
                'nib' => $datas['nib'],
                'income_range' => $datas['income_range'],
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Kelompok usaha berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Kelompok usaha gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }

    /* Update data*/
    public function update($id, array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = KelompokUsaha::findOrFail($id);
            // Update data data
            $data->update([
                'kelompok_binaan_id' => $attributes['kelompok_binaan_id'] ?? $data->kelompok_binaan_id,
                'kalurahan_id' => $attributes['kalurahan_id'] ?? $data->kalurahan_id,
                'bentuk_usaha_id' => $attributes['bentuk_usaha_id'] ?? $data->bentuk_usaha_id,
                'name' => $attributes['name'] ?? $data->name,
                'address' => $attributes['address'] ?? $data->address,
                'phone' => $attributes['phone'] ?? $data->phone,
                'year' => $attributes['year'] ?? $data->year,
                'leader' => $attributes['leader'] ?? $data->leader,
                'members' => $attributes['members'] ?? $data->members,
                'nib' => $attributes['nib'] ?? $data->nib,
                'income_range' => $attributes['income_range'] ?? $data->income_range,
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Kelompok usaha berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Kelompok usaha gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }

    /* Delete data*/
    public function delete($id)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = KelompokUsaha::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('kelola.kelompok-usaha.index')->with('success', 'Kelompok usaha berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Kelompok usaha gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
