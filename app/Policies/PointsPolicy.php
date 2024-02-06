<?php

namespace App\Policies;

use App\Models\pointManagement;
use App\Models\User;

class PointsPolicy
{
    /**
     * Create a new policy instance.
     */

     public function BasicAIDiagnosis(User $user)
     {
        $has_point = pointManagement::where('point_type', 'basic')
        ->where('points', '>', 1)
        ->where('user_id', $user->id)
        ->count() >1;
         return $user->hasPermissionTo('create doctor user')|| $has_point;
    }
}
