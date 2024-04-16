<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    public function getPosts()
    {
        $posts = Post::all();
        return response()->json([
            "posts"=>$posts],200);
    }

    public function createPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_title' => 'required|min:2|max:300',
            'post_description' => 'min:10|max:500',
            'post_text' => 'required',
            'type_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validations fails',
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
            'message' => 'Validations succesfull',
            'data' => $post
        ], 200);
    }
    public function getPostData(Request $request)
    {
        $post = Post::where('id', post_id)->first();
        return response()->json([
            'post' => $post
        ], 200);
    }
    public function deletePost(Request $request)
    {
        $post = Post::find($request->post_id);
        if($post)
        {
            $post->delete();
            return response()->json([
                "message"=>"Post was deleted!"
            ],200);
        }
        else
        {
            return response()->json([
                "message"=>"No such post!"
            ],422);
        }
    }

}
