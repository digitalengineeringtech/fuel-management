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
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(10);

        return RoleResource::collection($roles);
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);

        if (! $role) {
            return $this->errorResponse('Role not found', 404, null);
        }

        return new RoleResource($role);
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
