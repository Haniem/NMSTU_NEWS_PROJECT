<?php

namespace App\Http\Controllers\Api\Faculties;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Faculty;

class FacultyController extends Controller
{
    public function createPosition(Request $request){
        $validator = Validator::make($request->all(), [
            'faculty_name' => 'required|min:2|max:300',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ], 422);
        }

        $faculty = Faculty::create([
            'position_name' => $request->faculty_name,
        ]);

        return response()->json([
            'message' => 'Факультет успешно добавлена.',
            'data' => $faculty
        ], 200);
    }

    public function deletePosition(Request $request){
        $validator = Validator::make($request->all(), [
            'faculty_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => "Неправильно введены данные.",
                'errors' => $validator->errors()
            ]);
        }
        $faculty = Faculty::find($request->faculty_id);
        if($faculty){
                $faculty->delete();
                return response()->json([
                    "message"=>"Факультет была успешно удалён.",
                    'data' => $faculty
                ],200);
        } else {
            return response()->json([
                "message"=>"Факультет не найден."
            ],422);
        }
    }
}