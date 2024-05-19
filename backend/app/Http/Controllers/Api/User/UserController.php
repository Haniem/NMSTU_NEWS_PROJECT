<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function updateUserData(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'surname' => 'required|min:2|max:100',
            'lastname' => 'max:100',
            'username' => 'alpha:ascii|required|unique:users',
            'email' => 'required|unique:users|email',
            'specialization_id' => 'required',
            'position_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ], 422);
        }
        $user = User::where('id', $request->user()->id)->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'specialization_id' => $request->specialization_id,
            'position_id' => $request->position_id
        ]);
        return response()->json([
            'message' => 'Информация о пользователе успешно обновлена.',
            'data' => $user
        ], 200);
    }

    public function getUserLikedPosts(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ], 422);
        }

        $validSortFields = ['updated_at'];
        $validSortOrders = ['asc', 'desc'];

        $sort_by = in_array($request->query('sort_by'), $validSortFields) ? $request->query('sort_by') : 'updated_at';
        $sort_order = in_array($request->query('sort_order'), $validSortOrders) ? $request->query('sort_order') : 'asc';

        $likes = Like::with('post')->where('user_id', $request->user_id)->orderBy($sort_by, $sort_order)->get();
        if($likes){
            return response()->json([
                'message' => 'Понравившиеся посты пользователя успешно получены.',
                'message' => $likes
            ], 200);
        } else {
            return response()->json([
                'message' => 'Пользователь не ответил как "Мне нравится" ни одного поста.',
                'user_id' => $request->user_id
            ], 402);
        }
    }

    public function getProfileData(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::all()->where('id', $request->user_id)->first();
        if ($user) {
            return response()->json([
                'message' => 'Информация о пользователе успешно получена.',
                'user' => $user
            ], 200);
        } else {
            return response()->json([
                'message' => 'Пользователь не найден',
                'user' => $user
            ], 402);
        }
    }

    public function getUserPosts(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные.',
                'errors' => $validator->errors()
            ], 422);
        }

        $validSortFields = ['id', 'post_title', 'created_at', 'updated_at'];
        $validSortOrders = ['asc', 'desc'];

        $sort_by = in_array($request->query('sort_by'), $validSortFields) ? $request->query('sort_by') : 'updated_at';
        $sort_order = in_array($request->query('sort_order'), $validSortOrders) ? $request->query('sort_order') : 'asc';

        $posts = Post::where('user_id',$request->user_id)->orderBy($sort_by, $sort_order)->get();
        if($posts){
            return response()->json([
                'message' => 'Посты пользователя успешно получены.',
                'data' => $posts
            ], 200);
        } else {
            return response()->json([
                'message' => 'Этот пользователь еще не создал ни одного поста.',
                'user_id' => $request->user_id
            ], 402);
        }
    }

    public function updateUserPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password'=>'required',
            'password_confirmation'=>'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Неправильно введены данные',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::find($request->user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            if (!$request->old_password == $request->password){
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
                return response()->json([
                    'message' => 'Пароль был успешно изменен',
                    'data' => $user
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Старый пароль совпадает с новым'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Неправильно введет старый пароль'
            ]);
        }
    }
}
