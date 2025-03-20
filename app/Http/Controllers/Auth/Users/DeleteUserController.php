<?php

namespace App\Http\Controllers\Auth\Users;

use App\Traits\HasResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dedoc\Scramble\Attributes\Group;

#[Group('User')]
class DeleteUserController extends Controller
{
    use HasResponse;

    /**
     * Handle an incoming delete request.
     *
     * @return JsonResponse
     *
     * @throws \Exception
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
