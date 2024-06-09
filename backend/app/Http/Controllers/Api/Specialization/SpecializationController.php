<?php

namespace App\Http\Controllers\Api\Specialization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Specialization;

class SpecializationController extends Controller
{
    public function addSpecialization(Request $request){
        $validator = Validator::make($request->all(), [
            'specialization_name' => 'required|min:2|max:300',
            'acronym' => 'required|min:2|max:15',
            'faculty_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ], 422);
        }

        $specialization = Specialization::create([
            'specialization_name' => $request->specialization_name,
            'acronym' => $request->acronym,
            'faculty_id' => $request->faculty_id,
        ]);

        return response()->json([
            'message' => 'Специальность успешно добавлена успешно создан.',
            'data' => $specialization
        ], 200);
    }

    public function deleteSpecialization(Request $request){
        $validator = Validator::make($request->all(), [
            'specialization_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => "Неправильно введены данные.",
                'errors' => $validator->errors()
            ]);
        }
        $specialization = Specialization::find($request->post_id);
        if($specialization){
            if ($specialization->user_id == $request->user()->id) {
                $specialization->delete();
                return response()->json([
                    "message"=>"Специальность была успешно удалён.",
                    'data' => $specialization
                ],200);
            }
            else {
                return response()->json([
                    "message"=>"Вы не можете удалить эту специальность."
                ],422);
            }
        } else {
            return response()->json([
                "message"=>"Специальность не найден."
            ],422);
        }
    }
}