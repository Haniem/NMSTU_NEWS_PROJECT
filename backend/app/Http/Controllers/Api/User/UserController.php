<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{
    public function getProfileData(Request $request){
        $user = User::find($request->user()->id)->first();
        return response()->json([
            'message' => 'Data fetch success fully',
            'data' => $user
        ], 200);
    }
    public function getUserPosts(Request $request){
        $posts = Post::find()->where('user_id',$request->user()->id);
        return response()->json([
            'message' => 'Data fetch success fully',
            'data' => $posts
        ], 200);
    }
}
