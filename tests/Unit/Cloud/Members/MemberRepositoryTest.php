<?php

use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('can get all members and response with resource', function () {
    Member::factory()->count(5)->create();

    $response = $this->actingAs($this->user)->get('/api/cloud/members');

    $response->assertStatus(200)
        ->assertJsonCount(5, 'data');
});

it('can get member by id and response with resource', function () {
    $member = Member::factory()->create();

    $response = $this->actingAs($this->user)->get("/api/cloud/members/{$member->id}");

    $response->assertStatus(200);
});

it('can create member and response with resource', function () {
    $memberData = Member::factory()->make()->toArray();

    $response = $this->actingAs($this->user)->post('/api/cloud/members', $memberData);

    $response->assertStatus(201);
});

it('can update member and response with resource', function () {
    $member = Member::factory()->create();

    $updatedData = Member::factory()->make(['type' => 'gold'])->toArray();

    $response = $this->actingAs($this->user)->put("/api/cloud/members/{$member->id}", $updatedData);

    $response->assertStatus(200);
});

it('can delete member and response with resource', function () {
    $member = Member::factory()->create();

    $response = $this->actingAs($this->user)->delete("/api/cloud/members/{$member->id}");

    $response->assertStatus(200);
});
