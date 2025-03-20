<?php

namespace App\Http\Controllers\Auth\Users;

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
     * Handle an incoming get request.
     *
     * @return JsonResponse all users
     *
     * @throws \Exception
     */
    public function __invoke(Request $request)
    {
        try {
            $users = User::paginate(10);

            return UserResource::collection($users);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, []);
        }
    }
}
