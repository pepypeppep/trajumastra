<?php

namespace App\Http\Controllers\Admin\Kelola;

use App\Http\Controllers\Controller;
use App\Http\Services\Kelola\TpiService;
use App\Http\Requests\Kelola\Tpi\CreateRequest;
use App\Http\Requests\Kelola\Tpi\UpdateRequest;

class KelolaTpiController extends Controller
{
    public function __construct(protected TpiService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('kelola-tpi.read');

        // Get data jenis ikan for data table
        if (request()->ajax()) {
            return $this->service->getAll();
        }

        $kals = $this->service->getAllKalurahan();

        return view('admin.kelolas.tpi.index', compact('kals'));
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
        $this->setRule('kelola-tpi.create');

        // Store process
        return $this->service->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->setRule('kelola-tpi.update');

        return $this->service->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('kelola-tpi.update');
        // Update process
        return $this->service->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('kelola-tpi.delete');
        // Delete Process
        return $this->service->delete($id);
    }
}
