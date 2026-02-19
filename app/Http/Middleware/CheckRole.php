<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (! $request->user() || $request->user()->role !== $role) {
            // Allow admin to access everything? Maybe.
            // But let's be strict for now or allow admin to access 'dj' routes if needed.
            // For now, strict check as requested: "DJ ve solo sus eventos", "Cliente crea reservas".
            
            if ($request->user() && $request->user()->isAdmin()) {
                // Admin has super access
                return $next($request);
            }

            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
