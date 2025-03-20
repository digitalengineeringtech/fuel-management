<?php

namespace App\Http\Controllers\Auth\Users;

use App\Models\User;
use App\Traits\HasResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Auth\Users\UserResource;

#[Group('User')]
class UpdateUserController extends Controller
{
    use HasResponse;

    /**
     * Handle an incoming update request.
     *
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function __invoke(Request $request, $id)
    {
        try {
            // Validate the request
            $user = User::find($id);

            if (! $user) {
                return $this->errorResponse('User not found', 404, null);
            }

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
                'password' => ['required', 'min:8'],
                'phone' => ['nullable', 'string', 'max:20'],
                'card_id' => ['nullable', 'string', 'max:15'],
                'tank_count' => ['nullable', 'integer'],
                'cloud_user' => ['boolean'],
            ]);

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
