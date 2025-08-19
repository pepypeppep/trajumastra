<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Master\AssetDigunakanService;
use App\Http\Requests\Master\AssetDigunakan\CreateRequest;
use App\Http\Requests\Master\AssetDigunakan\UpdateRequest;

class AssetDigunakanController extends Controller
{
    public function __construct(protected AssetDigunakanService $assetDigunakanService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('asset-digunakan.read');

        // Get data jenis ikan for data table
        if (request()->ajax()) {
            return $this->assetDigunakanService->getAll();
        }
        
        return view('admin.masters.asset-digunakan.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('asset-digunakan.create');

        // Store process
        return $this->assetDigunakanService->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->setRule('asset-digunakan.update');

        return $this->assetDigunakanService->getById($id);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('asset-digunakan.update');
        // Update process
        return $this->assetDigunakanService->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('asset-digunakan.delete');
        // Delete Process
        return $this->assetDigunakanService->delete($id);
    }
}
