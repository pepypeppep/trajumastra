<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Services\LandingService;
use App\Http\Requests\Guest\CreateRequest;

class BerandaController extends Controller
{
    public function __construct(protected LandingService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $news = $this->service->getNews();
        $bbis = $this->service->getBbi();
        $tpis = $this->service->getTpi();
        $transaksis = $this->service->getTransaction();

        if ($request->ajax()) {
            $pelakuUsahaChart = $this->service->getPelakuUsahaChart();
            return $pelakuUsahaChart;
        }

        return view('guest.index', compact('news', 'bbis', 'tpis', 'transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisUsahas = $this->service->getJenisUsaha();
        $bentukUsahas = $this->service->getBentukUsaha();
        $kelompokBinaans = $this->service->getKelompokBinaan();
        $penghasilans = $this->service->getPenghasilan();
        $kalurahans = $this->service->getKalurahan();

        return view('guest.create', compact('jenisUsahas', 'bentukUsahas', 'kelompokBinaans', 'penghasilans', 'kalurahans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        // Store process
        return $this->service->store($request->validated());
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
