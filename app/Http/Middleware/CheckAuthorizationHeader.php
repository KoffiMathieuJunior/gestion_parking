<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthorizationHeader
{
    public function handle($request, Closure $next)
    {
        if (!$request->hasHeader('Authorization')) {
            return response()->json(['message' => 'Authorization header is missing'], 401);
        }

        return $next($request);
    }
}
