<?php

namespace App\Http\Services\Kelola;

use App\Models\Pokdakan;
use App\Models\Kalurahan;
use App\Models\MasterJenisAset;
use App\Models\MasterJenisIkan;
use App\Models\MasterJenisUsaha;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PoklasharService
{
    /* Get alls */
    public function getAll()
    {
        $data = Pokdakan::with('kalurahan.kecamatan.kabupaten', 'jenis_ikans', 'jenis_usahas', 'jenis_kolams');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('jenis_ikan_data', function ($row) {
                $jenis_ikan_data = $row->jenis_ikans->pluck('name')->implode(', ');
                return $jenis_ikan_data;
            })
            ->filterColumn('jenis_ikan_data', function ($query, $keyword) {
                $query->whereHas('jenis_ikans', function ($q) use ($keyword) {
                    $q->where('master_jenis_ikans.name', 'like', "%{$keyword}%");
                });
            })
            ->orderColumn('jenis_ikan_data', function ($query, $order) {
                $query->orderBy(
                    DB::raw('(SELECT GROUP_CONCAT(master_jenis_ikans.name) FROM master_jenis_ikans
                          JOIN pokdakan_jenis_ikan ON master_jenis_ikans.id = pokdakan_jenis_ikan.jenis_ikan_id
                          WHERE pokdakan_jenis_ikan.pokdakan_id = pokdakans.id)'),
                    $order
                );
            })
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
                          JOIN pokdakan_jenis_usaha ON master_jenis_usahas.id = pokdakan_jenis_usaha.jenis_usaha_id
                          WHERE pokdakan_jenis_usaha.pokdakan_id = pokdakans.id)'),
                    $order
                );
            })
            ->addColumn('jenis_kolam_data', function ($row) {
                $jenis_kolam_data = $row->jenis_kolams->pluck('name')->implode(', ');
                return $jenis_kolam_data;
            })
            ->filterColumn('jenis_kolam_data', function ($query, $keyword) {
                $query->whereHas('jenis_kolams', function ($q) use ($keyword) {
                    $q->where('master_jenis_asets.name', 'like', "%{$keyword}%");
                });
            })
            ->orderColumn('jenis_kolam_data', function ($query, $order) {
                $query->orderBy(
                    DB::raw('(SELECT GROUP_CONCAT(master_jenis_asets.name) FROM master_jenis_asets
                          JOIN pokdakan_jenis_kolam ON master_jenis_asets.id = pokdakan_jenis_kolam.jenis_aset_id
                          WHERE pokdakan_jenis_kolam.pokdakan_id = pokdakans.id)'),
                    $order
                );
            })
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';

                // Btn Edit
                if (auth()->user()->can('kelola-pokdakan.update')) {
                    $btnEdit = '<button href="javascript:void(0);" title="Ubah data pokdakan" id="btn-modal-edit"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.pokdakan.update', $row->id) . '" data-url-get="' . route('kelola.pokdakan.edit', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('kelola-pokdakan.delete')) {
                    $btnDelete = '<button href="javascript:void(0);" title="Hapus data pokdakan" id="btn-delete" onclick="confirmDelete(this)"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.pokdakan.destroy', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                        <i class="ri-delete-bin-line"></i>
                        </button>';
                }

                return $btnEdit . ' ' . $btnDelete;
            })
            ->escapeColumns([])
            ->make(true);
    }

    /* Get kalurahan */
    public function getAllKalurahan()
    {
        $data = Kalurahan::with('kecamatan.kabupaten')->get();
        return $data;
    }

    /* Get jenis ikan */
    public function getAllJenisIkan()
    {
        $data = MasterJenisIkan::get();
        return $data;
    }

    /* Get jenis usaha */
    public function getAllJenisUsaha()
    {
        $data = MasterJenisUsaha::get();
        return $data;
    }

    /* Get jenis kolam */
    public function getAllJenisKolam()
    {
        $data = MasterJenisAset::get();
        return $data;
    }

    /* Get data by ID */
    public function getById(int $id)
    {
        $data = Pokdakan::with('kalurahan.kecamatan.kabupaten', 'jenis_ikans', 'jenis_usahas', 'jenis_kolams')->findOrFail($id);

        return $data;
    }

    /* Store new data*/
    public function store(array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();
            $data = Pokdakan::create([
                'kalurahan_id' => $attributes['kalurahan_id'],
                'name' => $attributes['name'],
                'address' => $attributes['address'],
                'phone' => $attributes['phone'],
                'year' => $attributes['year'],
                'leader' => $attributes['leader'],
                'members' => $attributes['members']
            ]);

            $jenisIkanIds = [];
            foreach ($attributes['jenis_ikan_id'] as $jenisIkanId) {
                $jenisIkan = MasterJenisIkan::findOrFail($jenisIkanId);
                $jenisIkanIds[] = $jenisIkan->id;
            }

            // Attach to pokdakan (sync prevents duplicates)
            $data->jenis_ikans()->sync($jenisIkanIds);

            $jenisUsahaIds = [];
            foreach ($attributes['jenis_usaha_id'] as $jenisUsahaId) {
                $jenisUsaha = MasterJenisUsaha::findOrFail($jenisUsahaId);
                $jenisUsahaIds[] = $jenisUsaha->id;
            }

            // Attach to pokdakan (sync prevents duplicates)
            $data->jenis_usahas()->sync($jenisUsahaIds);

            $jenisKolamIds = [];
            foreach ($attributes['jenis_kolam_id'] as $jenisKolamId) {
                $jenisKolam = MasterJenisAset::findOrFail($jenisKolamId);
                $jenisKolamIds[] = $jenisKolam->id;
            }

            // Attach to pokdakan (sync prevents duplicates)
            $data->jenis_kolams()->sync($jenisKolamIds);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Pokdakan berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Pokdakan gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }

    /* Update data*/
    public function update($id, array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = Pokdakan::findOrFail($id);
            // Update data data
            $data->update([
                'kalurahan_id' => $attributes['kalurahan_id'] ?? $data->kalurahan_id,
                'name' => $attributes['name'] ?? $data->name,
                'address' => $attributes['address'] ?? $data->address,
                'phone' => $attributes['phone'] ?? $data->phone,
                'year' => $attributes['year'] ?? $data->year,
                'leader' => $attributes['leader'] ?? $data->leader,
                'members' => $attributes['members'] ?? $data->members
            ]);

            $jenisIkanIds = [];
            foreach ($attributes['jenis_ikan_id'] as $jenisIkanId) {
                $jenisIkan = MasterJenisIkan::findOrFail($jenisIkanId);
                $jenisIkanIds[] = $jenisIkan->id;
            }

            // Attach to pokdakan (sync prevents duplicates)
            $data->jenis_ikans()->sync($jenisIkanIds);

            $jenisUsahaIds = [];
            foreach ($attributes['jenis_usaha_id'] as $jenisUsahaId) {
                $jenisUsaha = MasterJenisUsaha::findOrFail($jenisUsahaId);
                $jenisUsahaIds[] = $jenisUsaha->id;
            }

            // Attach to pokdakan (sync prevents duplicates)
            $data->jenis_usahas()->sync($jenisUsahaIds);

            $jenisKolamIds = [];
            foreach ($attributes['jenis_kolam_id'] as $jenisKolamId) {
                $jenisKolam = MasterJenisAset::findOrFail($jenisKolamId);
                $jenisKolamIds[] = $jenisKolam->id;
            }

            // Attach to pokdakan (sync prevents duplicates)
            $data->jenis_kolams()->sync($jenisKolamIds);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Pokdakan berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Pokdakan gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }

    /* Delete data*/
    public function delete($id)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = Pokdakan::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('kelola.pokdakan.index')->with('success', 'Pokdakan berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Pokdakan gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
