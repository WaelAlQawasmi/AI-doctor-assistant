<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointManagementController extends Controller
{
    public function getAllusersWithPoints(){
        $usersWithPoints = User::leftJoin('point_management', 'users.id', '=', 'point_management.user_id')
        ->select(
            'users.id', // Assuming you want to group by user ID
            'users.name',
            'users.is_active',
            'users.email',
            DB::raw('SUM(point_management.points) as total_points')
        )
        ->with('roles.permissions')
        ->groupBy('users.id', 'users.name', 'users.is_active', 'users.email')
        ->get();
        $allUsers=[];
        foreach ($usersWithPoints as $user){
            $userWithNewFormat=['name'=>$user->name,
                                'total_points'=>$user->total_points
                                ,'id'=>$user->id,
                                'phone'=>$user->phone,
                                'email'=>$user->email,
                                'is_active'=>$user->is_active,
                                ];
            $userWithNewFormat['role']=empty( $user->roles[0])?'doctor': $user->roles[0]->name;

            $permissions=[];
            if(!empty($user->roles[0])) {
                foreach($user->roles[0]->permissions as $permission){
                    array_push($permissions, $permission->name);
                }
            }
            $userWithNewFormat['permissions']=$permissions;
            array_push($allUsers,$userWithNewFormat);
        }
        return response()->json( $allUsers,200);
    }
}
