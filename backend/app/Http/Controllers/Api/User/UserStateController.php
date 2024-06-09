<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserStateController extends Controller
{
    public function activeState(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ], 422);
        }

        $user=User::find($request->user_id);

        if ($user){
            {
                $user = User::where('id',$request->user_id)->update([
                    'state'=> 'active'
                ]);
                $user = User::find($request->user_id);
                return response()->json([
                    'message' => 'Статус пользователя успешно обновлен.',
                    "data"=>$user],200);
            }
        } else {
            return response()->json([
                "message" => "Пользователь не найден."
            ]);
        }
    }

    public function bannedState(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ], 422);
        }

        $user=User::find($request->user_id);

        if ($user){
            {
                $user = User::where('id',$request->user_id)->update([
                    'state'=> 'banned'
                ]);
                $user = User::find($request->user_id);
                return response()->json([
                    'message' => 'Статус пользователя успешно обновлен.',
                    "data"=>$user],200);
            }
        } else {
            return response()->json([
                "message" => "Пользователь не найден."
            ]);
        }
    }
}
