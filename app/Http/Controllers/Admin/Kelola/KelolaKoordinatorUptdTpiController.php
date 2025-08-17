<?php

namespace App\Http\Controllers\Admin\Kelola;

use App\Http\Controllers\Controller;
use App\Http\Services\Kelola\KoordinatorUptdTpiService;
use App\Http\Requests\Kelola\KoordinatorUptdTpi\CreateRequest;
use App\Http\Requests\Kelola\KoordinatorUptdTpi\UpdateRequest;

class KelolaKoordinatorUptdTpiController extends Controller
{
    public function __construct(protected KoordinatorUptdTpiService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('kelola-koordinator-uptd-tpi.read');

        // Get data jenis ikan for data table
        if (request()->ajax()) {
            return $this->service->getAll();
        }

        $uptds = $this->service->getAllUptd();

        return view('admin.kelolas.koordinator-uptd-tpi.index', compact('uptds'));
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
        $this->setRule('kelola-koordinator-uptd-tpi.create');

        // Store process
        return $this->service->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->setRule('kelola-koordinator-uptd-tpi.update');

        return $this->service->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->setRule('kelola-koordinator-uptd-tpi.update');
        // Update process
        return $this->service->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->setRule('kelola-koordinator-uptd-tpi.delete');
        // Delete Process
        return $this->service->delete($id);
    }
}
