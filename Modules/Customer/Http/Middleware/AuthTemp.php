<?php

namespace Modules\Customer\Http\Middleware;

use Illuminate\Http\Response;

class AuthTemp
{
    public function handle($request, $next)
    {
        if ($request->header('Authorization')) {
            return $next($request);
        }
        return response('UNAUTHORIZED', Response::HTTP_UNAUTHORIZED);
    }
}