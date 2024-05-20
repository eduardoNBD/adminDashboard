<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return $request->expectsJson()
            ? response()->json(['message' => 'Iniciar Session.'], 401)
            : redirect('login');
        }

        $user = Auth::user(); 
    
        if (!in_array($user->role, $roles)) {
            return $request->expectsJson()
            ? response()->json(['message' => 'Sin autorización.'], 401)
            : redirect('dashboard');
        }

        return $next($request);
    }
}
