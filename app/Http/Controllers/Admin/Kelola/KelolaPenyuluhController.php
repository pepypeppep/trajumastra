<?php

namespace App\Http\Controllers\Admin\Kelola;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Kelola\PenyuluhService;
use App\Http\Requests\Kelola\Penyuluh\CreateRequest;
use App\Http\Requests\Kelola\Penyuluh\UpdateRequest;

class KelolaPenyuluhController extends Controller
{
    public function __construct(protected PenyuluhService $penyuluhService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('kelola-penyuluh.read');

        // Load data for data table (server side - AJAX)
        if (request()->ajax()) {
            return $this->penyuluhService->getAll();
        }
        // Get data
        $usersHasPenyuluhRole = $this->penyuluhService->getUsersHasPenyuluhRole();
        
        return view('admin.kelolas.penyuluh.index', compact('usersHasPenyuluhRole'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('kelola-penyuluh.create');

        // Store Process
        return $this->penyuluhService->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->setRule('kelola-penyuluh.update');
        return $this->penyuluhService->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $this->setRule('kelola-penyuluh.update');

        // Update Process
        return $this->penyuluhService->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->setRule('kelola-penyuluh.delete');
        // Delete Process
        return $this->penyuluhService->delete($id);
    }
}
