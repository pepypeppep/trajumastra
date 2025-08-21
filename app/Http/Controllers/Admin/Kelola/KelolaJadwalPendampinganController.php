<?php

namespace App\Http\Controllers\Admin\Kelola;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Kelola\JadwalPendampinganService;

class KelolaJadwalPendampinganController extends Controller
{
    public function __construct(protected JadwalPendampinganService $jadwalPendampinganService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('kelola-jadwal-pendampingan.read');
        return view('admin.kelolas.jadwal-pendampingan.index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
