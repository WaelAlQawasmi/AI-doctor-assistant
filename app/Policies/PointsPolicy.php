<?php

namespace App\Policies;

use App\Models\pointManagement;
use App\Models\User;

class PointsPolicy
{
    /**
     * Create a new policy instance.
     */

     public function BasicAIDiagnosis(User $user, String $AdvancedReponse)
     {
        $has_point =false;
        $point = pointManagement::where('points', '>', 0)
        ->where('user_id', $user->id);
        if($AdvancedReponse)
            $point = $point   ->where('point_type', 'LIKE', '%advanced%');
        $point = $point ->first();
        if ($point!= null){
            $has_point =true;
            $point->points -= 1; 
            $point->save();

        }
         return $user->hasPermissionTo('create doctor user')|| $has_point;
    }
}
