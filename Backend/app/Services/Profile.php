<?php
/*
 * Profile Class
 *
 * This class manages Profile-related business logic such as Check Profile,Update Profile.
 *
 * Methods Overview:
 * 1.UserProfile($userId, $userEmail, $request): Retrieves the profile information of a user based on their ID and email.
 * 2.UpdateUserInfo($userId, $userEmail, $request): Updates or creates user profile information based on provided data.
 *
 */

namespace App\Services;

use App\Models\User;
use Exception;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;


class Profile{
    // User Profile Method Start ************
    public function UserProfile($userId,$userEmail,$request){
    try{
        $user=User::find($userId);
        if($user){
           $data= User::where('email',$userEmail)
            ->get();
            return ResponseHelper::Out('success', $data, 200);
        }
    }catch(Exception $e){
        return ResponseHelper::Out('error', 'Profile Information Not Found', 500);
    }

    }

    // User Profile Method End ************

    // User Profile Update Method Start ************
    public function UpdateUserInfo($userId,$userEmail,$request){
        try{
            $user=User::find($userId);
            if (!$user) {
                return ResponseHelper::Out('error', 'User Not Found', 404);
            }
            if($user){
                $userInfo = User::updateOrCreate(
                    ['id' => $userId], // Match based on user_id
                    [
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'phone' => $request->input('phone'),
                        'address' => $request->input('address'),
                        'password' => $request->input('password')
                    ]
                );
                return ResponseHelper::Out('success', 'User Information Updated', 200);
            }
        }catch(Exception $e){
            return ResponseHelper::Out('error', 'User Information Not Updated', 500);
        }
    }
    // User Profile Update Method End ************
}
