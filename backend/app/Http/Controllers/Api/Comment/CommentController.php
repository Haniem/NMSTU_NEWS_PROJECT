<?php

namespace App\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function getComments(Request $request){
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ], 422);
        }
        $comments = Comment::all()->where("post_id", $request->post_id);

        if (!$comments->isEmpty()) {
            return response()->json([
                "message" => "Комментарии успешно получены.",
                "comments" => $comments], 200);
        } else {
            return response()->json([
                "message" => "У данного поста нет комментариев."
            ], 402);
        }

    }
    public function createComment(Request $request){
        $validator = Validator::make($request->all(), [
            'comment_text' => 'required',
            'post_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ], 422);
        }

        $comment = Comment::create([
            'comment_text' => $request->comment_text,
            'user_id' => $request->user()->id,
            'post_id' => $request->post_id
        ]);

        return response()->json([
            'message' => 'Комментарий успешно добавлен.',
            'data' => $comment
        ], 200);
    }
    public function updateComment(Request $request){
        $validator = Validator::make($request->all(), [
            'comment_id' => 'required|integer',
            'comment_text' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ], 422);
        }

        $comment=Comment::find($request->comment_id);

        if ($comment){
            if ($request->user()->id==$comment->user_id)
            {
                $comment=Comment::where('id',$request->comment_id)->update([
                    'comment_text'=>$request->comment_text
                ]);
                $comment=Comment::find($request->comment_id);
                return response()->json([
                    'message' => 'Комментарий успешно обновлен.',
                    "data"=>$comment],200);
            }  else {
                return response()->json([
                    "message" => "Вы не можете редактировать этот комментарий."
                ]);
            }
        } else {
            return response()->json([
                "message" => "Комментарий не найден."
            ]);
        }
    }

    public function getComment(Request $request){
        $validator = Validator::make($request->all(), [
            'comment_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ], 402);
        }
        $comment = Comment::find($request->comment_id);

        if ($comment) {
            return response()->json([
                "message" => "Комментарий успешно найден.",
                "data" => $comment
            ], 200);
        } else {
            return response()->json([
                "message" => "Комментарий не найден."
            ],422);
        }
    }

    public function deleteComment(Request $request){
        $validator = Validator::make($request->all(), [
            'comment_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ]);
        }
        $comment = Comment::find($request->comment_id);
        if ($comment){
            if ($request->user()->id==$comment->user_id) {
                $comment->delete();
                return response()->json([
                    "message" => "Комментарий удалён.",
                    "data" => $comment
                ]);
            } else {
                return response()->json([
                    "message" => "Вы не можете удалить этот комментарий."
                ], 402);
            }
        } else {
            return response()->json([
                "message" => "Комментарий не найден."
            ], 402);
        }
    }
}



