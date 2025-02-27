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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->memberRepository->getMembers($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        return $this->memberRepository->createMember($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->memberRepository->getMember($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->memberRepository->updateMember($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->memberRepository->deleteMember($id);
    }
}
