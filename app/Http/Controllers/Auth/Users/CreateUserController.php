<?php

namespace App\Http\Controllers\Auth\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Users\CreateRequest;
use App\Http\Resources\Auth\Users\UserResource;
use App\Models\User;
use App\Traits\HasResponse;
use Dedoc\Scramble\Attributes\Group;
use Exception;
use Illuminate\Support\Facades\Hash;

#[Group('User')]
class CreateUserController extends Controller
{
    use HasResponse;

    /**
     * Create a new user
     *
     * @response array{message: string, code: int, data: UserResource}
     */
    public function __invoke(CreateRequest $request)
    {
        try {
            // Create a new user

            $user = User::create([
                'station_id' => $request->station_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->string('password')),
                'phone' => $request->phone,
                'card_id' => $request->card_id,
                'tank_count' => $request->tank_count,
                'cloud_user' => $request->cloud_user,
            ]);

            if ($user) {
                $user->syncRoles($request->input('roles.*.name'));

                $user->syncPermissions($request->input('permissions.*.name'));

                return $this->successResponse('User created successfully', 201, new UserResource($user));
            } else {
                return $this->errorResponse('Failed to create user', 400, null);
            }
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
