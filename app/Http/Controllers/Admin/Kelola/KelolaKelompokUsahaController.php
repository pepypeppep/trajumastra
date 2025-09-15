<?php

namespace App\Http\Controllers\Admin\Kelola;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Kelola\KelompokUsahaService;
use App\Http\Requests\Kelola\KelompokUsaha\CreateRequest;
use App\Http\Requests\Kelola\KelompokUsaha\UpdateRequest;

class KelolaKelompokUsahaController extends Controller
{
    public function __construct(protected KelompokUsahaService $kelompokUsahaService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('kelola-kelompok-usaha.read');
        // Load data for data table (server side - AJAX)
        if (request()->ajax()) {
            return $this->kelompokUsahaService->getAll();
        }
        // -- Get data
        // Get all Kalurahan
        $kalurahans = $this->kelompokUsahaService->getAllKalurahan();
        // Get all Bentuk Usaha
        $bentukUsahas = $this->kelompokUsahaService->getAllBentukUsaha();
        // Get all Range Penghasilan
        $rangePenghasilans = $this->kelompokUsahaService->getRangePenghasilan();
        // Get all Kelompok Binaan that hasn't Kelompok Usaha
        $kelompokBinaans = $this->kelompokUsahaService->getKelompokBinaanHasntKelompokUsaha();
        
        // Return view
        return view('admin.kelolas.kelompok-usaha.index', compact('kalurahans', 'bentukUsahas', 'rangePenghasilans', 'kelompokBinaans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('kelola-kelompok-usaha.create');

        // Store Process
        return $this->kelompokUsahaService->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->setRule('kelola-kelompok-usaha.update');
        return $this->kelompokUsahaService->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $this->setRule('kelola-kelompok-usaha.update');

        // Update Process
        return $this->kelompokUsahaService->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->setRule('kelola-kelompok-usaha.delete');
        // Delete Process
        return $this->kelompokUsahaService->delete($id);
    }

    public function getKelompokBinaanById($id)
    {
        $this->setRule('kelola-kelompok-usaha.read');
        return $this->kelompokUsahaService->getKelompokBinaanById($id);
    }
}
