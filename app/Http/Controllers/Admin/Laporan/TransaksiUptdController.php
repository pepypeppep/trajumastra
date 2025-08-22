<?php

namespace App\Http\Controllers\Admin\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Laporan\TransaksiService;

class TransaksiUptdController extends Controller
{
    public function __construct(protected TransaksiService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('laporan-transaksi-uptd.read');

        if (request()->ajax()) {
            return $this->service->getAll();
        }

        return view('admin.laporans.transaksi-uptd.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->setRule('laporan-transaksi-uptd.read');

        $data = $this->service->getById($id);

        return view('admin.laporans.transaksi-uptd.partials.invoice', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
