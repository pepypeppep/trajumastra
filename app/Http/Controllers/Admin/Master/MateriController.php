<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Services\Master\MateriService;
use App\Http\Requests\Master\Materi\CreateRequest;
use App\Http\Requests\Master\Materi\UpdateRequest;

class MateriController extends Controller
{
    public function __construct(protected MateriService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('master-materi.read');

        // Get data jenis ikan for data table
        if (request()->ajax()) {
            return $this->service->getAll();
        }

        return view('admin.masters.materi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function attachment($id)
    {
        $this->setRule('master-materi.read');

        return $this->service->getAttachmentById($id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('master-materi.create');

        // Store process
        return $this->service->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->setRule('master-materi.update');

        return $this->service->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('master-materi.update');
        // Update process
        return $this->service->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('master-materi.delete');
        // Delete Process
        return $this->service->delete($id);
    }
}
