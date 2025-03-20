<?php

namespace App\Http\Controllers\Auth\Users;

use App\Models\User;
use App\Traits\HasResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dedoc\Scramble\Attributes\Group;
use App\Http\Resources\Auth\Users\UserResource;

#[Group('User')]
class GetUserController extends Controller
{
    use HasResponse;

    /**
     * Handle an incoming get request.
     *
     * @return JsonResponse single user
     *
     * @throws \Exception
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
