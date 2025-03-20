<?php

namespace App\Http\Controllers\Auth\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Users\UpdateRequest;
use App\Http\Resources\Auth\Users\UserResource;
use App\Models\User;
use App\Traits\HasResponse;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

#[Group('User')]
class UpdateUserController extends Controller
{
    use HasResponse;

    /**
     * Update a user
     *
     * @response array{message: string, code: int, data: UserResource}
     */
    public function __invoke(UpdateRequest $request, $id)
    {
        try {
            // Validate the request
            $user = User::find($id);

            if (! $user) {
                return $this->errorResponse('User not found', 404, null);
            }

            $user->update([
                'station_id' => $request->station_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'card_id' => $request->card_id,
                'tank_count' => $request->tank_count,
                'cloud_user' => $request->cloud_user,
            ]);

            if ($request->has('roles') && $request->has('permissions')) {
                $user->syncRoles($request->input('roles.*.name'));

                $user->syncPermissions($request->input('permissions.*.name'));
            }

            return $this->successResponse('User updated successfully', 200, new UserResource($user));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
