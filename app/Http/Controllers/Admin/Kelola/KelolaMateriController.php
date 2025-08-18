<?php

namespace App\Http\Controllers\Admin\Kelola;

use App\Http\Controllers\Controller;
use App\Http\Services\Kelola\MateriService;
use App\Http\Requests\Kelola\Materi\CreateRequest;
use App\Http\Requests\Kelola\Materi\UpdateRequest;

class KelolaMateriController extends Controller
{
    public function __construct(protected MateriService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('kelola-materi.read');

        // Get data jenis ikan for data table
        if (request()->ajax()) {
            return $this->service->getAll();
        }

        return view('admin.kelolas.materi.index');
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
        $this->setRule('kelola-materi.read');

        return $this->service->getAttachmentById($id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('kelola-materi.create');

        // Store process
        return $this->service->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->setRule('kelola-materi.update');

        return $this->service->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('kelola-materi.update');
        // Update process
        return $this->service->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('kelola-materi.delete');
        // Delete Process
        return $this->service->delete($id);
    }
}
