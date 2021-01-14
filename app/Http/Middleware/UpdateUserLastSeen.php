<?php

namespace App\Http\Middleware;

use Closure;

class UpdateUserLastSeen
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

        $request->user()->seen_at = \Carbon\Carbon::now();
        $request->user()->save();

        return $response;
    }
}
