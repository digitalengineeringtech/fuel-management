<?php

namespace App\Http\Controllers\Cloud\Members;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cloud\Members\CreateRequest;
use App\Http\Requests\Cloud\Members\UpdateRequest;
use App\Repositories\Cloud\Contracts\Members\MemberRepositoryInterface;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private $memberRepository;

    public function __construct(MemberRepositoryInterface $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    /**
     * All Members
     *
     * @response array{message: string, code: int, data: MemberResource[]}
     */
    public function index(Request $request)
    {
        return $this->memberRepository->getMembers($request);
    }

    /**
     * Create Member
     *
     * @response array{message: string, code: int, data: MemberResource}
     */
    public function store(CreateRequest $request)
    {
        return $this->memberRepository->createMember($request->validated());
    }

    /**
     * Single Member
     *
     * @response array{message: string, code: int, data: MemberResource}
     */
    public function show($id)
    {
        return $this->memberRepository->getMember($id);
    }

    /**
     * Update Member
     *
     * @response array{message: string, code: int, data: MemberResource}
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->memberRepository->updateMember($id, $request->validated());
    }

    /**
     * Delete Member
     *
     * @response array{message: string, code: int, data: null}
     */
    public function destroy($id)
    {
        return $this->memberRepository->deleteMember($id);
    }
}
