<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Services\Master\JenisUsahaSaranaService;
use App\Http\Requests\Master\JenisUsahaSarana\CreateRequest;
use App\Http\Requests\Master\JenisUsahaSarana\UpdateRequest;

class JenisUsahaSaranaController extends Controller
{
    public function __construct(protected JenisUsahaSaranaService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('jenis-usaha-sarana.read');

        // Get data jenis usaha-sarana for data table
        if (request()->ajax()) {
            return $this->service->getAll();
        }

        return view('admin.masters.jenis-usaha-sarana.index');
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
        $this->setRule('jenis-usaha-sarana.create');

        // Store process
        return $this->service->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->setRule('jenis-usaha-sarana.update');

        return $this->service->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('jenis-usaha-sarana.update');
        // Update process
        return $this->service->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('jenis-usaha-sarana.delete');
        // Delete Process
        return $this->service->delete($id);
    }
}
