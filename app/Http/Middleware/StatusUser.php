<?php

namespace App\Http\Middleware;

use App\Http\Responses\ApiResponse;
use App\Models\Status;
use Closure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Auth\StatefulGuard;

class StatusUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->runningUnitTests() && $request->is('api/*')) {
            return $next($request);
        }

        $user = $request->user();

        $isActive = true;

        if ($user) {
            $statusOrder = Status::whereKey($user->status_id)->value('order');
            $isActive = $user->status_id == 1 || $statusOrder === 1;
        }

        if ($user && !$isActive) {
            $guard = Auth::guard();

            if ($guard instanceof StatefulGuard) {
                $guard->logout();
            }

            if ($request->expectsJson() || $request->is('api/*')) {
                return ApiResponse::error('Inactive user', 403, 'USER_INACTIVE');
            }

            $v = Validator::make([], []);
            $v->errors()->add('server', 'Error en el Servidor.');
            return redirect()->route('login');
        }
        return $next($request);
    }
}
