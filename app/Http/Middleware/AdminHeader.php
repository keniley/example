<?php

namespace App\Http\Middleware;

use Closure;

class AdminHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->header('x-robots-tag', 'noindex,nofollow,nosnippet,noarchive');

        return $response;
    }
}
