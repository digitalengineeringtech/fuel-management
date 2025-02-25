<?php

namespace App\Repositories\Local\Contracts\Members;

/**
 * Interface defining the contract for a member repository.
 * This interface provides methods for managing members, including
 * retrieving a list of members, getting details of a specific member,
 * creating a new member, updating an existing member, and deleting a member.
 */
interface MemberRepositoryInterface
{
    /** *
     * Get a list of members based on the provided query
     */
    public function getMembers($request);

    /**
     * Get a specific member by its ID.
     *
     * @param  int  $id
     */
    public function getMember($id);

    /**
     * Create a new member with the provided data.
     *
     * @param  array  $data
     */
    public function createMember($data);

    /**
     * Update an existing member by its ID and update the provided data.
     *
     * @param  int  $id
     * @param  array  $data
     */
    public function updateMember($id, $data);

    /**
     *  Delete a member by its ID.
     *
     * @param  int  $id
     */
    public function deleteMember($id);
}
