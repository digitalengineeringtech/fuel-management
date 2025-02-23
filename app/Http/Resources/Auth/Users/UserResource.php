<?php

namespace App\Http\Resources\Auth\Users;

use Illuminate\Http\Request;
use App\Http\Resources\Auth\Roles\RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Auth\Permissions\PermissionResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'station_id' => $this->station_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'card_id' => $this->card_id,
            'tank_count' => $this->tank_count,
            'roles' => RoleResource::collection($this->roles),
            'permissions' => PermissionResource::collection($this->permissions)
        ];
    }
}
