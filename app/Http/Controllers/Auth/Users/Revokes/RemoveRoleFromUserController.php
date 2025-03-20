<?php

namespace App\Http\Controllers\Auth\Users\Revokes;

use Exception;
use App\Models\User;
use App\Traits\HasResponse;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Dedoc\Scramble\Attributes\Group;

#[Group('User')]
class RemoveRoleFromUserController extends Controller
{
    use HasResponse;

     /**
     * Handle an incoming user role remove request.
     *
     * @return JsonResponse
     *
     * @throws \Exception
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
