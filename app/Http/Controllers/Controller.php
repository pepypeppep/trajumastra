<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *    title="Trajumastra API",
 *    description="API Documentation for Trajumastra Application",
 *    version="1.0.0",
 * )
 * @OA\SecurityScheme(
 *     securityScheme="bearer",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 * )
 *
 */
abstract class Controller
{
    use \App\Traits\DisplayTrait;
}
