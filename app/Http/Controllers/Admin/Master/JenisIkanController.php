<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\JenisIkan\CreateRequest;
use App\Http\Requests\Master\JenisIkan\UpdateRequest;
use App\Http\Services\Master\JenisIkanService;

class JenisIkanController extends Controller
{
    public function __construct(protected JenisIkanService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('jenis-ikan.read');

        // Get data jenis ikan for data table
        if (request()->ajax()) {
            return $this->service->getAll();
        }

        return view('admin.masters.jenis-ikan.index');
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
        $this->setRule('jenis-ikan.create');

        // Store process
        return $this->service->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->setRule('jenis-ikan.update');

        return $this->service->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('jenis-ikan.update');
        // Update process
        return $this->service->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('jenis-ikan.delete');
        // Delete Process
        return $this->service->delete($id);
    }
}
