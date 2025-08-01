<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next,string $role): Response
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        if ($role === 'gestionnaire' && auth()->user()->$role !== 'gestionnaire') {
            abort(403, 'Accès non autorisé');
        }

        if ($role === 'client' && !auth()->user()->$role !== 'client') {
            abort(403, 'Accès non autorisé');
        }

        return $next($request);
    }
}
