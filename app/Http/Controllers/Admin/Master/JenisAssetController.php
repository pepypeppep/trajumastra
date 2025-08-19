<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Master\JenisAssetService;
use App\Http\Requests\Master\JenisAsset\CreateRequest;
use App\Http\Requests\Master\JenisAsset\UpdateRequest;

class JenisAssetController extends Controller
{
    public function __construct(protected JenisAssetService $jenisAssetService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('jenis-asset.read');

        // Get data jenis penyuluhan for data table
        if (request()->ajax()) {
            return $this->jenisAssetService->getAll();
        }

        return view('admin.masters.jenis-asset.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('jenis-asset.create');

        // Store process
        return $this->jenisAssetService->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->setRule('jenis-asset.update');

        return $this->jenisAssetService->getById($id);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('jenis-asset.update');
        // Update process
        return $this->jenisAssetService->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('jenis-asset.delete');
        // Delete Process
        return $this->jenisAssetService->delete($id);
    }
}
