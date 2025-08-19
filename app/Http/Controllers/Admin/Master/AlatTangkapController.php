<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Master\AlatTangkapService;
use App\Http\Requests\Master\AlatTangkap\CreateRequest;
use App\Http\Requests\Master\AlatTangkap\UpdateRequest;

class AlatTangkapController extends Controller
{
    public function __construct(protected AlatTangkapService $alatTangkapService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('alat-tangkap.read');

        // Get data jenis penyuluhan for data table
        if (request()->ajax()) {
            return $this->alatTangkapService->getAll();
        }

        return view('admin.masters.alat-tangkap.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('alat-tangkap.create');

        // Store process
        return $this->alatTangkapService->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->setRule('alat-tangkap.update');

        return $this->alatTangkapService->getById($id);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('alat-tangkap.update');
        // Update process
        return $this->alatTangkapService->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('alat-tangkap.delete');
        // Delete Process
        return $this->alatTangkapService->delete($id);
    }
}
