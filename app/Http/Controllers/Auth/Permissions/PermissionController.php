<?php

namespace App\Http\Controllers\Auth\Permissions;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\Permissions\PermissionResource;
use App\Traits\HasResponse;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Models\Permission;

#[Group('Permission')]
class PermissionController extends Controller
{
    use HasResponse;

    /**
     * All Permissions
     *
     * @response array{message: string, code: int, data: PermissionResource[]}
     */
    public function index()
    {
        $permissions = Permission::paginate(10);

        return PermissionResource::collection($permissions);
    }

    /**
     * Create Permission
     *
     * @response array{message: string, code: int, data: PermissionResource}
     */
    public function store(Request $request)
    {
        try {
            $permission = Permission::create([
                'name' => Str::lower($request->name),
                'guard_name' => 'api',
            ]);

            if (! $permission) {
                return $this->errorResponse('Failed to create permission', 400, null);
            }

            return $this->successResponse('Permission created successfully', 201, new PermissionResource($permission));

        } catch (PermissionAlreadyExists $e) {
            return $this->errorResponse('Permission already exists', 409, null);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    /**
     * Single Permission
     *
     * @response array{message: string, code: int, data: PermissionResource}
     */
    public function show(string $id)
    {
        try {
            $permission = Permission::find($id);

            if (! $permission) {
                return $this->errorResponse('Permission not found', 404, null);
            }

            return $this->successResponse('Permission retrieved successfully', 200, new PermissionResource($permission));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    /**
     * Update Permission
     *
     * @response array{message: string, code: int, data: PermissionResource}
     */
    public function update(Request $request, string $id)
    {
        try {
            $permission = Permission::find($id);

            if (! $permission) {
                return $this->errorResponse('Permission not found', 404, null);
            }

            $permission->update([
                'name' => Str::lower($request->name),
            ]);

            return $this->successResponse('Permission updated successfully', 200, new PermissionResource($permission));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    /**
     * Delete Permission
     *
     * @response array{message: string, code: int, data: null}
     */
    public function destroy(string $id)
    {
        try {
            $permission = Permission::find($id);

            if (! $permission) {
                return $this->errorResponse('Permission not found', 404, null);
            }

            $permission->delete();

            return $this->successResponse('Permission deleted successfully', 200, null);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
