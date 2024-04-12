<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function updateUserData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'surname' => 'required|min:2|max:100',
            'lastname' => 'max:100',
            'username' => 'alpha:ascii|required|unique:users',
            'email' => 'required|unique:users|email',
            'specialization_id' => 'required',
            'position_id' => 'required'
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
            'position_id' => $request->position_id
        ]);
        return response()->json([
            'message' => 'The data has been edited',
            'data' => $user
        ], 200);
    }

    public function getUserLikedPosts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ], 422);
        }

        $likes = Like::with('post')->where('user_id', $request->user_id)->get();

        if(count($likes)){
            return response()->json([
                'user_id' => $request->user_id,
                'message' => $likes
            ], 200);
        } else {
            return response()->json([
                'user_id' => $request->user_id,
                'message' => 'This user doesnt like any post'
            ]);
        }

    }

    public function getProfileData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::all()->where('id', $request->user_id)->first();

        if ($user) {
            return response()->json([
                'message' => 'Data fetch success fully',
                'user' => $user
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data doesnt fetched succesfully ',
                'user' => $user
            ], 402);
        }

    }

    public function getUserPosts(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ], 422);
        }

        $posts = Post::all()->where('user_id',$request->user_id);

        if(count($posts)){
            return response()->json([
                'message' => 'Data fetch success fully',
                'data' => $posts
            ], 200);
        } else {
            return response()->json([
                'user_id' => $request->user_id,
                'message' => 'This user doesnt have any post'
            ]);
        }

    }
}
