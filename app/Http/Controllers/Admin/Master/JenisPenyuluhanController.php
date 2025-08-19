<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Master\JenisPenyuluhanService;
use App\Http\Requests\Master\JenisPenyuluhan\CreateRequest;
use App\Http\Requests\Master\JenisPenyuluhan\UpdateRequest;

class JenisPenyuluhanController extends Controller
{
    public function __construct(protected JenisPenyuluhanService $rangePenghasilanService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('jenis-penyuluhan.read');

        // Get data jenis penyuluhan for data table
        if (request()->ajax()) {
            return $this->rangePenghasilanService->getAll();
        }

        return view('admin.masters.jenis-penyuluhan.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('jenis-penyuluhan.create');

        // Store process
        return $this->rangePenghasilanService->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->setRule('jenis-penyuluhan.update');

        return $this->rangePenghasilanService->getById($id);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('jenis-penyuluhan.update');
        // Update process
        return $this->rangePenghasilanService->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('jenis-penyuluhan.delete');
        // Delete Process
        return $this->rangePenghasilanService->delete($id);
    }
}
