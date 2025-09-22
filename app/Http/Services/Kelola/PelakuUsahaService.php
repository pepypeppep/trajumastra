<?php

namespace App\Http\Services\Kelola;

use App\Models\User;
use App\Enums\RoleEnum;
use App\Models\Kalurahan;
use App\Models\PelakuUsaha;
use App\Models\KelompokBinaan;
use App\Models\MasterJenisUsaha;
use App\Models\MasterBentukUsaha;
use Illuminate\Support\Facades\DB;
use App\Models\MasterRangePenghasilan;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PelakuUsahaService
{
    /* Get alls */
    public function getAll()
    {
        $data = PelakuUsaha::with('kalurahan', 'kelompokBinaan', 'bentukUsaha', 'jenisUsaha', 'user')
            ->select('pelaku_usahas.*');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('kelompok_binaan_data', function ($row) {
                return $row->kelompokBinaan ? $row->kelompokBinaan->name : '-';
            })
            ->filterColumn('kelompok_binaan_data', function ($query, $keyword) {
                $query->whereHas('kelompokBinaan', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->orderColumn('kelompok_binaan_data', function ($query, $order) {
                $query->orderBy(
                    DB::raw('(SELECT name FROM kelompok_binaans WHERE kelompok_binaans.id = pelaku_usahas.kelompok_binaan_id)'),
                    $order
                );
            })
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';
                // Btn Edit
                if (auth()->user()->can('kelola-pelaku-usaha.update')) {
                    $btnEdit = '<button title="Ubah data pelaku usaha"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.pelaku-usaha.update', $row->id) . '" data-url-get="' . route('kelola.pelaku-usaha.edit', $row->id) . '"
                        class="btn-modal-edit items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('kelola-pelaku-usaha.delete')) {
                    $btnDelete = '<button title="Hapus data pelaku usaha"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.pelaku-usaha.destroy', $row->id) . '"
                        class="btn-delete items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
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
        $data = Kalurahan::with('kecamatan.kabupaten')->orderBy('name')->get();
        return $data;
    }

    /* Get all jenis usaha */
    public function getAllJenisUsaha()
    {
        $data = MasterJenisUsaha::orderBy('name')->get();
        return $data;
    }

    /* Get all Bentuk usaha */
    public function getAllBentukUsaha()
    {
        $data = MasterBentukUsaha::orderBy('name')->get();
        return $data;
    }

    /* Get all Kelompok Binaan */
    public function getAllKelompokBinaan()
    {
        $data = KelompokBinaan::orderBy('name')->get();
        return $data;
    }

    /* Get all range penghasilan */
    public function getAllRangePenghasilan()
    {
        $data = MasterRangePenghasilan::orderBy('name')->get();
        return $data;
    }

    /* Get data by ID */
    public function getById(int $id)
    {
        $data = PelakuUsaha::with('user')->findOrFail($id);
        return $data;
    }

    /* Get User Has Pelaku Usaha Role */
    public function getUsersHasPelakuUsahaRole()
    {
        $users = User::role(RoleEnum::PELAKU_USAHA->value)->get();
        return $users;
    }

    /* Store new data*/
    public function store(array $datas)
    {
        try {
            // DB Transaction
            DB::beginTransaction();
            // Check attachment
            if ($datas['attachment'] != null) {
                $attachmentName = strtotime(now()) . '.' . $datas['attachment']->getClientOriginalExtension();
                $attachmentPath = Storage::disk('local')->put('pelaku_usaha/' . $attachmentName, file_get_contents($datas['attachment']));
                $attachment = 'pelaku_usaha/' . $attachmentName;
            }

            $pelakuUsaha = PelakuUsaha::create([
                'user_id' => $datas['user_id'],
                'kalurahan_id' => $datas['kalurahan_id'],
                'kelompok_binaan_id' => $datas['kelompok_binaan_id'],
                'bentuk_usaha_id' => $datas['bentuk_usaha_id'],
                'jenis_usaha_id' => $datas['jenis_usaha_id'],
                'address' => $datas['address'],
                'npwp' => $datas['npwp'],
                'siup' => $datas['siup'],
                'income_range' => $datas['income_range'],
                'have_ship' => $datas['have_ship'],
                'attachment' => $attachment ?? null,
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Pelaku usaha berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Pelaku usaha gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }

    /* Update data*/
    public function update($id, array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = PelakuUsaha::findOrFail($id);
            // Check attachment
            if ($attributes['attachment'] != null) {
                $attachmentName = strtotime(now()) . '.' . $attributes['attachment']->getClientOriginalExtension();
                $attachmentPath = Storage::disk('local')->put('pelaku_usaha/' . $attachmentName, file_get_contents($attributes['attachment']));
                $attachment = 'pelaku_usaha/' . $attachmentName;
                // Delete old attachment if exists
                if ($data->attachment && Storage::disk('local')->exists($data->attachment)) {
                    Storage::disk('local')->delete($data->attachment);
                }
            }
            // Update data data
            $data->update([
                'user_id' => $datas['user_id'] ?? $data['user_id'],
                'kalurahan_id' => $attributes['kalurahan_id'] ?? $data->kalurahan_id,
                'kelompok_binaan_id' => $attributes['kelompok_binaan_id'] ?? $data->kelompok_binaan_id,
                'bentuk_usaha_id' => $attributes['bentuk_usaha_id'] ?? $data->bentuk_usaha_id,
                'jenis_usaha_id' => $attributes['jenis_usaha_id'] ?? $data->jenis_usaha_id,
                'address' => $attributes['address'] ?? $data->address,
                'npwp' => $attributes['npwp'] ?? $data->npwp,
                'siup' => $attributes['siup'] ?? $data->siup,
                'income_range' => $attributes['income_range'] ?? $data->income_range,
                'have_ship' => $attributes['have_ship'] ?? $data->have_ship,
                'attachment' => $attachment ?? $data->attachment,
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Pelaku usaha berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Pelaku usaha gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }

    /* Delete data*/
    public function delete($id)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = PelakuUsaha::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('kelola.pelaku-usaha.index')->with('success', 'Pelaku usaha berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Pelaku usaha gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
