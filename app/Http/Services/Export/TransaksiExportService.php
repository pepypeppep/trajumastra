<?php

namespace App\Http\Services\Export;

use App\Models\Uptd;
use App\Models\Transaksi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransaksiExportService
{
    /* Get alls */
    public function getAll($request)
    {
        $user = $request->user();
        $query = Transaksi::with('uptd', 'staff');

        // Keyword filter
        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('invoice_id', 'like', '%' . $request->keyword . '%')
                    ->orWhereHas('uptd', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->keyword . '%');
                    })
                    ->orWhereHas('staff', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->keyword . '%');
                    })
                    ->orWhere('total', 'like', '%' . $request->keyword . '%');
            });
        }

        // UPTD filter
        if ($request->uptd_id) {
            $query->where('uptd_id', $request->uptd_id);
        } elseif ($user->uptd_id) {
            $query->where('uptd_id', $user->uptd_id);
        }

        if ($request->date) {
            if (strpos($request->date, ' to ') === false) {
                $query->whereBetween('created_at', [Carbon::parse($request->date)->startOfDay(), Carbon::parse($request->date)->endOfDay()]);
            }
            $dates = explode(' to ', $request->date);
            if (count($dates) == 2) {
                $start = Carbon::parse(trim($dates[0]))->startOfDay();
                $end   = Carbon::parse(trim($dates[1]))->endOfDay();
                $query->whereBetween('created_at', [$start, $end]);
            }
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

        $data = $query->orderByDesc('created_at')->get();

        return $data;
    }
}
