<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Master\RangePenghasilanService;
use App\Http\Requests\Master\AssetDigunakan\CreateRequest;
use App\Http\Requests\Master\AssetDigunakan\UpdateRequest;

class RangePenghasilanController extends Controller
{

    public function __construct(protected RangePenghasilanService $rangePenghasilanService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('range-penghasilan.read');

        // Get data jenis ikan for data table
        if (request()->ajax()) {
            return $this->rangePenghasilanService->getAll();
        }

        return view('admin.masters.range-penghasilan.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('range-penghasilan.create');

        // Store process
        return $this->rangePenghasilanService->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->setRule('range-penghasilan.update');

        return $this->rangePenghasilanService->getById($id);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('range-penghasilan.update');
        // Update process
        return $this->rangePenghasilanService->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('range-penghasilan.delete');
        // Delete Process
        return $this->rangePenghasilanService->delete($id);
    }
}
