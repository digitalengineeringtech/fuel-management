<?php

namespace App\Http\Controllers\Local\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Local\Members\CreateRequest;
use App\Http\Requests\Local\Members\UpdateRequest;
use App\Repositories\Local\Contracts\Members\MemberRepositoryInterface;

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
