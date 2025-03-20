<?php

namespace App\Http\Controllers\Auth\Users;

use App\Http\Controllers\Controller;
use App\Traits\HasResponse;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\Request;

#[Group('User')]
class DeleteUserController extends Controller
{
    use HasResponse;

    /**
     * Delete a user
     *
     * @response array{message: string, code: int, data: null}
     */
    public function __invoke(Request $request)
    {
        try {
            $user = $request->user();

            if (! $user) {
                return $this->errorResponse('User not found', 404, null);
            }

            $user->delete();

            return $this->successResponse('User deleted successfully', 200, null);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
