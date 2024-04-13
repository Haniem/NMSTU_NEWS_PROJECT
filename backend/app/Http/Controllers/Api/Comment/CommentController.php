<?php

namespace App\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function getComments(Request $request)
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

        $comments = Comment::all()->where("post_id", $request->post_id);

        return response()->json([
            "message" => "Data fetched succesfully",
            "comments" => $comments], 200);
    }



    public function updateComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment_text' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ], 422);
        }

        $comment=Comment::where('id',$request->comment_id)->update([
            'comment_text'=>$request->comment_text
        ]);
        return response()->json([
            'message' => 'The comment has been edited',
            'data' => $comment
        ], 200);
    }

}



