<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! $request->user()->hasAnyRole(explode("|", $role))) {
            // abort(401, 'This action is unauthorized.');
            return redirect('/');
        }
        return $next($request);
    }
}
