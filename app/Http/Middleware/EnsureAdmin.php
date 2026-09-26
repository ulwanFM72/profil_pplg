<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next)
    {
        abort_unless(in_array($request->user()?->role, ['admin', 'editor'], true), 403);

        return $next($request);
    }
}
