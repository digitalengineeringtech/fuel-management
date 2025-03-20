<?php

namespace App\Http\Controllers\Auth\Roles\Revokes;

use App\Http\Controllers\Controller;
use App\Traits\HasResponse;
use Dedoc\Scramble\Attributes\Group;
use Exception;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

#[Group('Role')]
class RemovePermissionFromRoleController extends Controller
{
    use HasResponse;

    /**
     * Handle an incoming user role remove request.
     *
     * @return JsonResponse
     *
     * @throws \Exception
     */

    public function __invoke($roleId, $permissionId)
    {
        try {
            $role = Role::findOrFail($roleId);

            $permission = Permission::findOrFail($permissionId);

            $role->revokePermissionTo($permission);

            return $this->successResponse('Permission removed successfully from role', 200, null);

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
