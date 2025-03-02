<?php

namespace App\Http\Controllers\Auth\Users\Revokes;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HasResponse;
use Exception;
use Spatie\Permission\Models\Role;

class RemoveRoleFromUserController extends Controller
{
    use HasResponse;

    public function __invoke($userId, $roleId)
    {
        try {
            $user = User::findOrFail($userId);

            $role = Role::findOrFail($roleId);

            $user->removeRole($role);

            return $this->successResponse('Role removed successfully from user', 200, null);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
