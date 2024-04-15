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
    public function createComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment_text' => 'required',
            'post_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ], 422);
        }

        $comment = Comment::create([
            'comment_text' => $request->comment_text,
            'user_id' => $request->user()->id,
            'post_id' => $request->post_id
        ]);

        return response()->json([
            'message' => 'Validations succesfull',
            'data' => $comment
        ], 200);
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

        $comment=Comment::where('id',$request->comment_id)->get();

        if ($comment)
        {
            return response()->json([
                'message' => 'The comment has been edited',
                "data"=>$comment],200);
        } else
        {
            return response()->json([
                "message" => "No comment!"
            ], 422);
        }

    }

}



