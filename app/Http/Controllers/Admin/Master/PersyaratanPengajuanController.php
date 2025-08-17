<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Services\Master\PersayaratanPengajuanBbmService;
use App\Http\Requests\Master\PersayaratanPengajuanBbm\CreateRequest;
use App\Http\Requests\Master\PersayaratanPengajuanBbm\UpdateRequest;

class PersyaratanPengajuanController extends Controller
{
    public function __construct(protected PersayaratanPengajuanBbmService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('persyaratan-pengajuan.read');

        // Get data jenis ikan for data table
        if (request()->ajax()) {
            return $this->service->getAll();
        }

        return view('admin.masters.persyaratan-pengajuan.index');
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
        $this->setRule('persyaratan-pengajuan.create');

        // Store process
        return $this->service->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->setRule('persyaratan-pengajuan.update');

        return $this->service->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('persyaratan-pengajuan.update');
        // Update process
        return $this->service->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('persyaratan-pengajuan.delete');
        // Delete Process
        return $this->service->delete($id);
    }
}
