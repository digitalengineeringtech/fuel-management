<?php

namespace App\Http\Controllers\Auth\Users;

use Exception;
use App\Models\User;
use App\Traits\HasResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dedoc\Scramble\Attributes\Group;
use App\Http\Resources\Auth\Users\UserResource;

#[Group('User')]
class GetUsersController extends Controller
{
    use HasResponse;

    /**
     * Get all users
     *
     * @response array{message: string, code: int, data: UserResource[]}
     */
    public function __invoke(Request $request)
    {
        try {
            $users = User::paginate(10);

            if(!$users) {
                return $this->errorResponse('Users not found', 404, null);
            }

            return UserResource::collection($users);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, []);
        }
    }
}
