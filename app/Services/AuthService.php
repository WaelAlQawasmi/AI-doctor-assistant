<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use Exception;

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
}
