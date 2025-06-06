<?php
namespace App\Services;


use App\Models\pointManagement;

class PointsService
{
    public function getPoints($userId){
       return pointManagement::select('points','point_type')
        ->where('user_id',$userId)->where('points','>',0)->get();
    }

    public function  chargePoints($userId, $points, $pointType){
        $trialPoint = pointManagement::create([
            'user_id' => $userId,
            'points' => $points,
            'point_type' => $pointType
        ]);
        return  $trialPoint->id;
    }

    public function getAllusersWithPoints (){
        
    }
}