<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Services\Master\JenisKlasifikasiUsahaService;
use App\Http\Requests\Master\JenisKlasifikasiUsaha\CreateRequest;
use App\Http\Requests\Master\JenisKlasifikasiUsaha\UpdateRequest;

class JenisKlasifikasiUsahaController extends Controller
{
    public function __construct(protected JenisKlasifikasiUsahaService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('jenis-klasifikasi-usaha.read');

        // Get data jenis klasifikasi-usaha for data table
        if (request()->ajax()) {
            return $this->service->getAll();
        }

        return view('admin.masters.jenis-klasifikasi-usaha.index');
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
        $this->setRule('jenis-klasifikasi-usaha.create');

        // Store process
        return $this->service->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->setRule('jenis-klasifikasi-usaha.update');

        return $this->service->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('jenis-klasifikasi-usaha.update');
        // Update process
        return $this->service->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('jenis-klasifikasi-usaha.delete');
        // Delete Process
        return $this->service->delete($id);
    }
}
