<?php

namespace App\Http\Controllers\Api\Likes;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    public function getPostLikes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ], 422);
        }

        $likes = Like::all()->where("post_id",$request->post_id);

        if (count($likes)) {
            return response()->json([
                "likes"=>$likes],200);
        } else {
            return response()->json([
                "message" => "Post doesn't have likes"
            ], 422);
        }
    }

    public function addPostLikes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ], 422);
        }

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




