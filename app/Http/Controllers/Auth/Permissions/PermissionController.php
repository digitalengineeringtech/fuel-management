<?php

namespace App\Http\Controllers\Auth\Permissions;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\Permissions\PermissionResource;
use App\Traits\HasResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    use HasResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::paginate(10);

        return PermissionResource::collection($permissions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $permission = Permission::create([
                'name' => Str::lower($request->name),
            ]);

            if (! $permission) {
                return $this->errorResponse('Failed to create permission', 400, null);
            }

            return $this->successResponse('Permission created successfully', 201, new PermissionResource($permission));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::find($id);

        if (! $permission) {
            return $this->errorResponse('Permission not found', 404, null);
        }

        return new PermissionResource($permission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = Permission::find($id);

        if (! $permission) {
            return $this->errorResponse('Permission not found', 404, null);
        }

        $permission->update([
            'name' => Str::lower($request->name),
        ]);

        return $this->successResponse('Permission updated successfully', 200, new PermissionResource($permission));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);

        if (! $permission) {
            return $this->errorResponse('Permission not found', 404, null);
        }

        $permission->delete();

        return $this->successResponse('Permission deleted successfully', 200, null);
    }
}
