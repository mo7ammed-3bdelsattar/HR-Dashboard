<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->uid,
            'name' => $this->name,
            'subdomain' => $this->subdomain,
            'timezone' => $this->timezone,
            'logo' => asset('storage/' . $this->logo),
            'status' => $this->status,
        ];
    }
}
