<?php

namespace App\Http\Controllers\Auth\Roles;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\Roles\RoleResource;
use App\Traits\HasResponse;
use Dedoc\Scramble\Attributes\Group;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Models\Role;

#[Group('Role')]
class RoleController extends Controller
{
    use HasResponse;

    /**
     * All Roles
     *
     * @response array{message: string, code: int, data: RoleResource[]}
     */
    public function index(Request $request)
    {
        try {
            $roles = Role::paginate(10);

            if(!$roles) {
                return $this->errorResponse('Roles not found', 404, null);
            }

            return $this->successResponse('Roles retrieved successfully', 200, RoleResource::collection($roles));
        } catch(Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    /**
     * Create Role
     *
     * @response array{message: string, code: int, data: RoleResource}
     */
    public function store(Request $request)
    {
        try {
            $role = Role::create([
                'name' => Str::lower($request->name),
                'guard_name' => 'api',
            ]);

            if (! $role) {
                return $this->errorResponse('Failed to create role', 400, null);
            }

            if ($request->has('permissions')) {
                $role->syncPermissions($request->input('permissions.*.name'));
            }

            return $this->successResponse('Role created successfully', 201, new RoleResource($role));

        } catch (RoleAlreadyExists $e) {
            return $this->errorResponse('Role already exists', 409, null);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    /**
     * Single Role
     *
     * @response array{message: string, code: int, data: RoleResource}
     */
    public function show(string $id)
    {
        try {
            $role = Role::find($id);

            if (! $role) {
                return $this->errorResponse('Role not found', 404, null);
            }

            return $this->successResponse('Role retrieved successfully', 200, new RoleResource($role));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);

        }
    }

    /**
     * Update Role
     *
     * @response array{message: string, code: int, data: RoleResource}
     */
    public function update(Request $request, string $id)
    {
        try {
            $role = Role::find($id);

            if (! $role) {
                return $this->errorResponse('Role not found', 404, null);
            }

            $role->update([
                'name' => Str::lower($request->name),
            ]);

            return $this->successResponse('Role updated successfully', 200, new RoleResource($role));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    /**
     * Delete Role
     *
     * @response array{message: string, code: int, data: null}
     */
    public function destroy(string $id)
    {
        try {
            $role = Role::find($id);

            if (! $role) {
                return $this->errorResponse('Role not found', 404, null);
            }

            $role->delete();

            return $this->successResponse('Role deleted successfully', 200, null);

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
