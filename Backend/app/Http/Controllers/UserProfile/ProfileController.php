<?php
/**
 * Profile Controller
 *
 * Summary of Methods:
 * 1. `__construct(Profile $Profile)`: Injects the Profile service for handling profile operations.
 * 2. `UserProfile(Request $request)`: Retrieves the user's profile based on user ID and email from headers.
 * 3. `UpdateUserInfo(Request $request)`: Updates the user's profile information using data provided in the request.
 */

namespace App\Http\Controllers\UserProfile;

use App\Services\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    protected $Profile;

    /*
     * Constructor to initialize Profile.
     *
     * $Profile Injected Profile instance.
     */
    public function __construct(Profile $Profile)
    {
        $this->Profile = $Profile;
    }

    // User Profile Method Start ************
    public function UserProfile(Request $request){
        $userId=$request->header('userId');
        $userEmail=$request->header('userEmail');
        return $this->Profile->UserProfile($userId,$userEmail,$request);
    }
    // User Profile Method End ************


    // User Profile Update Method Start ************
   public function UpdateUserInfo(Request $request){
       $userId=$request->header('userId');
       $userEmail=$request->header('userEmail');
       return $this->Profile->UpdateUserInfo($userId,$userEmail,$request);
   }
    // User Profile Update Method End ************


}
