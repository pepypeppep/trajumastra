<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(protected DashboardService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->setRule('dashboard.read');

        if ($request->ajax()) {
            $transactionCount = $this->service->getTransactionCount($request);
            $transactions = $this->service->getTransactionAmount($request);
            return [
                'transactionCount' => $transactionCount,
                'transactions' => $transactions
            ];
        }

        $dataCount = $this->service->getDataCount($request);
        $popularFish = $this->service->getPopularFish($request);
        $uptds = $this->service->getUptd();

        return view('admin.dashboard.index', compact('dataCount', 'popularFish', 'uptds'));
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
