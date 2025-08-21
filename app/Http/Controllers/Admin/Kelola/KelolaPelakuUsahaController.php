<?php

namespace App\Http\Controllers\Admin\Kelola;

use App\Http\Controllers\Controller;
use App\Http\Services\Kelola\PelakuUsahaService;
use Illuminate\Http\Request;

class KelolaPelakuUsahaController extends Controller
{
    public function __construct(protected PelakuUsahaService $pelakuUsahaService)
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('kelola-pelaku-usaha.read');

        // Load data for data table (server side - AJAX)
        if (request()->ajax()) {
            return $this->pelakuUsahaService->getAll();
        }

        return view('admin.kelolas.pelaku-usaha.index');
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
