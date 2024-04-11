<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'surname' => 'required|min:2|max:100',
            'lastname' => 'max:100',
            'username' => 'alpha:ascii|required|unique:users',
            'email' => 'required|unique:users|email',
            'specialization_id' => 'required',
            'position_id' => 'required',
            'password' => 'bail|required',
            'password_confirmation' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ], 422);
        }
        $user = User::where('id', $request->user()->id)->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'specialization_id' => $request->specialization_id,
            'position_id' => $request->position_id,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'message' => 'The data has been edited',
            'data' => $user
        ], 200);
    }
} 
