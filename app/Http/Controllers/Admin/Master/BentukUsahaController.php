<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Master\BentukUsahaService;
use App\Http\Requests\Master\BentukUsaha\CreateRequest;
use App\Http\Requests\Master\BentukUsaha\UpdateRequest;

class BentukUsahaController extends Controller
{
    public function __construct(protected BentukUsahaService $bentukUsahaService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('bentuk-usaha.read');

        // Get data jenis penyuluhan for data table
        if (request()->ajax()) {
            return $this->bentukUsahaService->getAll();
        }

        return view('admin.masters.bentuk-usaha.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('bentuk-usaha.create');

        // Store process
        return $this->bentukUsahaService->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->setRule('bentuk-usaha.update');

        return $this->bentukUsahaService->getById($id);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('bentuk-usaha.update');
        // Update process
        return $this->bentukUsahaService->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('bentuk-usaha.delete');
        // Delete Process
        return $this->bentukUsahaService->delete($id);
    }
}
