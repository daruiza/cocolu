<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Cocolu Documentation",
 *      description="APP Portfolio Management",
 *      
 *      @OA\Contact(
 *          email="daruiza@gmail.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Cocolu API Server"
 * )
 *
 * @OA\Tag(
 *     name="Auth",
 *     description="API EndPoints of Auth"
 * ) 
 * 
 * @OA\Tag(
 *     name="Table",
 *     description="API EndPoints of Table"
 * )
 * 
 * @OA\SecuritySchemes(
 *     securityDefinition="bearer",
 *     type="apiKey",
 *     in="header",
 *     name="Authorization"
 * )
 * 
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
