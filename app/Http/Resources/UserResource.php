<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return Cache::remember("user_{$this->id}_resource", 60, function() {
            return [
                "id" => $this->id,
                "name" => $this->name,
                "email" => $this->email
                ];
        });
    }
}
