<?php

namespace App\Http\Controllers\Auth\Users;

use App\Models\User;
use App\Traits\HasResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UpdateUserController extends Controller
{
    use HasResponse;
    /**
     * Handle an incoming update request.
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function __invoke(Request $request, $id)
    {
        try {
            // Validate the request
            $user = User::find($id);

            if (!$user) {
                return $this->errorResponse('User not found', 404, null);
            }

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
                'password' => ['required', 'min:8'],
                'phone' => ['nullable', 'string', 'max:20'],
                'card_id' => ['nullable', 'string', 'max:15'],
                'tank_count' => ['nullable', 'integer'],
                'role' => ['nullable', 'string', 'max:255'],
            ]);

            $user->update([
                'station_id' => $request->station_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'card_id' => $request->card_id,
                'tank_count' => $request->tank_count,
                'role' => $request->role,
            ]);
            return $this->successResponse('User updated successfully', 200, $user);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
