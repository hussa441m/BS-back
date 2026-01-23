<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
             'email' => $this->email,
             'name' => $this->name,
             'experience' => round(Carbon::parse($this->profile->experience_start)->diffInDays(now()) / 365.25,1),
             'status' => $this->status,
             'role' => $this->profile->role->name,
             'documents' => $this->profile->documents->map(function($doc){
                return [                    
                    'url' => asset('storage/' . $doc->path),
                ];
             }),
        ];
    }
}
