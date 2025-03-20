<?php

namespace App\Http\Controllers\Auth\Users\Revokes;

use Exception;
use App\Models\User;
use App\Traits\HasResponse;
use App\Http\Controllers\Controller;
use Dedoc\Scramble\Attributes\Group;
use Spatie\Permission\Models\Permission;

#[Group('User')]
class RemovePermissionFromUserController extends Controller
{
    use HasResponse;

    /**
     * Handle an incoming user role remove request.
     *
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function __invoke($userId, $permissionId)
    {
        try {
            $user = User::findOrFail($userId);

            $permission = Permission::findOrFail($permissionId);

            $user->revokePermissionTo($permission);

            return $this->successResponse('Permission removed successfully from user', 200, null);

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
