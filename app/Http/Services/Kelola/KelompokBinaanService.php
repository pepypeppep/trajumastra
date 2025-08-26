<?php

namespace App\Http\Services\Kelola;

use App\Models\Kalurahan;
use Illuminate\Support\Str;
use App\Models\KelompokBinaan;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KelompokBinaanService
{
    /* Get alls */
    public function getAll()
    {
        $data = KelompokBinaan::with('kalurahan');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('address', function ($row) {
                return $row->address ? (Str::length($row->address) > 25 ? Str::substr($row->address, 0, 25) . '...' : $row->address) : '-';
            })
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';
                // Btn Edit
                if (auth()->user()->can('kelola-kelompok-binaan.update')) {
                    $btnEdit = '<button title="Ubah data kelompok binaan"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.kelompok-binaan.update', $row->id) . '" data-url-get="' . route('kelola.kelompok-binaan.edit', $row->id) . '"
                        class="btn-modal-edit items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('kelola-kelompok-binaan.delete')) {
                    $btnDelete = '<button title="Hapus data kelompok binaan"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.kelompok-binaan.destroy', $row->id) . '"
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

    /* Get data by ID */
    public function getById(int $id)
    {
        $data = KelompokBinaan::findOrFail($id);
        return $data;
    }

    /* Store new data*/
    public function store(array $datas)
    {
        try {
            // DB Transaction
            DB::beginTransaction();
            $kelompokBinaan = KelompokBinaan::create([
                'kalurahan_id' => $datas['kalurahan_id'],
                'name' => $datas['name'],
                'email' => $datas['email'],
                'year' => $datas['year'],
                'phone' => $datas['phone'],
                'address' => $datas['address'],
                'npwp' => $datas['npwp'],
                'sk' => $datas['sk'],
                'certificate_number' => $datas['certificate_number']
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Kelompok binaan berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Kelompok binaan gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }

    /* Update data*/
    public function update($id, array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = KelompokBinaan::findOrFail($id);
            // Update data data
            $data->update([
                'kalurahan_id' => $attributes['kalurahan_id'] ?? $data->kalurahan_id,
                'name' => $attributes['name'] ?? $data->name,
                'email' => $attributes['email'] ?? $data->email,
                'year' => $attributes['year'] ?? $data->year,
                'phone' => $attributes['phone'] ?? $data->phone,
                'address' => $attributes['address'] ?? $data->address,
                'npwp' => $attributes['npwp'] ?? $data->npwp,
                'sk' => $attributes['sk'] ?? $data->sk,
                'certificate_number' => $attributes['certificate_number'] ?? $data->certificate_number
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Kelompok binaan berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Kelompok binaan gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }

    /* Delete data*/
    public function delete($id)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = KelompokBinaan::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('kelola.kelompok-binaan.index')->with('success', 'Kelompok binaan berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Kelompok binaan gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
