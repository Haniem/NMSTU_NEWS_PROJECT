<?php

namespace App\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComentController extends Controller
{
    public function createComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment_text' => 'required',
            'type_id' => 'required'
        ]);



        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ], 422);
        }

        $comment = Comment::create([
            'post_id' => $request->post_id,
            'user_id' => $request->user()->id,
            'post_text' => $request->post_text
        ]);

        return response()->json([
            'message' => 'Validations succesfull',
            'data' => $comment
        ], 200);
    }
}
