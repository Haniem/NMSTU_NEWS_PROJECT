<?php

namespace App\Http\Controllers\Api\Likes;

use App\Http\Controllers\Controller;
use App\Models\Like;
use http\Env\Request;

class LikeController extends Controller
{
    public function getPostLikes(Request $request)
    {
        $likes = Like::where("post_id",$request->post_id);
        return response()->json([
            "likes"=>$likes],200);
    }

    public function addPostLikes(Request $request)
    {
        $likes = Like::create([
            'user_id' => $request->user()->id,
            'post_id' => $request->post_id
        ]);

        return response()->json([
        'message' => 'Validations succesfull',
        'data' => $likes
        ], 200);
    }
}




