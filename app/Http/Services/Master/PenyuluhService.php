<?php

namespace App\Http\Services\Master;

use App\Models\User;
use App\Enums\RoleEnum;
use App\Models\Penyuluh;
use App\Models\PelakuUsaha;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PenyuluhService
{
    /* Get alls */
    public function getAll()
    {
        $data = Penyuluh::with('user')
                ->select('penyuluhs.*');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('ttl', function ($row) {
                if(!empty($row->user->born_place) || !empty($row->user->born_date)){
                    return $row->user->born_place . ', ' . tanggal_indonesia($row->user->born_date);
                }
                return '-';
            })
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';
                // Btn Edit
                if (auth()->user()->can('master-penyuluh.update')) {
                    $btnEdit = '<button title="Ubah data penyuluh"
                        data-id="' . $row->id . '"  data-url-action="' . route('master.penyuluh.update', $row->id) . '" data-url-get="' . route('master.penyuluh.edit', $row->id) . '"
                        class="btn-modal-edit items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('master-penyuluh.delete')) {
                    $btnDelete = '<button title="Hapus data penyuluh"
                        data-id="' . $row->id . '"  data-url-action="' . route('master.penyuluh.destroy', $row->id) . '"
                        class="btn-delete items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
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
        $data = Penyuluh::with('user')->findOrFail($id);
        return $data;
    }

    /* Get User Has Penyuluh Role */
    public function getUsersHasPenyuluhRole()
    {
        $users = User::role(RoleEnum::PENYULUH->value)->get();
        return $users;
    }

    /* Store new data*/
    public function store(array $datas)
    {
        try {
            // DB Transaction
            DB::beginTransaction();
            $penyuluh = Penyuluh::create([
                'user_id' => $datas['user_id']
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Penyuluh berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Penyuluh gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }

    /* Update data*/
    public function update($id, array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = Penyuluh::findOrFail($id);
            // Update data data
            $data->update([
                'user_id' => $attributes['user_id'] ?? $data->user_id
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Penyuluh berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Penyuluh gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }

    /* Delete data*/
    public function delete($id)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = Penyuluh::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('master.penyuluh.index')->with('success', 'Penyuluh berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Penyuluh gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
