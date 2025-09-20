<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Services\Api\TransaksiService;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Transaksi\CreateRequest;
use App\Http\Services\Api\StokIkanService;

class StokIkanController extends BaseApiController
{
    public function __construct(protected StokIkanService $service) {}

    /**
     * @OA\Get(
     *     path="/api/fish-stock",
     *     summary="Get all stock ikan data",
     *     description="Retrieve all fish stock data for the authenticated user's UPTD.",
     *     tags={"Fish Stock"},
     *     security={{"bearer":{}}},
     *
     *     @OA\Parameter(
     *         name="keyword",
     *         in="query",
     *         description="Search keyword for fish type name",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Stok Ikan fetched successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=5),
     *                     @OA\Property(property="uptd_id", type="integer", example=1),
     *                     @OA\Property(property="jenis_ikan_id", type="integer", example=41),
     *                     @OA\Property(property="user_id", type="integer", example=1),
     *                     @OA\Property(property="stock", type="integer", example=97),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-20T06:24:35.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-20T06:24:35.000000Z"),
     *                     @OA\Property(
     *                         property="jenis_ikan",
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=41),
     *                         @OA\Property(property="name", type="string", example="Kakap"),
     *                         @OA\Property(property="image", type="string", example="ikan/92b13c1e-278f-4fb6-870d-77dfe8cf5eb4.png"),
     *                         @OA\Property(property="type", type="integer", example=1),
     *                         @OA\Property(property="economic_value", type="integer", example=3),
     *                         @OA\Property(property="deleted_at", type="string", format="date-time", nullable=true),
     *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-20T06:24:35.000000Z"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-20T06:24:35.000000Z"),
     *                         @OA\Property(property="imageUrl", type="string", example="http://127.0.0.1:8000/api/products/41/thumbnail"),
     *                         @OA\Property(property="economicLabel", type="string", example="<span class='px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-red-100 border-red-200 text-red-500 dark:bg-red-500/20 dark:border-red-500/20'>Tinggi</span>")
     *                     )
     *                 )
     *             )
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
     *         response=403,
     *         description="Forbidden - User doesn't have access (not UPTD type 2)",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Access denied")
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $products = $this->service->getAll($request);

        return $this->successResponse($products, "Stok Ikan fetched successfully");
    }

    public function store(CreateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    /**
     * @OA\Get(
     *     path="/api/fish-stock/{id}",
     *     summary="Get stock ikan by ID",
     *     description="Retrieve specific fish stock data by ID for the authenticated user's UPTD",
     *     tags={"Fish Stock"},
     *     security={{"bearer":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the stock ikan to retrieve",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Stok Ikan fetched successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=5),
     *                 @OA\Property(property="uptd_id", type="integer", example=1),
     *                 @OA\Property(property="jenis_ikan_id", type="integer", example=41),
     *                 @OA\Property(property="user_id", type="integer", example=1),
     *                 @OA\Property(property="stock", type="integer", example=97),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-20T06:24:35.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-20T06:24:35.000000Z"),
     *                 @OA\Property(
     *                     property="jenis_ikan",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=41),
     *                     @OA\Property(property="name", type="string", example="Kakap"),
     *                     @OA\Property(property="image", type="string", example="ikan/92b13c1e-278f-4fb6-870d-77dfe8cf5eb4.png"),
     *                     @OA\Property(property="type", type="integer", example=1),
     *                     @OA\Property(property="economic_value", type="integer", example=3),
     *                     @OA\Property(property="deleted_at", type="string", format="date-time", nullable=true),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-20T06:24:35.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-20T06:24:35.000000Z"),
     *                     @OA\Property(property="imageUrl", type="string", example="http://127.0.0.1:8000/api/products/41/thumbnail"),
     *                     @OA\Property(property="economicLabel", type="string", example="<span class='px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-red-100 border-red-200 text-red-500 dark:bg-red-500/20 dark:border-red-500/20'>Tinggi</span>")
     *                 )
     *             )
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
     *         response=404,
     *         description="Not Found - Stock ikan not found or doesn't belong to user's UPTD",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Stok Ikan not found")
     *         )
     *     )
     * )
     */
    public function show(Request $request, string $id)
    {
        $data = $this->service->getById($request, $id);

        return $this->successResponse($data, "Stok Ikan fetched successfully");
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * @OA\Put(
     *     path="/api/fish-stock/{id}",
     *     summary="Update stock ikan",
     *     description="Update fish stock quantity for a specific stock item belonging to the authenticated user's UPTD",
     *     tags={"Fish Stock"},
     *     security={{"bearer":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the stock ikan to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"stock"},
     *             @OA\Property(property="stock", type="integer", example=100, description="New stock quantity")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Stok Ikan updated successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=5),
     *                 @OA\Property(property="uptd_id", type="integer", example=1),
     *                 @OA\Property(property="jenis_ikan_id", type="integer", example=41),
     *                 @OA\Property(property="user_id", type="integer", example=1),
     *                 @OA\Property(property="stock", type="integer", example=100),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-20T06:24:35.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-20T08:30:15.000000Z"),
     *                 @OA\Property(
     *                     property="jenis_ikan",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=41),
     *                     @OA\Property(property="name", type="string", example="Kakap"),
     *                     @OA\Property(property="image", type="string", example="ikan/92b13c1e-278f-4fb6-870d-77dfe8cf5eb4.png"),
     *                     @OA\Property(property="type", type="integer", example=1),
     *                     @OA\Property(property="economic_value", type="integer", example=3),
     *                     @OA\Property(property="deleted_at", type="string", format="date-time", nullable=true),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-20T06:24:35.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-20T06:24:35.000000Z"),
     *                     @OA\Property(property="imageUrl", type="string", example="http://127.0.0.1:8000/api/products/41/thumbnail"),
     *                     @OA\Property(property="economicLabel", type="string", example="<span class='px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-red-100 border-red-200 text-red-500 dark:bg-red-500/20 dark:border-red-500/20'>Tinggi</span>")
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request - Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Validation failed"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="stock",
     *                     type="array",
     *                     @OA\Items(type="string", example="The stock field is required.")
     *                 )
     *             )
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
     *         response=404,
     *         description="Not Found - Stock ikan not found or doesn't belong to user's UPTD",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Stok Ikan not found")
     *         )
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        $data = $this->service->update($request, $id, $request->validated());

        return $this->successResponse($data, "Stok Ikan updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
