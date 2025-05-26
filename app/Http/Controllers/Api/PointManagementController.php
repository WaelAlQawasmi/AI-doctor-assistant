<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\pointManagement;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PointManagementController extends Controller
{
    /**
     * this haction for all data of  point management in admin panel.
     */
    public function getAllusersWithPoints()
    {
        $usersWithPoints = User::leftJoin('point_management', 'users.id', '=', 'point_management.user_id')
            ->select(
                'users.id', // Assuming you want to group by user ID
                'users.name',
                'users.is_active',
                'users.phone',
                'users.email',
                DB::raw("GROUP_CONCAT(point_management.point_type SEPARATOR ' - ') AS packages_type"),
                DB::raw('SUM(point_management.points) as total_points')
            )
            ->with('roles.permissions')
            ->groupBy('users.id', 'users.name', 'users.is_active', 'users.phone', 'users.email')
            ->get();
        $allUsers = [];
        foreach ($usersWithPoints as $user) {
            $userWithNewFormat = [
                'name' => $user->name,
                'total_points' => $user->total_points, 'id' => $user->id,
                'phone' => $user->phone,
                'email' => $user->email,
                'is_active' => $user->is_active,
                'packagesType' => $user->packages_type
            ];
            $userWithNewFormat['role'] = empty($user->roles[0]) ? 'doctor' : $user->roles[0]->name;

            $permissions = [];
            if (!empty($user->roles[0])) {
                foreach ($user->roles[0]->permissions as $permission) {
                    array_push($permissions, $permission->name);
                }
            }
            $userWithNewFormat['permissions'] = $permissions;
            array_push($allUsers, $userWithNewFormat);
        }
        array_push($allUsers);


        return response()->json($allUsers, 200);
    }
}
