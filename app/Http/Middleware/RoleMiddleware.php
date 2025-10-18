<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $rolesArray = explode('|', $roles); // e.g. "admin|super-admin"
        if (!$user->role || !in_array($user->role->name, $rolesArray)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
