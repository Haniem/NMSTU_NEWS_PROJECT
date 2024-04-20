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
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ], 422);
        }

        $likes = Like::all()->where("post_id",$request->post_id);

        if ($likes) {
            return response()->json([
                "likes"=>$likes],200);
        } else {
            return response()->json([
                "message" => "У данного поста нет лайков."
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
                'message' => 'Неправильно введенные данные.',
                'errors' => $validator->errors()
            ], 422);
        }
        $like = Like::where('post_id', $request->post_id)->first();
        if (!$like) {
            $likes = Like::create([
                'user_id' => $request->user()->id,
                'post_id' => $request->post_id
            ]);
                return response()->json([
                    'message' => 'Лайк успешно добавлен.',
                    'data' => $likes
                ], 200);
        } else {
            return response()->json([
                'message' => 'Вы уже поставили лайк на этот пост'
            ]);
        }
    }

    public function deletePostLike(Request $request) {
        $validator = Validator::make(request()->all(), [
            'post_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ]);
        }
        $like = Like::where('post_id', $request->post_id)->first();
        if ($like) {
            if ($like->user_id == $request->user()->id) {
                Like::where('post_id', $request->post_id)->delete();
                return response()->json([
                    "message" => "Лайк успешно удалён.",
                ], 200);
            } else {
                return response()->json([
                    "message" => "Вы не можете удалить этот лайк."
                ]);
            }
        } else {
            return response()->json([
                "message" => "Вы еще не поставили лайк на этот пост."
            ]);
        }
    }
}




