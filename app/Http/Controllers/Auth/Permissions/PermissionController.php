<?php

namespace App\Http\Controllers\Auth\Permissions;

use Exception;
use App\Traits\HasResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Permission;

class PermissionController extends Controller
{
     use HasResponse;

    /**
     * Get all permissions
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
    */
     public function index(Request $request)
     {
         try{
            $permissions = Permission::all();

            if(!$permissions) {
                return $this->errorResponse('No permissions found', 404, []);
            }

            return $this->successResponse('All permissions', 200, $permissions);
         } catch(Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, []);
         }
     }

    /**
     * Create a new permission
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
    */
     public function store(Request $request)
     {
         try {
            $validated = $request->validate([
                'user_id' => ['required'],
                'name' => ['required', 'string']
            ]);

            $permission = Permission::create($validated);

            return $this->successResponse('', 201, $permission);
         } catch(Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, []);
         }
     }

    /**
      * Update permission with id
      * @param Request $request and $id
      * @return JsonResponse
      * @throws Exception
    */
     public function update(Request $request, $id)
     {
          try {
                $permission = Permission::find($id);

                if(!$permission) {
                    return $this->errorResponse('Permission not found...', 404, []);
                }

                $validated = $request->validate([
                    'user_id' => ['required'],
                    'name' => ['required', 'string']
                ]);

                $updated = $permission->update($validated);


                return $this->successResponse('Permission update success...', 200, []);

          } catch(Exception $e) {
                return $this->errorResponse($e->getMessage(), 500, []);
          }
     }

    /**
      * Delete Permission with id
      * @param Request $request and $id
      * @return JsonResponse
      * @throws Exception
    */
    public function destroy($id)
    {
        try {
           $permission = Permission::find($id);

           if(!$permission) {
              return $this->errorResponse('Permission not found', 404, []);
           }

           $permission->delete();

           return $this->successResponse('Permission delete success...', 200, []);

        } catch(Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, []);
        }
    }
}
