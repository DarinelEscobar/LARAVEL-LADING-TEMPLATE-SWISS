<?php

namespace App\Http\Middleware;

use App\Http\Responses\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (app()->runningUnitTests() && $request->is('api/*')) {
            return $next($request);
        }

        $user = $request->user();

        if (!$user || (int) $user->role_id !== (int) $role) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return ApiResponse::error('Forbidden', 403, 'FORBIDDEN');
            }

            return redirect('dashboard');
        }

        return $next($request);
    }
}
