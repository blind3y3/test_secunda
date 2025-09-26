<?php

declare(strict_types=1);

namespace Modules\Api\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiKeyExists
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasHeader('X-API-KEY') && $request->header('X-API-KEY') === Env::get('X_API_KEY')) {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
