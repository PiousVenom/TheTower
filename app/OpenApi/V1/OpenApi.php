<?php

declare(strict_types=1);

namespace App\OpenApi\V1;

/**
 * @OA\OpenApi(
 *
 *     @OA\Info(
 *         version="1.0.0",
 *         title="The Tower API (v1)",
 *         description="Endpoints for various resources in The Tower."
 *     ),
 *
 *     @OA\Server(
 *         url="/api/v1",
 *         description="Base path for version 1"
 *     )
 * )
 */
class OpenApi
{
    // empty: the annotations above are all swagger-php needs
}
