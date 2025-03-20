<?php

namespace App\Http\Controllers\Auth\Users\Revokes;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HasResponse;
use Dedoc\Scramble\Attributes\Group;
use Exception;
use Spatie\Permission\Models\Role;

#[Group('User')]
class RemoveRoleFromUserController extends Controller
{
    use HasResponse;

    /**
     * Remove role from user
     *
     * @response array{message: string, code: int, data: null}
     */
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
