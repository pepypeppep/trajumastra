<?php

namespace App\Http\Controllers\Admin\Kelola;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TemplateImportPelakuUsahaExport;
use App\Http\Services\Kelola\PelakuUsahaService;
use App\Http\Requests\Kelola\PelakuUsaha\CreateRequest;
use App\Http\Requests\Kelola\PelakuUsaha\UpdateRequest;

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
         /* Get Filter By Kelompok Binaan */
        if (request()->ajax()) {
            return $this->pelakuUsahaService->getAll(request()->all(), false);
        }

        /* Get all kalurahan */
        $kalurahans = $this->pelakuUsahaService->getAllKalurahan();
        /* Get all jenis usaha */
        $jenisUsahas = $this->pelakuUsahaService->getAllJenisUsaha();
        /* Get all bentuk usaha */
        $bentukUsahas = $this->pelakuUsahaService->getAllBentukUsaha();
        /* Get all kelompok usaha */
        $kelompokBinaans = $this->pelakuUsahaService->getAllKelompokBinaan();
        /* Get all range penghasilan */
        $rangePenghasilans = $this->pelakuUsahaService->getAllRangePenghasilan();
        /* Get user has pelaku usaha role */
        $usersHasPelakuUsahaRole = $this->pelakuUsahaService->getUsersHasPelakuUsahaRole();

        return view('admin.kelolas.pelaku-usaha.index', compact('kalurahans', 'jenisUsahas', 'bentukUsahas', 'kelompokBinaans', 'rangePenghasilans', 'usersHasPelakuUsahaRole'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('kelola-pelaku-usaha.create');

        // Store Process
        return $this->pelakuUsahaService->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->setRule('kelola-pelaku-usaha.update');
        return $this->pelakuUsahaService->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $this->setRule('kelola-pelaku-usaha.update');

        // Update Process
        return $this->pelakuUsahaService->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->setRule('kelola-pelaku-usaha.delete');
        // Delete Process
        return $this->pelakuUsahaService->delete($id);
    }

    /** Download template for import data Pelaku Usaha */
    public function downloadTemplateImport()
    {
        $this->setRule('kelola-pelaku-usaha.create');

        // Get reference data for validation lists
        /* Get all kalurahan */
        $kalurahans = $this->pelakuUsahaService->getAllKalurahan()->pluck('name')->all();
        /* Get all jenis usaha */
        $jenisUsahas = $this->pelakuUsahaService->getAllJenisUsaha()->pluck('name')->all();
        /* Get all bentuk usaha */
        $bentukUsahas = $this->pelakuUsahaService->getAllBentukUsaha()->pluck('name')->all();
        /* Get all kelompok usaha */
        $kelompokBinaans = $this->pelakuUsahaService->getAllKelompokBinaan()->pluck('name')->all();
        /* Get all range penghasilan */
        $rangePenghasilans = $this->pelakuUsahaService->getAllRangePenghasilan()->pluck('name')->all();

        return Excel::download(
            new TemplateImportPelakuUsahaExport($jenisUsahas, $bentukUsahas, $rangePenghasilans, $kelompokBinaans, $kalurahans),
            'template_import_pelaku_usaha_with_dropdown_data_validation.xlsx'
        );
    }

    /**
     * Export to excel the specified resource from storage.
     */
    public function export(Request $request)
    {
        $this->setRule('kelola-pelaku-usaha.read');

        // Get all data for export
        $data = $this->pelakuUsahaService->getAll($request->all(), true);

        // Call the service to handle the export
        return $this->pelakuUsahaService->export($data);
    }

    public function import(Request $request)
    {
        $this->setRule('kelola-pelaku-usaha.create');

        $dataValidated = $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:20480', // Maksimal 20MB
        ]);

        // Call the service to handle the import
        return $this->pelakuUsahaService->import($dataValidated);
    }
}