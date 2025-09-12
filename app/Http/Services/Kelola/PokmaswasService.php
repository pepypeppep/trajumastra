<?php

namespace App\Http\Services\Kelola;

use App\Models\Kecamatan;
use App\Models\KelompokBinaan;
use App\Models\Masterbidang;
use Illuminate\Support\Facades\DB;
use App\Enums\JenisKelompokBinaanEnum;
use LaravelLang\Lang\Plugins\Breeze\Master;
use Yajra\DataTables\Facades\DataTables;

class PokmaswasService
{
    /* Get alls */
    public function getAll()
    {
        $data = KelompokBinaan::with('kecamatan.kabupaten', 'bidangs')
                ->where('jenis_kelompok', JenisKelompokBinaanEnum::POKMASWAS->value);

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('bidang_data', function ($row) {
                $bidang_data = $row->bidangs->pluck('name')->implode(', ');
                return $bidang_data;
            })
            ->filterColumn('bidang_data', function ($query, $keyword) {
                $query->whereHas('bidangs', function ($q) use ($keyword) {
                    $q->where('master_bidangs.name', 'like', "%{$keyword}%");
                });
            })
            ->orderColumn('bidang_data', function ($query, $order) {
                $query->orderBy(
                    DB::raw('(SELECT GROUP_CONCAT(master_bidangs.name) FROM master_bidangs
                        JOIN kelompok_binaan_bidang ON master_bidangs.id = kelompok_binaan_bidang.bidang_id
                        WHERE kelompok_binaan_bidang.kelompok_binaan_id = kelompok_binaans.id)'),
                    $order
                );
            })
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';

                // Btn Edit
                if (auth()->user()->can('kelola-pokmaswas.update')) {
                    $btnEdit = '<button href="javascript:void(0);" title="Ubah data Pokmaswas" id="btn-modal-edit"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.pokmaswas.update', $row->id) . '" data-url-get="' . route('kelola.pokmaswas.edit', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('kelola-pokmaswas.delete')) {
                    $btnDelete = '<button href="javascript:void(0);" title="Hapus data Pokmaswas" id="btn-delete" onclick="confirmDelete(this)"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.pokmaswas.destroy', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                        <i class="ri-delete-bin-line"></i>
                        </button>';
                }

                return $btnEdit . ' ' . $btnDelete;
            })
            ->escapeColumns([])
            ->make(true);
    }

    /* Get kecamatan */
    public function getAllKecamatan()
    {
        $data = Kecamatan::with('kabupaten')->get();
        return $data;
    }

    /* Get All Bidang */
    public function getAllBidang()
    {
        $data = MasterBidang::get();
        return $data;
    }
    /* Get data by ID */
    public function getById(int $id)
    {
        $data = KelompokBinaan::with('kecamatan.kabupaten', 'bidangs')->findOrFail($id);
        $data->bidang_ids = $data->bidangs()->pluck('master_bidangs.id')->toArray();

        return $data;
    }

    /* Store new data*/
    public function store(array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();
            $data = KelompokBinaan::create([
                'jenis_kelompok' => JenisKelompokBinaanEnum::POKMASWAS->value,
                'kecamatan_id' => $attributes['kecamatan_id'],
                'name' => $attributes['name'],
                'address' => $attributes['address'],
                'phone' => $attributes['phone'],
                'year' => $attributes['year'],
                'leader' => $attributes['leader'],
                'members' => $attributes['members'],
            ]);

            $bidangIds = [];
            foreach ($attributes['bidang_id'] as $bidangId) {
                $bidang = MasterBidang::findOrFail($bidangId);
                $bidangIds[] = $bidang->id;
            }

            // Attach to Pokmaswas (sync prevents duplicates)
            $data->bidangs()->sync($bidangIds);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Pokmaswas berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Pokmaswas gagal ditambahkan. Error :' . $e->getMessage()]);
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
                'address' => $attributes['address'] ?? $data->address,
                'phone' => $attributes['phone'] ?? $data->phone,
                'year' => $attributes['year'] ?? $data->year,
                'leader' => $attributes['leader'] ?? $data->leader,
                'members' => $attributes['members'] ?? $data->members,
            ]);

            $bidangIds = [];
            foreach ($attributes['bidang_id'] as $bidangId) {
                $bidang = MasterBidang::findOrFail($bidangId);
                $bidangIds[] = $bidang->id;
            }

            // Attach to Pokmaswas (sync prevents duplicates)
            $data->bidangs()->sync($bidangIds);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Pokmaswas berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Pokmaswas gagal diperbarui. Error :' . $e->getMessage()]);
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
            return redirect()->route('kelola.pokmaswas.index')->with('success', 'Pokmaswas berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Pokmaswas gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
