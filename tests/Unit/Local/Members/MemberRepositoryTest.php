<?php

use App\Models\Member;
use App\Repositories\Local\Contracts\Members\MemberRepositoryInterface;

beforeEach(function () {
    $this->memberRepository = $this->mock(MemberRepositoryInterface::class);
});


test('can get all members and response with resource', function () {
    $members = Member::factory()->create();

    $this->memberRepository->shouldReceive('getMembers')->andReturn($members);

    $response = $this->memberRepository->getMembers(request());

    expect($response)->toBe($members);
});

test('can get member by id and response with resource', function () {
    $member = Member::factory()->create();

    $this->memberRepository->shouldReceive('getMember')->andReturn($member);

    $response = $this->memberRepository->getMember($member->id);

    expect($response->id)->toBe($member->id);
});

test('can create fuel type and response with resource', function () {
    $member = Member::factory()->make();

    $this->memberRepository->shouldReceive('createMember')->andReturn($member);

    $response = $this->memberRepository->createMember($member->toArray());

    expect($response->id)->toBe($member->id);
    expect($response->name)->toBe($member->name);
});

test('can update fuel type and response with resource', function () {
    $member = Member::factory()->create();

    $this->memberRepository->shouldReceive('updateMember')->andReturn($member);

    $response = $this->memberRepository->updateMember($member->id, $member->toArray());

    expect($response->id)->toBe($member->id);
    expect($response->name)->toBe($member->name);
});

test('can delete fuel type and response with resource', function () {
    $member = Member::factory()->create();

    $this->memberRepository->shouldReceive('deleteMember')->andReturn(['message' => 'Member deleted successfully']);

    $response = $this->memberRepository->deleteMember($member->id);

    expect($response['message'])->toBe('Member deleted successfully');
});
