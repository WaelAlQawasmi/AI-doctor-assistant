<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserProfileResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use App\Services\PointsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function __construct( protected AuthService $authService , protected PointsService $pointsService)
    {
    
    }

     /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function getUsrById( $id){
        return response()->json(User::find($id));

    }
   public function getUsrByName( $name){
        return response()->json(User::where('name',$name)  ->first());

    }

    public function activateUser( Request $request){
      $this->authService->updateUserActivation($request->id,true);
      return response('',200);
    }

    public function deactivateUser( Request $request){
        $this->authService->updateUserActivation($request->id,false);
        return response('',200);
    }

    public function createUser(CreateUserRequest $request)
    {
        try {
            $isActive=false;
            $userRole='doctor';
           if (Auth::guard('sanctum')->check()) {
               if(Auth::guard('sanctum')->user()->hasPermissionTo('create doctor user'))
                   $isActive=true;
               if( Auth::guard('sanctum')->user()->hasPermissionTo('sensitive data'))
                   $userRole=$request->role;   
           }
           $user = $this->authService->createUser($request,$isActive,$userRole);
            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param LoginRequest $request
     * @return User
     */
    public function loginUser(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            $result = $this->authService->login($credentials);

            return response()->json([
                'logedInUser' => new UserResource($result['user'], $result['permissions']),
                'token' => $result['token'],
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    public function getUserProfile(){

        $user = $this->authService->getUserById(Auth::id());
        $points = $this->pointsService->getPoints($user->id);

        $doctorDetails = null;
        if (!$user->hasAnyRole(['admin', 'TechnicalAssistant'])) {
            $doctorDetails = \App\Models\DoctorDetails::where('user_id', $user->id)->get();
        }

        return new UserProfileResource([
            'user' => $user,
            'points' => $points,
            'doctor' => $doctorDetails
        ]);

    }
}

