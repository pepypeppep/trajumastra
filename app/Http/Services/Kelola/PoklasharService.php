<?php

namespace App\Http\Services\Kelola;

use App\Models\Kecamatan;
use App\Models\KelompokBinaan;
use App\Models\MasterJenisUsaha;
use Illuminate\Support\Facades\DB;
use App\Enums\JenisKelompokBinaanEnum;
use Yajra\DataTables\Facades\DataTables;

class PoklasharService
{
    /* Get alls */
    public function getAll()
    {
        $data = KelompokBinaan::with('kecamatan.kabupaten', 'jenis_usahas')
                ->where('jenis_kelompok', JenisKelompokBinaanEnum::POKLASHAR->value);

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('jenis_usaha_data', function ($row) {
                $jenis_usaha_data = $row->jenis_usahas->pluck('name')->implode(', ');
                return $jenis_usaha_data;
            })
            ->filterColumn('jenis_usaha_data', function ($query, $keyword) {
                $query->whereHas('jenis_usahas', function ($q) use ($keyword) {
                    $q->where('master_jenis_usahas.name', 'like', "%{$keyword}%");
                });
            })
            ->orderColumn('jenis_usaha_data', function ($query, $order) {
                $query->orderBy(
                    DB::raw('(SELECT GROUP_CONCAT(master_jenis_usahas.name) FROM master_jenis_usahas
                        JOIN kelompok_binaan_jenis_usaha ON master_jenis_usahas.id = kelompok_binaan_jenis_usaha.jenis_usaha_id
                        WHERE kelompok_binaan_jenis_usaha.kelompok_binaan_id = kelompok_binaans.id)'),
                    $order
                );
            })
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';

                // Btn Edit
                if (auth()->user()->can('kelola-poklashar.update')) {
                    $btnEdit = '<button href="javascript:void(0);" title="Ubah data Poklashar" id="btn-modal-edit"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.poklashar.update', $row->id) . '" data-url-get="' . route('kelola.poklashar.edit', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('kelola-poklashar.delete')) {
                    $btnDelete = '<button href="javascript:void(0);" title="Hapus data Poklashar" id="btn-delete" onclick="confirmDelete(this)"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.poklashar.destroy', $row->id) . '"
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

    /* Get jenis usaha */
    public function getAllJenisUsaha()
    {
        $data = MasterJenisUsaha::get();
        return $data;
    }
    /* Get data by ID */
    public function getById(int $id)
    {
        $data = KelompokBinaan::with('kecamatan.kabupaten', 'jenis_usahas')->findOrFail($id);
        $data->jenis_usaha_ids = $data->jenis_usahas()->pluck('master_jenis_usahas.id')->toArray();

        return $data;
    }

    /* Store new data*/
    public function store(array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();
            $data = KelompokBinaan::create([
                'kecamatan_id' => $attributes['kecamatan_id'],
                'name' => $attributes['name'],
                'address' => $attributes['address'],
                'phone' => $attributes['phone'],
                'year' => $attributes['year'],
                'leader' => $attributes['leader'],
                'members' => $attributes['members'],
                'market' => $attributes['market']
            ]);

            $jenisUsahaIds = [];
            foreach ($attributes['jenis_usaha_id'] as $jenisUsahaId) {
                $jenisUsaha = MasterJenisUsaha::findOrFail($jenisUsahaId);
                $jenisUsahaIds[] = $jenisUsaha->id;
            }

            // Attach to Poklashar (sync prevents duplicates)
            $data->jenis_usahas()->sync($jenisUsahaIds);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Poklashar berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Poklashar gagal ditambahkan. Error :' . $e->getMessage()]);
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
                'market' => $attributes['market'] ?? $data->market
            ]);

            $jenisUsahaIds = [];
            foreach ($attributes['jenis_usaha_id'] as $jenisUsahaId) {
                $jenisUsaha = MasterJenisUsaha::findOrFail($jenisUsahaId);
                $jenisUsahaIds[] = $jenisUsaha->id;
            }

            // Attach to Poklashar (sync prevents duplicates)
            $data->jenis_usahas()->sync($jenisUsahaIds);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Poklashar berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Poklashar gagal diperbarui. Error :' . $e->getMessage()]);
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
            return redirect()->route('kelola.poklashar.index')->with('success', 'Poklashar berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Poklashar gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
