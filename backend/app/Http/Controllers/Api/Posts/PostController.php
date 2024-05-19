<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    public function getPosts(Request $request){
        $validSortFields = ['post_title', 'created_at', 'updated_at'];
        $validSortOrders = ['asc', 'desc'];

        $sort_by = in_array($request->query('sort_by'), $validSortFields) ? $request->query('sort_by') : 'updated_at';
        $sort_order = in_array($request->query('sort_order'), $validSortOrders) ? $request->query('sort_order') : 'asc';

        $posts = Post::orderBy($sort_by, $sort_order)->get();
        return response()->json([
            "message" => "Посты успешно получены.",
            "posts"=>$posts
        ],200);
    }

    public function createPost(Request $request){
        $validator = Validator::make($request->all(), [
            'post_title' => 'required|min:2|max:300',
            'post_description' => 'min:10|max:500',
            'post_text' => 'required',
            'type_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ], 422);
        }

        $post = Post::create([
            'post_title' => $request->post_title,
            'post_description' => $request->post_description,
            'post_text' => $request->post_text,
            'user_id' => $request->user()->id,
            'type_id' => $request->type_id
        ]);

        return response()->json([
            'message' => 'Пост успешно создан.',
            'data' => $post
        ], 200);
    }
    public function getPostData(Request $request){
        $validator = Validator::make($request->all(), [
            'post_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'errors' => $validator->errors()
            ]);
        }
        $post = Post::find($request->post_id);

        if ($post) {
            return response()->json([
                'message' => 'Пост успешно найден',
                'post' => $post
            ], 200);
        } else {
            return response()->json([
                'message' => 'Пост не найден.'
            ]);
        }
    }

    public function deletePost(Request $request){
        $validator = Validator::make($request->all(), [
            'post_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => "Неправильно введены данные.",
                'errors' => $validator->errors()
            ]);
        }
        $post = Post::find($request->post_id);
        if($post){
            if ($post->user_id == $request->user()->id) {
                $post->delete();
                return response()->json([
                    "message"=>"Пост был успешно удалён.",
                    'data' => $post
                ],200);
            }
            else {
                return response()->json([
                    "message"=>"Вы не можете удалить этот пост."
                ],422);
            }
        } else {
            return response()->json([
                "message"=>"Пост не найден."
            ],422);
        }
    }

    public function updatePost(Request $request){
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|integer',
            'post_title' => 'required|min:2|max:300',
            'post_description' => 'min:10|max:500',
            'post_text' => 'required',
            'type_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ]);
        }

        $post = Post::find($request->post_id);
        if($post){
            if ($post->user_id == $request->user()->id){
                $post->update([
                    'post_title' => $request->post_title,
                    'post_description' => $request->post_description,
                    'post_text' => $request->post_text,
                    'type_id' => $request->type_id
                ]);
                return response()->json([
                    "message"=>"Пост был успешно обновлен.",
                    'data' => $post
                ]);
            } else {
                return response()->json([
                    "message"=>"Вы не можете обновлять этот пост."
                ], 402);
            }
        } else {
            return response()->json([
                "message"=>"Пост не найден."
            ], 402);
        }
    }
}
