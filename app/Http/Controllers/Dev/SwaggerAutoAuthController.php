<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SwaggerAutoAuthController extends Controller
{
    public function __invoke(): JsonResponse
    {
        abort_unless(
            App::environment(['local', 'development', 'testing']),
            403,
            'Auto auth is only available in non-production environments.'
        );

        $user = User::query()
            ->where('role_id', 1)
            ->where('status_id', 1)
            ->orderBy('id')
            ->firstOrFail();

        Auth::login($user);
        request()->session()->regenerate();

        $user->tokens()->where('name', 'swagger-ui')->delete();
        $token = $user->createToken('swagger-ui')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }
}
