<?php

namespace App\Http\Controllers\Admin\Kelola;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kelola\Pokmaswas\CreateRequest;
use App\Http\Requests\Kelola\Pokmaswas\UpdateRequest;
use App\Http\Services\Kelola\PokmaswasService;

class KelolaPokmaswasController extends Controller
{
    public function __construct(protected PokmaswasService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('kelola-pokmaswas.read');

        // Get data jenis ikan for data table
        if (request()->ajax()) {
            return $this->service->getAll();
        }

        $kecamatans = $this->service->getAllKecamatan();
        $bidangs = $this->service->getAllBidang();

        return view('admin.kelolas.pokmaswas.index', compact('kecamatans', 'bidangs'));
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
        $this->setRule('kelola-pokmaswas.create');

        // Store process
        return $this->service->store($request->validated());
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->setRule('kelola-pokmaswas.update');

        return $this->service->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $this->setRule('kelola-pokmaswas.update');
        // Update process
        return $this->service->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->setRule('kelola-pokmaswas.delete');
        // Delete Process
        return $this->service->delete($id);
    }
}
