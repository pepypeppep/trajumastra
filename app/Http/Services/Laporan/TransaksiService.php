<?php

namespace App\Http\Services\Laporan;

use App\Models\Transaksi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransaksiService
{
    /* Get alls */
    public function getAll($request)
    {
        $user = $request->user();
        $query = Transaksi::with('uptd', 'staff');

        if ($user->uptd_id) {
            $query->where('uptd_id', $user->uptd_id);
        }

        if ($request->has('periode')) {
            if ($request->periode == 'hari') {
                $query->whereDate('created_at', Carbon::now()->day);
            } elseif ($request->periode == 'bulan') {
                $query->whereMonth('created_at', Carbon::now()->month);
            } elseif ($request->periode == 'tahun') {
                $query->whereYear('created_at', Carbon::now()->year);
            }
        }

        $data = $query->orderByDesc('created_at');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('total_data', function ($row) {
                return rupiah($row->total);
            })
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
        $data = Transaksi::with('staff', 'uptd', 'details')->find($id);

        if (!$data) {
            return null;
        }

        return $data;
    }

    /* Get data revenue */
    public function getRevenue($user)
    {
        $id = $user->id;

        // Check if user has all permissions (superadmin)
        $isSuperadmin = $user->hasAllPermissions();

        $query = Transaksi::query();

        if (!$isSuperadmin) {
            $koordinator = $user;

            if ($koordinator) {
                $query->where('uptd_id', $koordinator->uptd_id);
            } else {
                return $this->getEmptyRevenueData();
            }
        }

        $countToday = (clone $query)->whereDate('created_at', Carbon::now()->day)->count();
        $sumToday = (clone $query)->whereDate('created_at', Carbon::now()->day)->sum('total');

        $countMonth = (clone $query)->whereMonth('created_at', Carbon::now()->month)->count();
        $sumMonth = (clone $query)->whereMonth('created_at', Carbon::now()->month)->sum('total');

        $countYear = (clone $query)->whereYear('created_at', Carbon::now()->year)->count();
        $sumYear = (clone $query)->whereYear('created_at', Carbon::now()->year)->sum('total');

        $countAll = (clone $query)->count();
        $sumAll = (clone $query)->sum('total');

        $today = (object) [
            'count' => $countToday,
            'sum' => rupiah($sumToday),
        ];

        $month = (object) [
            'count' => $countMonth,
            'sum' => rupiah($sumMonth),
        ];

        $year = (object) [
            'count' => $countYear,
            'sum' => rupiah($sumYear),
        ];

        $all = (object) [
            'count' => $countAll,
            'sum' => rupiah($sumAll),
        ];

        $data = (object) [
            'today' => $today,
            'month' => $month,
            'year' => $year,
            'all' => $all
        ];

        return $data;
    }

    // Helper method to return empty revenue data
    protected function getEmptyRevenueData()
    {
        $empty = (object) ['count' => 0, 'sum' => rupiah(0)];

        return (object) [
            'today' => $empty,
            'month' => $empty,
            'year' => $empty,
            'all' => $empty
        ];
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
