<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Models\doctorDetails;
use App\Models\pointManagement;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class PointsService
{
    public function getPoints($userId){
       return pointManagement::select('points','point_type')
        ->where('user_id',$userId)->where('points','>',0)->get();
    }
}