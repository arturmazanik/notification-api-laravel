<?php

namespace App\Http\Controllers\API;

/**
 * @OA\Info(
 *     title="Laravel Swagger API documentation",
 *     version="1.0.0",
 *     @OA\Contact(
 *         email="admin@example.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\Tag(
 *     name="Examples",
 *     description="Some example pages",
 * )
 * @OA\Server(
 *     description="Laravel Swagger API server",
 *     url="http://localhost/api"
 * )
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     name="X-APP-ID",
 *     securityScheme="X-APP-ID"
 * )
 */

trait Swagger
{
}
