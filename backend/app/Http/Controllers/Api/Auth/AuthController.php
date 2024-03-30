<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();


        if($user){

            if(Hash::check($request->password, $user->password)){


                $token = $user->createToken('auto-token')->plainTextToken;

                return response()->json([
                    'message' => 'Incorrect Successfull',
                    'token' => $token,
                    'data' => $user
                ], 200);

            }else {
                return response()->json([
                    'message' => 'Incorrect credentials'
                ], 400);
            }
        } else {
            return response()->json([
                'message' => 'Incorrect credentials'
            ], 400);

        }
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=>'required|min:2|max:100',
            'surname'=>'required|min:2|max:100',
            'lastname'=>'max:100',
            'username'=>'alpha:ascii|required|unique:users',
            'email'=>'required|unique:users|email',
            'specialization_id'=>'required',
            'position_id'=>'required',
            'password'=>'bail|required',
            'password_confirmation'=>'required|same:password'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'specialization_id' => $request->specialization_id,
            'position_id' => $request->position_id,
            'role_id' => 1,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Validations succesfull',
            'data' => $user
        ], 200);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'=>'User successfully logged out',
        ],200);
    }
}
