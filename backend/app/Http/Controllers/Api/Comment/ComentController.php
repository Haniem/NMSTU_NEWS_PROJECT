<?php

namespace App\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class ComentController extends Controller
  {
  public function getComments(Request $request)
{
        $comments=Comment::where("post_id", $request -> post_id)->get();
  
        return response()->json([
            "message"=>"Data fetched succesfully"
            "comments"=>$comments],200)
}
    public function getPostComment(Request $request)
    {
        $comments = Comment::where('post_id', $request -> post_id);
      
        return response()->json([
            "comments"=>$comments],200);
    }
}
