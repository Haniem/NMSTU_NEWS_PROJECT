<?php

namespace App\Http\Controllers\Api\Type;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function getTypes(){
        $types = Type::all();
        return response()->json([
            'message' => 'Разделы постов успешно получены.',
            "types"=>$types
        ],200);
    }
}
