<?php
/**
 * Authentication Controller
 *
 * Summary of Methods:
 * 1. `__construct(UserService $userService)`: Injects the UserService for handling user-related operations.
 * 2. `UserRegistration(Request $request)`: Validates input data and handles user registration via UserService.
 * 3. `UserLogin(Request $request)`: Validates credentials and returns a JWT token if authentication is successful.
 * 4. `UserLogout(Request $request)`: Logs out the user by clearing the token.
 * 5. `SendOTPCode(Request $request)`: Sends an OTP to the specified email for user authentication.
 * 6. `VerifyUserOTP(Request $request)`: Verifies the provided OTP for the specified email.
 * 7. `ResetUserPassword(Request $request)`: Resets the user's password after OTP verification.
 */

namespace App\Http\Controllers\authentication;

use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Service to handle user-related operations.
     */
    protected $userService;

    /**
     * Constructor to initialize UserService.
     *
     * $userService Injected UserService instance.
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * User Registration Method
     *
     * Handles user registration by validating the request and
     * delegating the logic to the UserService.
     *
     */
    public function UserRegistration(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:30',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|unique:users,phone',
                'address' => 'required|string|max:250',
                'password' => 'required|string|min:4|max:15',
            ]);

            // Delegate the registration logic to the service
            $user = $this->userService->register($validatedData);

            // Return success response
            return response()->json([
                'status' => 'success',
                'data' => 'User Registration Successful',
            ], 201);
        } catch (Exception $e) {
            // Return failure response
            return response()->json([
                'status' => 'error',
                'data' => 'User Registration Failed',
            ], 400);
        }
    }

    /**
     * User Login Method
     *
     * Handles user login by validating credentials and
     * returning a JWT token if successful.
     *
     */
    public function UserLogin(Request $request)
    {
        // Retrieve email and password from the request
        $email = $request->input('email');
        $password = $request->input('password');

        // Call UserService to handle login
        $loginResponse = $this->userService->login($email, $password);

        if ($loginResponse['status'] === 'success') {
            $token = $loginResponse['token'];

            // Return success response and attach token as a cookie
            return response()->json([
                'status' => 'success',
                'data' => 'User Login Successful',
                'token' => $token
            ], 200)->cookie('token', $token, time() + (60 * 24 * 30));
        } else {
            // Return failure response if login failed
            return response()->json([
                'status' => 'error',
                'data' => 'User Login Failed',
            ], 401);
        }
    }

    // User Login Method End *********

    // User Logout Method Start***********
    public function UserLogout(Request $request)
    {
        return $this->userService->logout();
    }
    // User Logout Method End***********

    // *******************  User Reset Password Part Start *******************

    //User OTP Send Method***********
   //User OTP Send Method Start ***********
    public function SendOTPCode(Request $request){
        $email=$request->input('email');
        return $this->userService->OtpMail($email);
    }
    // User OTP Send Method End***********

    // User OTP Verify Method***********
    function VerifyUserOTP(Request $request)
    {
        $email = $request->input('email');
        $otp = $request->input('otp');
        return $this->userService->VerifyOtp($email, $otp);
    }
    // User OTP Verify Method End***********

    // User Reset Password Method***********
    public function ResetUserPassword(Request $request)
    {
        $email = $request->header('userEmail');
        $password = $request->input('password');
        return $this->userService->ResetPassword($email, $password, $request);
    }
    // User Reset Password Method End***********
}
