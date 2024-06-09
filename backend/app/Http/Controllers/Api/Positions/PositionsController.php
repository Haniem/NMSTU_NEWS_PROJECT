<?php

namespace App\Http\Controllers\Api\Positions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Position;

class PositionController extends Controller
{
    public function createPosition(Request $request){
        $validator = Validator::make($request->all(), [
            'position_name' => 'required|min:2|max:300',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ], 422);
        }

        $position = Position::create([
            'position_name' => $request->specialization_name,
        ]);

        return response()->json([
            'message' => 'Должность успешно добавлена.',
            'data' => $position
        ], 200);
    }

    public function deletePosition(Request $request){
        $validator = Validator::make($request->all(), [
            'position_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => "Неправильно введены данные.",
                'errors' => $validator->errors()
            ]);
        }
        $position = Position::find($request->post_id);
        if($position){
                $position->delete();
                return response()->json([
                    "message"=>"Позиция была успешно удалён.",
                    'data' => $position
                ],200);
        } else {
            return response()->json([
                "message"=>"Специальность не найден."
            ],422);
        }
    }
}
