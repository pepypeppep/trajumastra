<?php

namespace App\Http\Services\Kelola;

use Carbon\Carbon;
use App\Models\Materi;
use Illuminate\Support\Str;
use App\Models\MasterKategori;
use App\Models\JadwalPenyuluhan;
use Illuminate\Support\Facades\DB;
use App\Models\MasterJenisPenyuluhan;
use App\Enums\JenisPenyuluhanStatusEnum;
use Yajra\DataTables\Facades\DataTables;

class JadwalPendampinganService
{
    /* Get alls */
    public function getAll()
    {
        $data = JadwalPenyuluhan::with('jenisPenyuluhan', 'materi', 'kategori')->orderBy('created_at', 'desc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('jenis_penyuluhan_name', function ($row) {
                return $row->jenisPenyuluhan ? $row->jenisPenyuluhan->name : '-';
            })
            ->addColumn('name', function ($row) {
                return $row->name ? (Str::length($row->name) > 25 ? Str::substr($row->name, 0, 25) . '...' : $row->name) : '-';
            })
            ->addColumn('description', function ($row) {
                return $row->description ? (Str::length($row->description) > 50 ? Str::substr($row->description, 0, 50) . '...' : $row->description) : '-';
            })
            ->addColumn('periode', function ($row) {
                return ($row->start ? tanggal_indonesia($row->start) : '-') . '<br>s/d<br>' . ($row->end ? tanggal_indonesia($row->end) : '-');
            })
            ->addColumn('materi_title', function ($row) {
                return $row->materi ? (Str::length($row->materi->title) > 25 ? Str::substr($row->materi->title, 0, 25) . '...' : $row->materi->title) : '-';
            })
            ->addColumn('status', function ($row) {
                if($row->status == JenisPenyuluhanStatusEnum::VERIFIED->value){
                    return '<span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-500 rounded-full dark:bg-green-700 dark:text-green-500">'. JenisPenyuluhanStatusEnum::VERIFIED->label() .'</span>';
                } elseif($row->status == JenisPenyuluhanStatusEnum::REJECTED->value){
                    return '<span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-500 rounded-full dark:bg-red-700 dark:text-red-500">'. JenisPenyuluhanStatusEnum::REJECTED->label() .'</span>';
                } elseif($row->status == JenisPenyuluhanStatusEnum::NEW->value) {
                    return '<span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-500 rounded-full dark:bg-yellow-700 dark:text-yellow-500">'. JenisPenyuluhanStatusEnum::NEW->label() .'</span>';
                } else {
                    return '-';
                }
            })
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';
                // Btn Edit
                if (auth()->user()->can('kelola-jadwal-pendampingan.update')) {
                    $btnEdit = '<button title="Ubah data jadwal pendampingan service"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.jadwal-pendampingan.update', $row->id) . '" data-url-get="' . route('kelola.jadwal-pendampingan.edit', $row->id) . '"
                        class="btn-modal-edit items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('kelola-jadwal-pendampingan.delete')) {
                    $btnDelete = '<button title="Hapus data jadwal pendampingan service"
                        data-id="' . $row->id . '"  data-url-action="' . route('kelola.jadwal-pendampingan.destroy', $row->id) . '"
                        class="btn-delete items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                        <i class="ri-delete-bin-line"></i>
                        </button>';
                }

                return $btnEdit . ' ' . $btnDelete;
            })
            ->escapeColumns([])
            ->make(true);
    }

    /* Get All Jenis Penyuluhan */
    public function getAllJenisPenyuluhan()
    {
        return MasterJenisPenyuluhan::orderBy('name')->get();
    }

    /* Get All Kategori Penyuluhan */
    public function getAllKategoriPenyuluhan()
    {
        return MasterKategori::orderBy('name')->get();
    }

    /* Get All Materi */
    public function getAllMateri()
    {
        return Materi::orderBy('title')->get();
    }

    /* Get data by ID */
    public function getById(int $id)
    {
        $data = JadwalPenyuluhan::findOrFail($id);
        $data->periode = $data->start . ' to ' . $data->end;
        return $data;
    }

    /* Store new data*/
    public function store(array $datas)
    {
        // Extract start and end date from periode
        $extractPeriode = explode(' to ', $datas['periode']);
        $start = $extractPeriode[0];
        $end = $extractPeriode[1];
        
        // Validate date
        if (empty($start) || empty($end)) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Periode harus diisi dan harus mengandung tanggal mulai dan selesai.']);
        }

        // Validate date format
        if (!Carbon::hasFormat($start, 'Y-m-d') || !Carbon::hasFormat($end, 'Y-m-d')) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Format tanggal tidak valid. Silakan gunakan format Y-m-d.']);
        }
        
        try {
            // DB Transaction
            DB::beginTransaction();
            $jadwalPenyuluhan = JadwalPenyuluhan::create([
                'jenis_penyuluhan_id' => $datas['jenis_penyuluhan_id'],
                'kategori_id' => $datas['kategori_id'],
                'materi_id' => $datas['materi_id'],
                'name' => $datas['name'],
                'description' => $datas['description'],
                'start' => $start,
                'end' => $end,
                'theme' => $datas['theme'],
                'quota' => $datas['quota'],
                'status' => $datas['status']
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Jadwal pendampingan berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Jadwal pendampingan gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }

    /* Update data*/
    public function update($id, array $attributes)
    {
        // Extract start and end date from periode
        $extractPeriode = explode(' to ', $attributes['periode']);
        $start = $extractPeriode[0];
        $end = $extractPeriode[1];
        
        // Validate date
        if (empty($start) || empty($end)) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Periode harus diisi dan harus mengandung tanggal mulai dan selesai.']);
        }

        // Validate date format
        if (!Carbon::hasFormat($start, 'Y-m-d') || !Carbon::hasFormat($end, 'Y-m-d')) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Format tanggal tidak valid. Silakan gunakan format Y-m-d.']);
        }

        try {
            // DB Transaction
            DB::beginTransaction();
            
            // Get data
            $data = JadwalPenyuluhan::findOrFail($id);
            // Update data data
            $data->update([
                'jenis_penyuluhan_id' => $attributes['jenis_penyuluhan_id'],
                'kategori_id' => $attributes['kategori_id'],
                'materi_id' => $attributes['materi_id'],
                'name' => $attributes['name'],
                'description' => $attributes['description'],
                'start' => $start,
                'end' => $end,
                'theme' => $attributes['theme'],
                'quota' => $attributes['quota'],
                'status' => $attributes['status']
            ]);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Jadwal pendampingan berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Jadwal pendampingan gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }

    /* Delete data*/
    public function delete($id)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = JadwalPenyuluhan::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('kelola.jadwal-pendampingan.index')->with('success', 'Jadwal pendampingan berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Jadwal pendampingan gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
