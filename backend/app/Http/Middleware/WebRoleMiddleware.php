<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class WebRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        \Log::info('WebRoleMiddleware: comprobando acceso', [
            'user_id' => Auth::id(),
            'user_email' => Auth::check() ? Auth::user()->email : null,
            'required_role' => $role,
            'user_roles' => Auth::check() ? Auth::user()->roles->pluck('name') : null,
            'has_role' => Auth::check() ? $request->user()->hasRole($role) : false,
        ]);
        if (!Auth::check() || !$request->user()->hasRole($role)) {
            \Log::warning('WebRoleMiddleware: acceso denegado', [
                'user_id' => Auth::id(),
                'required_role' => $role,
                'user_roles' => Auth::check() ? Auth::user()->roles->pluck('name') : null,
            ]);
            return redirect('login')->with('error', 'You do not have permission to access this page.');
        }

        \Log::info('WebRoleMiddleware: acceso concedido', [
            'user_id' => Auth::id(),
            'required_role' => $role,
        ]);
        return $next($request);
    }
}
