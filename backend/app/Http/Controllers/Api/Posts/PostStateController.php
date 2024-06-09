<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;

class PostStateController extends Controller
{
     public function activeState(Request $request){
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ], 422);
        }

        $post=Post::find($request->post_id);

        if ($post){
            {
                $post = Post::where('id',$request->post_id)->update([
                    'state'=> 'active'
                ]);
                $post = Post::find($request->post_id);
                return response()->json([
                    'message' => 'Статус поста успешно обновлен.',
                    "data"=>$post],200);
            } 
        } else {
            return response()->json([
                "message" => "Пост не найден."
            ]);
        }
    }

    public function bannedState(Request $request){
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ], 422);
        }

        $post=Post::find($request->user_id);

        if ($post){
            {
                $post = Post::where('id',$request->post_id)->update([
                    'state'=> 'banned'
                ]);
                $post = Post::find($request->post_id);
                return response()->json([
                    'message' => 'Статус поста успешно обновлен.',
                    "data"=>$post],200);
            } 
        } else {
            return response()->json([
                "message" => "Пост не найден."
            ]);
        }
    }
}
