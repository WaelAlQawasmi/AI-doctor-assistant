<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\doctorDetails;
use App\Models\pointManagement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
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
        $user = User::find($request->id);
        $user->is_active=true;
        $user->save();
        return response('',200);

    }
    public function deactivateUser( Request $request){
        $user = User::find($request->id);
        $user->is_active=false;
        $user->save();
        return response('',200);
    }



    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'phone' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 400);
            }
            $isActive=false;
            $userRole='doctor';
           // if (Auth::guard('sanctum')->check()) {
           //     if(Auth::guard('sanctum')->user()->hasPermissionTo('create doctor user'))
                //    $isActive=true;
            //    if( Auth::guard('sanctum')->user()->hasPermissionTo('sensitive data'))
                    $userRole=$request->role;
                
           // }

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
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $user->tokens()->delete();
                if (!$user->is_active)
                    return response()->json(['status'=>false,'message'=>"Your account is not active."],401);

                $token = $user->createToken('token-name')->plainTextToken;
                $logedInUser=  $user;
                $permissions =[];
                foreach ( $logedInUser->getPermissionsViaRoles() as $item) {
                    $permissions[] = $item['name'];
                }
                return response()->json([
                    'logedInUser' =>[
                        'id' => $logedInUser->id,
                        'name' => $logedInUser->name,
                        'phone'=> $logedInUser->phone,
                        'email' =>  $logedInUser->email,
                        'is_active'=>  $logedInUser-> is_active,
                        'role'=> $logedInUser-> roles[0]->name,
                        'permissions' => $permissions,
                    ],
                    'token' => $token
                ], 200);
    
            }
    
            return response()->json(['message' => 'Unauthorized'], 401);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getUserProfile(){
        $user=User::select('phone','name','is_active','email','id')->find(Auth::id());
        $logedInUser=[
            'name'=>$user->name,
            'phone'=>$user->phone,
            'email'=>$user->email,

        ];
        $points = pointManagement::where('user_id',$user->id)->where('points','>',0)->select('points','point_type')->get();
        $userProfile=['logedInUser'=>$logedInUser,'points'=>$points];
        if(!$user->hasAnyRole(['admin', 'TechnicalAssistant'])){
            $userProfile['doctor']=doctorDetails::where('user_id',$user->id)->get();
        }
        return response()->json($userProfile,200);
    }
}

