<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Models\doctorDetails;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Handle the complete login process.
     */
    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            throw new Exception('Invalid credentials.', 401);
        }

        $user = Auth::user();
        // Delete previous tokens
        $user->tokens()->delete();

        if (!$user->is_active) {
            throw new Exception('Your account is not active.', 401);
        }

        // Create new token
        $token = $user->createToken('token-name')->plainTextToken;

        // Get permissions via roles
        $permissions = $user->getPermissionsViaRoles()->pluck('name')->toArray();

        
        return [
            'user' => $user,
            'permissions' => $permissions,
            'token' => $token,
        ];
    }

    public function createUser($request,$isActive,$userRole)
    {
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active'=>$isActive,
        ]);

        $user->assignRole($userRole);
        if($request->role=='doctor'){
            doctorDetails::create([
                'user_id' => $user->id,
                'city' => $request->city,
                'specialty' => $request->specialty,
                'location' => $request->location,]);
        }
        return $user;

    }

    public function getUserById($userId){
        return User::select('phone','name','is_active','email','id')->find($userId);
    }

    public function updateUserActivation($userId,$isActive) {
        $user = User::find($userId);
        $user->is_active=$isActive;
        $user->save(); 
    }
}
