<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Services\Api\TransaksiService;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Transaksi\CreateRequest;

class TransaksiController extends BaseApiController
{
    public function __construct(protected TransaksiService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $transactions = $this->service->getAll($request);

        return $this->successResponse($transactions, "Transactions fetched successfully");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        return $this->service->store($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = $this->service->getById($id);

        if (!$transaction) {
            return $this->errorResponse("Transaction not found", 404);
        }

        return $this->successResponse($transaction, "Transaction fetched successfully");
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
