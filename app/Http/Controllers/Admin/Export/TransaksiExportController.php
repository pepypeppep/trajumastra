<?php

namespace App\Http\Controllers\Admin\Export;

use Illuminate\Http\Request;
use App\Exports\TransaksiExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Services\Export\TransaksiExportService;

class TransaksiExportController extends Controller
{
    public function __construct(protected TransaksiExportService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function export(Request $request)
    {
        $data = $this->service->getAll($request);

        return Excel::download(new TransaksiExport($data), 'Transaksi.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
