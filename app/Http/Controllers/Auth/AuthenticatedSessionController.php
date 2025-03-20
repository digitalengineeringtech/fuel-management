<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\Users\UserResource;
use App\Traits\HasResponse;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

#[Group('Auth')]
class AuthenticatedSessionController extends Controller
{
    use HasResponse;

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $token = $request->user()->createToken('auth_token')->plainTextToken;

        Redis::set('user', $request->user()->name);

        return $this->successResponse('Success', '200', [
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => new UserResource($request->user()),
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        Auth::guard('web')->logout();

        $request->user()->tokens()->delete();

        Redis::delete('user');

        return $this->successResponse('Success', '200', null);
    }
}
