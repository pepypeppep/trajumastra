<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Master\JenisTransaksiService;
use App\Http\Requests\Master\JenisTransaksi\CreateRequest;
use App\Http\Requests\Master\JenisTransaksi\UpdateRequest;

class JenisTransaksiController extends Controller
{
    public function __construct(protected JenisTransaksiService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('jenis-transaksi.read');

        // Get data jenis transaksi for data table
        if (request()->ajax()) {
            return $this->service->getAll();
        }

        return view('admin.masters.jenis-transaksi.index');
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
    public function store(CreateRequest $request)
    {
        $this->setRule('jenis-transaksi.create');

        // Store process
        return $this->service->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->setRule('jenis-transaksi.update');

        return $this->service->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('jenis-transaksi.update');
        // Update process
        return $this->service->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('jenis-transaksi.delete');
        // Delete Process
        return $this->service->delete($id);
    }
}
