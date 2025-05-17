<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    protected $permissions;

    public function __construct($resource, $permissions = [])
    {
   
        parent::__construct($resource);
        $this->permissions = $permissions;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */


    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'phone'      => $this->phone,
            'email'      => $this->email,
            'is_active'  => $this->is_active,
            'role'       => $this-> roles[0]->name, 
            'permissions' => $this->permissions,
        ];
        
    }
}
