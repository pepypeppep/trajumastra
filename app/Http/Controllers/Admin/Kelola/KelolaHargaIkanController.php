<?php

namespace App\Http\Controllers\Admin\Kelola;

use App\Http\Controllers\Controller;
use App\Http\Services\Kelola\HargaIkanService;
use App\Http\Requests\Kelola\HargaIkan\CreateRequest;
use App\Http\Requests\Kelola\HargaIkan\UpdateRequest;

class KelolaHargaIkanController extends Controller
{
    public function __construct(protected HargaIkanService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('kelola-harga-ikan.read');

        // Get data jenis ikan for data table
        if (request()->ajax()) {
            return $this->service->getAll();
        }

        $uptds = $this->service->getAllUptd();
        $jenis_ikans = $this->service->getAllJenisIkan();

        return view('admin.kelolas.harga-ikan.index', compact('uptds', 'jenis_ikans'));
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
        $this->setRule('kelola-harga-ikan.create');

        // Store process
        return $this->service->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->setRule('kelola-harga-ikan.update');

        return $this->service->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('kelola-harga-ikan.update');
        // Update process
        return $this->service->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('kelola-harga-ikan.delete');
        // Delete Process
        return $this->service->delete($id);
    }
}
