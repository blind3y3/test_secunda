<?php

declare(strict_types=1);

namespace Modules\Api\Doc;

use OpenApi\Attributes as OA;

#[OA\OpenApi(
    security: [
        ["apiKey" => []]
    ]
)]
#[OA\Info(
    version: '1.0',
    description: 'API для тестового задания',
    title: 'API',
)]
#[OA\Server(
    url: 'http://localhost:8080',
    description: 'API server',
)]
#[OA\SecurityScheme(
    securityScheme: "apiKey",
    type: "apiKey",
    name: "X-API-KEY",
    in: "header"
)]
class OpenApiSpec {}