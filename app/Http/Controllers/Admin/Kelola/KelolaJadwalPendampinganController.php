<?php

namespace App\Http\Controllers\Admin\Kelola;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Kelola\JadwalPendampinganService;
use App\Http\Requests\Kelola\JadwalPendampingan\CreateRequest;
use App\Http\Requests\Kelola\JadwalPendampingan\UpdateRequest;

class KelolaJadwalPendampinganController extends Controller
{
    public function __construct(protected JadwalPendampinganService $jadwalPendampinganService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('kelola-jadwal-pendampingan.read');
        // Load data for data table (server side - AJAX)
        if (request()->ajax()) {
            return $this->jadwalPendampinganService->getAll();
        }
        // Get data
        $materis = $this->jadwalPendampinganService->getAllMateri();
        $kategoris = $this->jadwalPendampinganService->getAllKategoriPenyuluhan();
        $jenisPenyuluhans = $this->jadwalPendampinganService->getAllJenisPenyuluhan();
        $penyuluhs = $this->jadwalPendampinganService->getAllPenyuluh();

        // Return view
        return view('admin.kelolas.jadwal-pendampingan.index', compact('materis', 'kategoris', 'jenisPenyuluhans', 'penyuluhs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('kelola-jadwal-pendampingan.create');

        // Store Process
        return $this->jadwalPendampinganService->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->setRule('kelola-jadwal-pendampingan.update');
        return $this->jadwalPendampinganService->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $this->setRule('kelola-jadwal-pendampingan.update');

        // Update Process
        return $this->jadwalPendampinganService->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->setRule('kelola-jadwal-pendampingan.delete');
        // Delete Process
        return $this->jadwalPendampinganService->delete($id);
    }

    /** 
     * Download attachment by ID 
     */
    public function attachmentDownload(string $id)
    {
        $this->setRule('kelola-jadwal-pendampingan.read');
        return $this->jadwalPendampinganService->downloadAttachment($id);
    }
}
