<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\doctorDetails;
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
                ], 401);
            }
            $isActive=false;
            if (Auth::check()) {
                if(Auth::user()->hasPermissionTo('create doctor user'))
                    $isActive=true;
            }

            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_active'=>$isActive,
            ]);


           

            if( !Auth::user()->hasPermissionTo('sensitive data')){
                $user->assignRole('doctor');
            } else{
                $user->assignRole($request->role);
            }

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
            ], 200);

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
            $user = User::where('email', $request->email)->first();
            if (!$user->is_active)
                return response()->json(['status'=>false,'message'=>"Your account is not active."],401);


            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }
           // $user->tokens()->where('id', '!=', $user->currentAccessToken()->id)->delete();

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
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getUserProfile(){
        return response()->json(User::find(Auth::id()),200);
    }
}

