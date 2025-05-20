<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this['user'];

        $data = [
            'logedInUser' => [
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
            ],
            'points' => $this['points'],
        ];

        if (!$user->hasAnyRole(['admin', 'TechnicalAssistant'])) {
            $data['doctor'] = $this['doctor'];
        }

        return $data;
    }
}
