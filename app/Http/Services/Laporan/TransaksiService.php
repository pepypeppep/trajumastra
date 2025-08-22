<?php

namespace App\Http\Services\Laporan;

use App\Models\Uptd;
use App\Models\Transaksi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransaksiService
{
    /* Get alls */
    public function getAll()
    {
        $data = Transaksi::with('uptd', 'staff')->orderByDesc('created_at');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('transaction_at', function ($row) {
                return Carbon::parse($row->created_at)->format('d/m/Y');
            })
            ->addColumn('aksi', function ($row) {
                $btnView = '';
                $btnDelete = '';

                // Btn View
                if (auth()->user()->can('laporan-transaksi-uptd.update')) {
                    $btnView = '<button href="javascript:void(0);" title="Ubah data transaksi" id="btn-modal-show"
                        data-id="' . $row->id . '"  data-url-action="' . route('laporan.transaksi-uptd.update', $row->id) . '" data-url-get="' . route('laporan.transaksi-uptd.show', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-sky-500 border-sky-500 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:border-sky-600 active:ring active:ring-sky-100 dark:ring-sky-400/20">
                        <i class="ri-eye-line"></i>
                        </button>';
                }

                // Btn Delete
                // if (auth()->user()->can('laporan-transaksi-uptd.delete')) {
                //     $btnDelete = '<button href="javascript:void(0);" title="Hapus data transaksi" id="btn-delete" onclick="confirmDelete(this)"
                //         data-id="' . $row->id . '"  data-url-action="' . route('kelola.uptd.destroy', $row->id) . '"
                //         class="items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                //         <i class="ri-delete-bin-line"></i>
                //         </button>';
                // }

                return $btnView;
            })
            ->escapeColumns([])
            ->make(true);
    }

    /* Get data by ID */
    public function getById(int $id)
    {
        $data = Transaksi::with('uptd', 'details')->find($id);

        if (!$data) {
            return null;
        }

        return $data;
    }

    /* Delete data*/
    public function delete($id)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = Transaksi::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('kelola.tpi.index')->with('success', 'Transaksi berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Transaksi gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
