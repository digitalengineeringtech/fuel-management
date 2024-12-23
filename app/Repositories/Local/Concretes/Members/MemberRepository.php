<?php

namespace App\Repositories\Local\Concretes\Members;

use App\Http\Resources\Local\Members\MemberResource;
use App\Models\Member;
use App\Repositories\Local\Contracts\Members\MemberRepositoryInterface;
use Exception;
use App\Traits\HasResponse;

class MemberRepository implements MemberRepositoryInterface
{

     use HasResponse;
     public function getMembers($request)
     {
         $members = Member::paginate(10);

         return MemberResource::collection($members);
     }

     public function getMember($id)
     {
         $member = Member::find($id);

         if(!$member) {
             return $this->errorResponse('Member not found', 404, null);
         }

         return new MemberResource($member);
     }

     public function createMember($data)
     {
          try {
                // Create a new member
                $member = Member::create($data);

                return new MemberResource($member);

          } catch(Exception $e) {
              return $this->errorResponse($e->getMessage(), 500,  null);;
          }
     }

     public function updateMember($id, $data)
     {

         // find the member by id
         $member = Member::find($id);

         // if the member doesn't exist, return an error response
         if(!$member) {
            return $this->errorResponse('Member not found', 404, null);
         }

         // update the member
         $member->update($data);

         return new MemberResource($member);
     }

     public function deleteMember($id)
     {
        // find the member by id
        $member = Member::find($id);

        // if the member doesn't exist, return an error response
        if(!$member) {
            return $this->errorResponse('Member not found', 404, null);
        }

         // Delete the member's database
         $member->delete();

         return $this->successResponse('Member deleted successfully', 200, null);
     }


}
