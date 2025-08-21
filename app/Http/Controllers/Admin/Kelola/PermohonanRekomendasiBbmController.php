<?php

namespace App\Http\Controllers\Admin\Kelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermohonanRekomendasiBbmController extends Controller
{
    public function __construct(protected PermohonanRekomendasiBbm $permohonanRekomendasiBbm)
    {
        
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('permohonan-rekomendasi-bbm.read');
        return view('admin.kelolas.permohonan-rekomendasi-bbm.index');
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
