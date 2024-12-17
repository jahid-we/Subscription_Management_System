<?php
/*
 * UserService Class
 *
 * This class manages user-related business logic such as registration and login.
 *
 * Methods Overview:
 * 1. `register(array $data)`: Register or update a user with the provided data.
 * 2. `login(string $email, string $password)`: Authenticate a user and generate a JWT token.
 * 3. `logout()`: Log out a user by clearing the token.
 * 4. `OtpMail(string $email)`: Send a one-time password (OTP) to the user's email.
 * 5. `VerifyOtp(string $email, string $otp)`: Verify the OTP sent to the user's email and generate a token.
 * 6. `ResetPassword(string $email, string $password)`: Reset the user's password with the provided value.
 */

 namespace App\Services;

 use App\Models\User;
 use App\Mail\OTPMail;
 use App\Helper\JWTToken;
 use Illuminate\Support\Facades\Mail;
 use Exception;

 /**
  * UserService Class
  *
  * This service handles all user-related business logic, including registration,
  * login, OTP handling, and password management.
  */
 class UserService
 {
     /**
      * Register a new user or update an existing one.
      *
      * @param array $data - An associative array containing user details.
      * @return User - The created or updated user instance.
      */
     public function register($data)
     {
         $user = User::updateOrCreate(
             ['email' => $data['email']], // Check by email
             [
                 'name' => $data['name'],       // Update or set name
                 'phone' => $data['phone'],     // Update or set phone
                 'address' => $data['address'], // Update or set address
                 'password' => $data['password'], // Update or set password
             ]
         );

         return $user;
     }

     /**
      * Log in a user by validating their credentials and generating a JWT token.
      *
      * @param string $email - The user's email address.
      * @param string $password - The user's password.
      * @return array - An array containing the login status and token (if successful).
      */
     public function login($email, $password)
     {
         $user = User::where('email', $email)
             ->where('password', $password) // Validate email and password
             ->select('id', 'role')         // Retrieve user ID and role
             ->first();

         if ($user !== null) {
             // Generate JWT token if user credentials are valid
             $token = JWTToken::CreateToken($email, $user->id, $user->role);
             return [
                 'status' => 'success',
                 'token' => $token,
             ];
         }

         // Return error if credentials are invalid
         return [
             'status' => 'error',
             'data' => 'User Login Failed',
         ];
     }

     /**
      * Log out the user by clearing their token.
      *
      * @return \Illuminate\Http\Response - Redirects to home and clears the token cookie.
      */
     public function logout()
     {
         return redirect('/')->cookie('token', '', -1);
     }

     /**
      * Send a one-time password (OTP) to the user's email.
      *
      * @param string $email - The email address to send the OTP to.
      * @return \Illuminate\Http\JsonResponse - Response indicating the status of OTP sending.
      */
     public function OtpMail($email)
     {
         $otp = rand(100000, 999999); // Generate a random 6-digit OTP
         $userExists = User::where('email', $email)->exists(); // Check if email exists

         if ($userExists) {
             Mail::to($email)->send(new OTPMail($otp)); // Send OTP email
             User::where('email', $email)->update(['otp' => $otp]); // Save OTP in the database

             return response()->json([
                 'status' => 'success',
                 'data' => 'OTP Sent Successfully',
             ], 200);
         }

         // Return error if email does not exist
         return response()->json([
             'status' => 'error',
             'data' => 'Email Not Valid',
         ], 404);
     }

     /**
      * Verify the OTP sent to the user's email and generate a token for resetting the password.
      *
      * @param string $email - The email address associated with the OTP.
      * @param string $otp - The OTP entered by the user.
      * @return \Illuminate\Http\JsonResponse - Response indicating the verification status.
      */
     public function VerifyOtp($email, $otp)
     {
         $userExists = User::where('email', $email)->where('otp', $otp)->exists(); // Validate OTP

         if ($userExists) {
             User::where('email', $email)->update(['otp' => '0']); // Clear OTP after successful verification
             $token = JWTToken::CreateTokenForSetPassword($email); // Generate a token for password reset

             return response()->json([
                 'status' => 'success',
                 'data' => 'OTP Verified Successfully',
             ], 200)->cookie('token', $token, 60 * 24 * 30);
         }

         // Return error if OTP is invalid
         return response()->json([
             'status' => 'error',
             'data' => 'OTP Verification Failed',
         ], 400);
     }

     /**
      * Reset the user's password after successful OTP verification.
      *
      * @param string $email - The user's email address.
      * @param string $password - The new password to set.
      * @return \Illuminate\Http\JsonResponse - Response indicating the password reset status.
      */
     public function ResetPassword($email, $password, $request)
     {
         try {
             User::where('email', $email)->update(['password' => $password]); // Update password

             return response()->json([
                 'status' => 'success',
                 'data' => 'Password Reset Successfully',
             ], 200);
         } catch (Exception $e) {
             // Return error if password reset fails
             return response()->json([
                 'status' => 'error',
                 'data' => 'Password Reset Failed',
             ], 403);
         }
     }
 }
