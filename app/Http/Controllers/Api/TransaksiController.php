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
    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Get products",
     *     description="Retrieve products filtered by the user's UPTD and type with optional filtering",
     *     operationId="getProductByUser",
     *     tags={"Products"},
     *     security={{"bearer":{}}},
     *     @OA\Parameter(
     *         name="keyword",
     *         in="query",
     *         description="Search keyword for product name",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                     example=1
     *                 ),
     *                 @OA\Property(
     *                     property="uptd_id",
     *                     type="integer",
     *                     example=5
     *                 ),
     *                 @OA\Property(
     *                     property="transaction_type",
     *                     type="string",
     *                     example="jual"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     type="number",
     *                     format="float",
     *                     example=25000.50
     *                 ),
     *                 @OA\Property(
     *                     property="created_at",
     *                     type="string",
     *                     format="date-time"
     *                 ),
     *                 @OA\Property(
     *                     property="updated_at",
     *                     type="string",
     *                     format="date-time"
     *                 ),
     *                 @OA\Property(
     *                     property="jenis_ikan",
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         example=3
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Ikan Bandeng"
     *                     ),
     *                     @OA\Property(
     *                         property="type",
     *                         type="string",
     *                         example="laut"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         format="date-time"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         format="date-time"
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Unauthenticated."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Server error occurred"
     *             )
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $products = $this->service->getProductByUser($request);

        return $this->successResponse($products, "Products fetched successfully");
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * @OA\Post(
     *     path="/api/transaksi",
     *     summary="Create a new transaction",
     *     description="Process and save a new fish transaction with multiple items",
     *     operationId="transaction.store",
     *     tags={"Transactions"},
     *     security={{"bearer":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         description="Transaction data with multiple items",
     *         @OA\JsonContent(
     *             required={"master_jenis_ikan_id", "transactions"},
     *             @OA\Property(property="transaction_type", type="string", example="cash"),
     *             @OA\Property(
     *                 property="transactions",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="master_jenis_ikan_id", type="integer", example=1),
     *                     @OA\Property(property="quantity", type="integer", example=5)
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Transaction created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Transaksi berhasil disimpan"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="transactions",
     *                     type="array",
     *                     @OA\Items(type="object")
     *                 ),
     *                 @OA\Property(property="total_items", type="integer", example=2)
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Transaksi tidak dapat dilakukan karena stok ikan tidak tersedia"),
     *             @OA\Property(property="error", type="string", example="Internal server error")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */
    public function store(CreateRequest $request)
    {
        return $this->service->store($request->user(), $request->validated());
    }

    public function getImage(string $id)
    {
        return $this->service->getImageById($id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
