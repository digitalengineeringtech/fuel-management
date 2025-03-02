<?php

namespace App\Http\Controllers\Auth\Users\Revokes;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HasResponse;
use Exception;
use Spatie\Permission\Models\Permission;

class RemovePermissionFromUserController extends Controller
{
    use HasResponse;

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
