<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }
        return $next($request);
    }

}
