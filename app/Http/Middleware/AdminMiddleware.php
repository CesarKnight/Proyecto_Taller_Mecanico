<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // if (auth()->check() && !auth()->user()->roles->contains('nombre', 'Cliente')) {
        if (auth()->check()) {
            return $next($request);
        }

        return redirect('/');
    }
}
