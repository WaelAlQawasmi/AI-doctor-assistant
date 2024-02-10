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
        $has_point =false;
        $point = pointManagement::where('points', '>', 0)
        ->where('user_id', $user->id)->first();
        if ($point!= null){
            $has_point =true;
            $point->points -= 1; 
            $point->save();

        }
         return $user->hasPermissionTo('create doctor user')|| $has_point;
    }
}
