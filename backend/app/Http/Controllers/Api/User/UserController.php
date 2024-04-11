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
}
