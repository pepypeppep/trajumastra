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
     *     path="/api/transactions",
     *     summary="Get all transactions",
     *     description="Retrieve paginated transactions list filtered by user's UPTD with optional search",
     *     operationId="getAllTransactions",
     *     tags={"Transactions"},
     *     security={{"bearer":{}}},
     *
     *     @OA\Parameter(
     *         name="keyword",
     *         in="query",
     *         description="Search keyword for transaction name or invoice ID",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number for pagination",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=1
     *         )
     *     ),
     *
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=10
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="current_page",
     *                 type="integer",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="invoice_id",
     *                         type="string",
     *                         example="INV-2023-001"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Transaction Name"
     *                     ),
     *                     @OA\Property(
     *                         property="uptd_id",
     *                         type="integer",
     *                         example=5
     *                     ),
     *                     @OA\Property(
     *                         property="amount",
     *                         type="number",
     *                         format="float",
     *                         example=250000.50
     *                     ),
     *                     @OA\Property(
     *                         property="status",
     *                         type="string",
     *                         example="completed"
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
     *                     ),
     *                     @OA\Property(
     *                         property="uptd",
     *                         type="object",
     *                         @OA\Property(
     *                             property="id",
     *                             type="integer",
     *                             example=5
     *                         ),
     *                         @OA\Property(
     *                             property="name",
     *                             type="string",
     *                             example="UPTD Name"
     *                         ),
     *                         @OA\Property(
     *                             property="type",
     *                             type="integer",
     *                             example=1
     *                         )
     *                     )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="first_page_url",
     *                 type="string",
     *                 example="http://localhost/api/transactions?page=1"
     *             ),
     *             @OA\Property(
     *                 property="from",
     *                 type="integer",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="last_page",
     *                 type="integer",
     *                 example=5
     *             ),
     *             @OA\Property(
     *                 property="last_page_url",
     *                 type="string",
     *                 example="http://localhost/api/transactions?page=5"
     *             ),
     *             @OA\Property(
     *                 property="links",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="url",
     *                         type="string",
     *                         nullable=true
     *                     ),
     *                     @OA\Property(
     *                         property="label",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="active",
     *                         type="boolean"
     *                     )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="next_page_url",
     *                 type="string",
     *                 nullable=true
     *             ),
     *             @OA\Property(
     *                 property="path",
     *                 type="string",
     *                 example="http://localhost/api/transactions"
     *             ),
     *             @OA\Property(
     *                 property="per_page",
     *                 type="integer",
     *                 example=10
     *             ),
     *             @OA\Property(
     *                 property="prev_page_url",
     *                 type="string",
     *                 nullable=true
     *             ),
     *             @OA\Property(
     *                 property="to",
     *                 type="integer",
     *                 example=10
     *             ),
     *             @OA\Property(
     *                 property="total",
     *                 type="integer",
     *                 example=50
     *             )
     *         )
     *     ),
     *
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
     *
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
        $products = $this->service->getAll($request);

        return $this->successResponse($products, "Products fetched successfully");
    }

    // /**
    //  * Display a listing of the resource.
    //  */
    // /**
    //  * @OA\Get(
    //  *     path="/api/products",
    //  *     summary="Get products",
    //  *     description="Retrieve products filtered by the user's UPTD and type with optional filtering",
    //  *     operationId="getProductByUser",
    //  *     tags={"Products"},
    //  *     security={{"bearer":{}}},
    //  *     @OA\Parameter(
    //  *         name="keyword",
    //  *         in="query",
    //  *         description="Search keyword for product name",
    //  *         required=false,
    //  *         @OA\Schema(
    //  *             type="string"
    //  *         )
    //  *     ),
    //  *     @OA\Response(
    //  *         response=200,
    //  *         description="Successful operation",
    //  *         @OA\JsonContent(
    //  *             type="array",
    //  *             @OA\Items(
    //  *                 type="object",
    //  *                 @OA\Property(
    //  *                     property="id",
    //  *                     type="integer",
    //  *                     example=1
    //  *                 ),
    //  *                 @OA\Property(
    //  *                     property="uptd_id",
    //  *                     type="integer",
    //  *                     example=5
    //  *                 ),
    //  *                 @OA\Property(
    //  *                     property="transaction_type",
    //  *                     type="string",
    //  *                     example="jual"
    //  *                 ),
    //  *                 @OA\Property(
    //  *                     property="price",
    //  *                     type="number",
    //  *                     format="float",
    //  *                     example=25000.50
    //  *                 ),
    //  *                 @OA\Property(
    //  *                     property="created_at",
    //  *                     type="string",
    //  *                     format="date-time"
    //  *                 ),
    //  *                 @OA\Property(
    //  *                     property="updated_at",
    //  *                     type="string",
    //  *                     format="date-time"
    //  *                 ),
    //  *                 @OA\Property(
    //  *                     property="jenis_ikan",
    //  *                     type="object",
    //  *                     @OA\Property(
    //  *                         property="id",
    //  *                         type="integer",
    //  *                         example=3
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="name",
    //  *                         type="string",
    //  *                         example="Ikan Bandeng"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="type",
    //  *                         type="string",
    //  *                         example="laut"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="created_at",
    //  *                         type="string",
    //  *                         format="date-time"
    //  *                     ),
    //  *                     @OA\Property(
    //  *                         property="updated_at",
    //  *                         type="string",
    //  *                         format="date-time"
    //  *                     )
    //  *                 )
    //  *             )
    //  *         )
    //  *     ),
    //  *     @OA\Response(
    //  *         response=401,
    //  *         description="Unauthorized",
    //  *         @OA\JsonContent(
    //  *             @OA\Property(
    //  *                 property="message",
    //  *                 type="string",
    //  *                 example="Unauthenticated."
    //  *             )
    //  *         )
    //  *     ),
    //  *     @OA\Response(
    //  *         response=500,
    //  *         description="Internal Server Error",
    //  *         @OA\JsonContent(
    //  *             @OA\Property(
    //  *                 property="message",
    //  *                 type="string",
    //  *                 example="Server error occurred"
    //  *             )
    //  *         )
    //  *     )
    //  * )
    //  */
    // public function indexProduct(Request $request)
    // {
    //     $products = $this->service->getProductByUser($request);

    //     return $this->successResponse($products, "Products fetched successfully");
    // }


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
     *     @OA\Parameter(
     *         name="userId",
     *         in="query",
     *         description="Filter by user ID",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=2
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
    public function indexProduct(Request $request)
    {
        $products = $this->service->getProductByUser($request);

        return $this->successResponse($products, "Products fetched successfully");
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * @OA\Post(
     *     path="/api/transactions",
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
        try {
            $product = $this->service->store($request->user(), $request->validated());
            return $this->successResponse($product, "Transaksi berhasil disimpan", 201);
        } catch (\Exception $e) {
            return $this->errorResponse(
                config('app.debug') ? $e->getMessage() : 'Terjadi kesalahan saat menyimpan transaksi',
                500
            );
        }
    }

    public function getImage(string $id)
    {
        return $this->service->getImageById($id);
    }

    /**
     * Display the specified resource.
     */
    /**
     * @OA\Get(
     *     path="/api/transactions/{id}",
     *     summary="Get transaction by ID",
     *     description="Retrieve a specific transaction with its details and UPTD information",
     *     operationId="transaction.getById",
     *     tags={"Transactions"},
     *     security={{"bearer":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Transaction ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Transaction retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Transaction retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=1),
     *                 @OA\Property(property="uptd_id", type="integer", example=1),
     *                 @OA\Property(property="transaction_type", type="string", example="cash"),
     *                 @OA\Property(property="name", type="string", example="Customer Name"),
     *                 @OA\Property(property="total", type="number", format="float", example=150000.00),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time"),
     *                 @OA\Property(
     *                     property="uptd",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="UPTD Name"),
     *                     @OA\Property(property="code", type="string", example="UPTD001")
     *                 ),
     *                 @OA\Property(
     *                     property="details",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="master_jenis_ikans_id", type="integer", example=1),
     *                         @OA\Property(property="name", type="string", example="Ikan Mas"),
     *                         @OA\Property(property="unit", type="string", example="kg"),
     *                         @OA\Property(property="size", type="string", example="Large"),
     *                         @OA\Property(property="price", type="number", format="float", example=25000.00),
     *                         @OA\Property(property="weight", type="number", format="float", example=1.5),
     *                         @OA\Property(property="quantity", type="integer", example=5),
     *                         @OA\Property(property="total", type="number", format="float", example=125000.00)
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Transaction not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Transaction not found"),
     *             @OA\Property(property="data", type="object", example=null)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Internal server error"),
     *             @OA\Property(property="data", type="object", example=null)
     *         )
     *     )
     * )
     */
    public function show(string $id)
    {
        $data = $this->service->getById($id);

        return $this->successResponse($data, "Transaction retrieved successfully");
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
