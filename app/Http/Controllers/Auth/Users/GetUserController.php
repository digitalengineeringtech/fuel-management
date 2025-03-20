<?php

namespace App\Http\Controllers\Auth\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\Users\UserResource;
use App\Models\User;
use App\Traits\HasResponse;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\Request;

#[Group('User')]
class GetUserController extends Controller
{
    use HasResponse;

    /**
     * Get a user
     *
     * @response array{message: string, code: int, data: UserResource}
     */
    public function __invoke(Request $request, $id)
    {
        try {
            $user = User::find($id);

            return new UserResource($user);

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
