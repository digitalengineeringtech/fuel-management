<?php

namespace App\Http\Resources\Local\Dispensers;

use App\Http\Resources\Cloud\Stations\StationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DispenserResource extends JsonResource
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
            'station' => new StationResource($this->station),
            'device_ip' => $this->device_ip,
            'server_ip' => $this->server_ip,
            'server_port' => $this->server_port,
            'firmware_version' => $this->firmware_version,
            'boot_count' => $this->boot_count,
            'retry_count' => $this->retry_count,
            'debug_bit' => $this->debug_bit,
            'password' => $this->password,
            'wifi_ssid' => $this->wifi_ssid,
            'wifi_password' => $this->wifi_password,
        ];
    }
}
