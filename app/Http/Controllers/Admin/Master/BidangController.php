<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Master\BidangService;
use App\Http\Requests\Master\Bidang\CreateRequest;
use App\Http\Requests\Master\Bidang\UpdateRequest;

class BidangController extends Controller
{
    public function __construct(protected BidangService $bidangService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('bidang.read');

        // Get data bidang for data table
        if (request()->ajax()) {
            return $this->bidangService->getAll();
        }

        return view('admin.masters.bidang.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('bidang.create');

        // Store process
        return $this->bidangService->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->setRule('bidang.update');

        return $this->bidangService->getById($id);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('bidang.update');
        // Update process
        return $this->bidangService->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('bidang.delete');
        // Delete Process
        return $this->bidangService->delete($id);
    }
}
