<?php

namespace App\Http\Services;

use App\Enums\JenisKelompokBinaanEnum;
use App\Models\Uptd;
use App\Models\Penyuluh;
use App\Models\Transaksi;
use App\Models\PelakuUsaha;
use App\Models\KelompokBinaan;
use App\Models\KelompokUsaha;
use Illuminate\Support\Carbon;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\DB;
use App\Models\SuratRekomendasiBbm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardService
{
    /* Get data count */
    public function getDataCount(Request $request)
    {
        $total_pelaku_usaha = PelakuUsaha::count();
        $total_penyuluh = Penyuluh::count();
        $total_kelompok_binaan = KelompokBinaan::count();
        $total_kelompok_usaha = KelompokUsaha::count();
        $total_pokdakan = KelompokBinaan::where('jenis_kelompok', JenisKelompokBinaanEnum::POKDAKAN->value)->count();
        $total_rekomendasi_bbm = SuratRekomendasiBbm::count();
        $total_uptd = Uptd::where('type', Uptd::UPTD)->count();
        $total_tpi = Uptd::where('type', Uptd::TPI)->count();

        return [
            'total_pelaku_usaha' => $total_pelaku_usaha,
            'total_penyuluh' => $total_penyuluh,
            'total_kelompok_binaan' => $total_kelompok_binaan,
            'total_kelompok_usaha' => $total_kelompok_usaha,
            'total_pokdakan' => $total_pokdakan,
            'total_rekomendasi_bbm' => $total_rekomendasi_bbm,
            'total_uptd' => $total_uptd,
            'total_tpi' => $total_tpi,
            'total_koordinator' => 0
        ];
    }

    /* Get popular fish */
    public function getPopularFish(Request $request)
    {
        $user = $request->user();
        $limit = 4;
        if ($request->uptd) {
            $limit = 999;
        }
        // $detail = TransaksiDetail::selectRaw('master_jenis_ikans_id, sum(quantity) as total_quantity, sum(total) as total_price')
        //     ->groupBy('master_jenis_ikans_id')
        //     ->with(['transaksi' => function ($query) use ($user, $request) {
        //         if ($request->uptd) {
        //             $query->where('uptd_id', $request->uptd);
        //         }
        //         if ($user->uptd_id) {
        //             $query->where('uptd_id', $user->uptd_id);
        //         }
        //     }, 'jenis_ikan'])
        //     ->whereHas('transaksi', function ($query) use ($user, $request) {
        //         if ($request->uptd) {
        //             $query->where('uptd_id', $request->uptd);
        //         }
        //         if ($user->uptd_id) {
        //             $query->where('uptd_id', $user->uptd_id);
        //         }
        //     })
        //     ->orderByDesc('total_price')
        //     ->limit($limit)
        //     ->get();
        $detail = TransaksiDetail::selectRaw('master_jenis_ikans_id, sum(quantity) as total_quantity, sum(total) as total_price')
            ->groupBy('master_jenis_ikans_id')
            ->with(['jenis_ikan'])
            ->whereHas('transaksi', function ($query) use ($user, $request) {
                if ($request->uptd) {
                    $query->where('uptd_id', $request->uptd);
                } elseif ($user->uptd_id) {
                    $query->where('uptd_id', $user->uptd_id);
                }
            })
            ->orderByDesc('total_quantity')
            ->limit($limit)
            ->get();

        return $detail;
    }

    /* Get transaction count*/
    public function getTransactionCount($request)
    {
        if ($request->uptd) {
            return $this->getUptdTransactionCount($request);
        } else {
            return $this->getGlobalTransactionCount($request);
        }
    }

    public function getGlobalTransactionCount($request)
    {
        $user = $request->user();
        $currentMonth = Carbon::now()->startOfMonth();
        $nextMonth = Carbon::now()->addMonth()->startOfMonth();

        // Generate all dates for current month
        $dates = [];
        $currentDate = $currentMonth->copy();
        while ($currentDate->lt($nextMonth)) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        // Get transaction data
        $transactions = DB::table('transaksis as t')
            ->join('uptds as u', 't.uptd_id', '=', 'u.id')
            ->select(
                DB::raw('DATE(t.created_at) as date'),
                'u.type',
                DB::raw('COUNT(t.id) as count')
            )
            ->whereBetween('t.created_at', [$currentMonth, $nextMonth])
            ->when($user->uptd_id, function ($query) use ($user) {
                $query->where('t.uptd_id', $user->uptd_id);
            })
            ->groupBy(DB::raw('DATE(t.created_at)'), 'u.type')
            ->get()
            ->groupBy('date');

        // Prepare data arrays
        $uptdData = array_fill(0, count($dates), 0);
        $tpiData = array_fill(0, count($dates), 0);

        // Fill data arrays
        foreach ($dates as $index => $date) {
            if (isset($transactions[$date])) {
                foreach ($transactions[$date] as $transaction) {
                    if ($transaction->type == 2) { // UPTD
                        $uptdData[$index] = $transaction->count;
                    } elseif ($transaction->type == 1) { // TPI
                        $tpiData[$index] = $transaction->count;
                    }
                }
            }
        }

        return [
            'series' => [
                [
                    'name' => 'Transaksi BBI',
                    'type' => 'area',
                    'data' => $uptdData
                ],
                [
                    'name' => 'Transaksi TPI',
                    'type' => 'line',
                    'data' => $tpiData
                ]
            ],
            'labels' => $dates
        ];
    }

    public function getUptdTransactionCount($request)
    {
        $uptd_id = $request->uptd;
        $uptd = Uptd::find($uptd_id);
        $currentMonth = Carbon::now()->startOfMonth();
        $nextMonth = Carbon::now()->addMonth()->startOfMonth();

        // Generate all dates for current month
        $dates = [];
        $currentDate = $currentMonth->copy();
        while ($currentDate->lt($nextMonth)) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        // Get transaction data
        $transactions = DB::table('transaksis as t')
            ->join('uptds as u', 't.uptd_id', '=', 'u.id')
            ->select(
                DB::raw('DATE(t.created_at) as date'),
                'u.type',
                DB::raw('COUNT(t.id) as count')
            )
            ->whereBetween('t.created_at', [$currentMonth, $nextMonth])
            ->where('t.uptd_id', $uptd_id)
            ->groupBy(DB::raw('DATE(t.created_at)'), 'u.type')
            ->get()
            ->groupBy('date');

        // Prepare data arrays
        $respData = array_fill(0, count($dates), 0);

        // Fill data arrays
        foreach ($dates as $index => $date) {
            if (isset($transactions[$date])) {
                foreach ($transactions[$date] as $transaction) {
                    $respData[$index] = $transaction->count;
                }
            }
        }

        $type = $uptd->type == Uptd::UPTD ? 'BBI' : 'TPI';

        return [
            'series' => [
                [
                    'name' => 'Transaksi ' . $type,
                    'type' => 'area',
                    'data' => $respData
                ]
            ],
            'labels' => $dates
        ];
    }

    /* Get transaction amount */
    public function getTransactionAmount(Request $request)
    {
        if ($request->uptd) {
            return $this->getUptdTransactionAmount($request);
        } else {
            return $this->getGlobalTransactionAmount($request);
        }
    }

    public function getGlobalTransactionAmount($request)
    {
        $user = $request->user();
        $currentMonth = Carbon::now()->startOfMonth();
        $nextMonth = Carbon::now()->addMonth()->startOfMonth();

        // Generate all dates for current month
        $dates = [];
        $currentDate = $currentMonth->copy();
        while ($currentDate->lt($nextMonth)) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        // Get transaction data
        $transactions = DB::table('transaksis as t')
            ->join('uptds as u', 't.uptd_id', '=', 'u.id')
            ->select(
                DB::raw('DATE(t.created_at) as date'),
                'u.type',
                DB::raw('SUM(t.total) as total_amount')
            )
            ->whereBetween('t.created_at', [$currentMonth, $nextMonth])
            ->when($user->uptd_id, function ($query) use ($user) {
                $query->where('t.uptd_id', $user->uptd_id);
            })
            ->groupBy(DB::raw('DATE(t.created_at)'), 'u.type')
            ->get()
            ->groupBy('date');

        // Prepare data arrays
        $uptdData = array_fill(0, count($dates), 0);
        $tpiData = array_fill(0, count($dates), 0);

        // Fill data arrays
        foreach ($dates as $index => $date) {
            if (isset($transactions[$date])) {
                foreach ($transactions[$date] as $transaction) {
                    if ($transaction->type == 2) { // UPTD
                        $uptdData[$index] = $transaction->total_amount;
                    } elseif ($transaction->type == 1) { // TPI
                        $tpiData[$index] = $transaction->total_amount;
                    }
                }
            }
        }

        $uptdTotal = array_sum($uptdData);
        $tpiTotal = array_sum($tpiData);
        $grandTotal = $uptdTotal + $tpiTotal;

        return [
            'series' => [
                [
                    'name' => 'Transaksi BBI',
                    'data' => $uptdData
                ],
                [
                    'name' => 'Transaksi TPI',
                    'data' => $tpiData
                ]
            ],
            'labels' => $dates,
            'uptdTotal' => $uptdTotal,
            'tpiTotal' => $tpiTotal,
            'grandTotal' => $grandTotal
        ];
    }

    public function getUptdTransactionAmount($request)
    {
        $uptd_id = $request->uptd;
        $uptd = Uptd::find($uptd_id);
        $currentMonth = Carbon::now()->startOfMonth();
        $nextMonth = Carbon::now()->addMonth()->startOfMonth();

        // Generate all dates for current month
        $dates = [];
        $currentDate = $currentMonth->copy();
        while ($currentDate->lt($nextMonth)) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        // Get transaction data
        $transactions = DB::table('transaksis as t')
            ->join('uptds as u', 't.uptd_id', '=', 'u.id')
            ->select(
                DB::raw('DATE(t.created_at) as date'),
                'u.type',
                DB::raw('SUM(t.total) as total_amount')
            )
            ->whereBetween('t.created_at', [$currentMonth, $nextMonth])
            ->where('t.uptd_id', $uptd_id)
            ->groupBy(DB::raw('DATE(t.created_at)'), 'u.type')
            ->get()
            ->groupBy('date');

        // Prepare data arrays
        $respData = array_fill(0, count($dates), 0);

        // Fill data arrays
        foreach ($dates as $index => $date) {
            if (isset($transactions[$date])) {
                foreach ($transactions[$date] as $transaction) {
                    $respData[$index] = $transaction->total_amount;
                }
            }
        }

        $respTotal = array_sum($respData);
        $grandTotal = $respTotal;

        return [
            'series' => [
                [
                    'name' => 'Transaksi BBI',
                    'data' => $respData
                ]
            ],
            'labels' => $dates,
            'grandTotal' => $grandTotal
        ];
    }

    /* Get data UPTD */
    public function getUptd()
    {
        $data = Uptd::orderBy('name')->get();

        if (!$data) {
            return null;
        }

        return $data;
    }
}
