<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Users\CreateRequest;
use App\Http\Resources\Auth\Users\UserResource;
use App\Models\User;
use App\Traits\HasResponse;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

#[Group('Auth')]
class RegisteredUserController extends Controller
{
    use HasResponse;

    /**
     * Register User
     *
     * @response array{message: string, code: int, data: array{token: string, token_type: string, user: UserResource}}
     */
    public function store(CreateRequest $request): JsonResponse
    {
        $request->validated();

        $user = User::create([
            'station_id' => null,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
            'phone' => $request->phone,
            'card_id' => $request->card_id,
            'tank_count' => $request->tank_count,
            'cloud_user' => false,
        ]);

        Redis::set('user', $user->name);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse('Success', '201', [
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => new UserResource($user),
        ]);
    }
}
