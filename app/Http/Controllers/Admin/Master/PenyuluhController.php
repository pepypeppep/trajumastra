<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Master\PenyuluhService;
use App\Http\Requests\Master\Penyuluh\CreateRequest;
use App\Http\Requests\Master\Penyuluh\UpdateRequest;

class PenyuluhController extends Controller
{
    public function __construct(protected PenyuluhService $penyuluhService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('master-penyuluh.read');

        // Load data for data table (server side - AJAX)
        if (request()->ajax()) {
            return $this->penyuluhService->getAll();
        }
        // Get data
        $usersHasPenyuluhRole = $this->penyuluhService->getUsersHasPenyuluhRole();
        
        return view('admin.masters.penyuluh.index', compact('usersHasPenyuluhRole'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('master-penyuluh.create');

        // Store Process
        return $this->penyuluhService->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->setRule('master-penyuluh.update');
        return $this->penyuluhService->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $this->setRule('master-penyuluh.update');

        // Update Process
        return $this->penyuluhService->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->setRule('master-penyuluh.delete');
        // Delete Process
        return $this->penyuluhService->delete($id);
    }
}
