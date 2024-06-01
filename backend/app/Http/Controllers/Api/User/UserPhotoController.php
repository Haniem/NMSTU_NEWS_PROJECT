<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPhoto;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use GuzzleHttp\Client;
class UserPhotoController extends Controller

{
    public function createUserPhoto(Request $request){
        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $client = new Client([
            'base_uri' => 'https://api.cloudinary.com/v1_1/your_cloud_name/',
            'verify' => false, // Игнорирование проверки SSL
        ]);

        $response = $client->post('image/upload', [
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => fopen($request->file('image')->getRealPath(), 'r')
                ],
                [
                    'name'     => 'upload_preset',
                    'contents' => 'your_upload_preset'
                ],
                [
                    'name'     => 'api_key',
                    'contents' => env('CLOUDINARY_API_KEY')
                ],
                [
                    'name'     => 'api_secret',
                    'contents' => env('CLOUDINARY_API_SECRET')
                ],
            ],
        ]);

        $body = json_decode((string) $response->getBody(), true);

        return response()->json([
            'url' => $body['secure_url']
        ]);

        $userPhoto = UserPhoto::where('user_id', $request->user()->id)->first();
        if ($userPhoto) {
            $userPhoto  = UserPhoto::update([
                'user_id' => $request->user()->id,
                'photo_name' => $userPhoto->photo_name,
                'state' => '1'
            ]);
        } else {
            $userPhoto = UserPhoto::create([
                'user_id' => $request->user()->id,
                'photo_name' => $userPhoto->photo_name,
                'state' => '1'
            ]);
        }
    }

    public function getUserPhoto(Request $request){

    }

    public function updateUserPhoto(Request $request){

    }

    public function deleteUserPhoto(Request $request){

    }
}
