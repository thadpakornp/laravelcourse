<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProtectAPIMiddle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $tokenValid = config('app.token_allow_api');
        if ($tokenValid === $request->header('Authorization')) {
            return $next($request);
        }
        return response()->json('Unauthorization', 401);
    }
}
