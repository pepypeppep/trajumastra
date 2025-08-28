<?php

namespace App\Http\Controllers\Admin\Kelola;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kelola\Pokdakan\CreateRequest;
use App\Http\Requests\Kelola\Pokdakan\UpdateRequest;
use App\Http\Services\Kelola\PoklasharService;

class KelolaPoklasharController extends Controller
{
    public function __construct(protected PoklasharService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('kelola-poklashar.read');

        // Get data jenis ikan for data table
        if (request()->ajax()) {
            return $this->service->getAll();
        }

        $kals = $this->service->getAllKalurahan();
        $jenis_ikans = $this->service->getAllJenisIkan();
        $jenis_usahas = $this->service->getAllJenisUsaha();
        $jenis_kolams = $this->service->getAllJenisKolam();

        return view('admin.kelolas.poklashar.index', compact('kals', 'jenis_ikans', 'jenis_usahas', 'jenis_kolams'));
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
        $this->setRule('kelola-poklashar.create');

        // Store process
        return $this->service->store($request->validated());
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->setRule('kelola-poklashar.update');

        return $this->service->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $this->setRule('kelola-poklashar.update');
        // Update process
        return $this->service->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->setRule('kelola-poklashar.delete');
        // Delete Process
        return $this->service->delete($id);
    }
}
