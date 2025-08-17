<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Services\Master\SpbuService;
use App\Http\Requests\Master\Spbu\CreateRequest;
use App\Http\Requests\Master\Spbu\UpdateRequest;

class SpbuController extends Controller
{
    public function __construct(protected SpbuService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('spbu.read');

        // Get data jenis ikan for data table
        if (request()->ajax()) {
            return $this->service->getAll();
        }

        return view('admin.masters.spbu.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('spbu.create');

        // Store process
        return $this->service->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->setRule('spbu.update');

        return $this->service->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('spbu.update');
        // Update process
        return $this->service->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('spbu.delete');
        // Delete Process
        return $this->service->delete($id);
    }
}
