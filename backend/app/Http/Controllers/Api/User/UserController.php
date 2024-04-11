<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;


class UserController extends Controller
{
    public function getUserLikedPosts(Request $request)
    {
        $user_id = $request->user()->id;
        $likes = Like::with('post')->where('user_id', $user_id)->get();

        return response()->json([
            'user_id' => $request->user()->id,
           'message' => $likes
        ]);
    }

    public function getProfileData(Request $request)
    {
        $user = User::all()->where($request->user()->id)->first();

        return response()->json([
            'message' => 'Data fetch success fully',
            'data' => $user
        ], 200);
    }

    public function getUserPosts(Request $request){
        $posts = Post::all()->where('user_id',$request->user()->id);

        return response()->json([
            'message' => 'Data fetch success fully',
            'data' => $posts
        ], 200);
    }
}
