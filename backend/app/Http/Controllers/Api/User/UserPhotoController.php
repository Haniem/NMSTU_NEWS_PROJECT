<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPhoto;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
class UserPhotoController extends Controller

{
    public function createUserPhoto(Request $request){
//        $cloudinaryImage = $request->file('user_photo')->storeOnClaudinary();
        $uploadedFileUrl = Cloudinary::upload($request->file('user_photo')->getRealPath())->getSecurePath();
//        $url = $uploadedFileUrl->getSecurePath();
//        $publicId = $uploadedFileUrl->getPublicId();

        return response()->json([
            'url' => $uploadedFileUrl,
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
