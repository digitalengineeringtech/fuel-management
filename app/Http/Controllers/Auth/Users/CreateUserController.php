<?php

namespace App\Http\Controllers\Auth\Users;

use Exception;
use App\Models\User;
use App\Traits\HasResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Auth\Users\UserResource;
#[Group('User')]
class CreateUserController extends Controller
{
    use HasResponse;

     /**
     * Handle an incoming create request.
     *
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function __invoke(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'min:8'],
                'phone' => ['nullable', 'string', 'max:20'],
                'card_id' => ['nullable', 'string', 'max:15'],
                'tank_count' => ['nullable', 'integer'],
                'cloud_user' => ['boolean'],
            ]);

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
