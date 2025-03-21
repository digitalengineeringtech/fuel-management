<?php

namespace App\Repositories\Cloud\Concretes\Members;

use App\Http\Resources\Cloud\Members\MemberResource;
use App\Models\Member;
use App\Repositories\Cloud\Contracts\Members\MemberRepositoryInterface;
use App\Traits\HasResponse;
use Exception;

class MemberRepository implements MemberRepositoryInterface
{
    use HasResponse;

    public function getMembers($request)
    {
        try {
            $members = Member::paginate(10);

            if (! $members) {
                return $this->errorResponse('Member not found', 404, null);
            }

            return MemberResource::collection($members);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function getMember($id)
    {
        try {
            $member = Member::find($id);

            if (! $member) {
                return $this->errorResponse('Member not found', 404, null);
            }

            return $this->successResponse('Member successfully retrieved', 200, new MemberResource($member));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function createMember($data)
    {
        try {

            // Create a new member
            $member = Member::create($data);

            if (! $member) {
                return $this->errorResponse('Member not found', 404, null);
            }

            return $this->successResponse('Member successfully created', 201, new MemberResource($member));

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function updateMember($id, $data)
    {
        try {
            // find the member by id
            $member = Member::find($id);

            // if the member doesn't exist, return an error response
            if (! $member) {
                return $this->errorResponse('Member not found', 404, null);
            }

            // update the member
            $member->update($data);

            return $this->successResponse('Member successfully updated', 200, new MemberResource($member));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }

    public function deleteMember($id)
    {
        try {
            // find the member by id
            $member = Member::find($id);

            // if the member doesn't exist, return an error response
            if (! $member) {
                return $this->errorResponse('Member not found', 404, null);
            }

            // Delete the member's database
            $member->delete();

            return $this->successResponse('Member deleted successfully', 200, null);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500, null);
        }
    }
}
