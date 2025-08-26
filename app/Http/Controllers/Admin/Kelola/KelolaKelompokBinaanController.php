<?php

namespace App\Http\Controllers\Admin\Kelola;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Kelola\KelompokBinaanService;
use App\Http\Requests\Kelola\KelompokBinaan\CreateRequest;
use App\Http\Requests\Kelola\KelompokBinaan\UpdateRequest;

class KelolaKelompokBinaanController extends Controller
{
    public function __construct(protected KelompokBinaanService $kelompokBinaanService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('kelola-kelompok-binaan.read');
        // Load data for data table (server side - AJAX)
        if (request()->ajax()) {
            return $this->kelompokBinaanService->getAll();
        }
        // Get data
        $kalurahans = $this->kelompokBinaanService->getAllKalurahan();
        return view('admin.kelolas.kelompok-binaan.index', compact('kalurahans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('kelola-kelompok-binaan.create');

        // Store Process
        return $this->kelompokBinaanService->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->setRule('kelola-kelompok-binaan.update');
        return $this->kelompokBinaanService->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $this->setRule('kelola-kelompok-binaan.update');

        // Update Process
        return $this->kelompokBinaanService->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->setRule('kelola-kelompok-binaan.delete');
        // Delete Process
        return $this->kelompokBinaanService->delete($id);
    }
}
