<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\PasswordVerify;
use App\Http\Middleware\UserVerification;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\authentication\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\UserProfile\ProfileController;
use App\Http\Controllers\Subscription\SubscriptionController;


// POST Routes *********************************
/*
 * User Authentication Route
*/

Route::post('/user-registration', [AuthController::class, 'UserRegistration']);
// User Login Route
Route::post('/user-login', [AuthController::class, 'UserLogin']);
// User OTP Send Route
Route::post('/send-otp', [AuthController::class, 'SendOTPCode']);
// User OTP Verify Route
Route::post('/verify-otp', [AuthController::class, 'VerifyUserOTP']);
// User Reset Password Route
Route::post('/reset-password', [AuthController::class, 'ResetUserPassword'])->middleware([UserVerification::class]);

/*
 * User Profile Route
*/
// User Profile Update Route
Route::post('/user-profile-update', [ProfileController::class, 'UpdateUserInfo'])->middleware([UserVerification::class]);

/*
 * User Subscription Route
*/
// User Subscription Create Route
Route::post('/user-subscription-create', [SubscriptionController::class, 'SubscriptionCreate'])->middleware([UserVerification::class]);
// User Subscription Update Route
Route::post('/user-subscription-update', [SubscriptionController::class, 'SubscriptionUpdate'])->middleware([UserVerification::class]);
// User Subscription Delete Route
Route::post('/user-subscription-delete/{sub_id}', [SubscriptionController::class, 'SubscriptionDelete'])->middleware([UserVerification::class]);





// GET Routes ******************************************
/*
 * User Registration Route
*/
// User Logout Route
Route::get('/user-logout', [AuthController::class, 'UserLogout']);
/*
* User Profile Route
*/
// User Profile Get Route
Route::get('/user-profile-info', [ProfileController::class, 'UserProfile'])->middleware([UserVerification::class]);

/*
 * User Subscription Route
*/
// User Subscription List Route
Route::get('/subscription-list', [SubscriptionController::class, 'SubscriptionList'])->middleware([UserVerification::class]);
// User Subscription List By Id Route
Route::get('/subscription-list-by-id/{id}', [SubscriptionController::class, 'SubscriptionListByID'])->middleware([UserVerification::class]);
// User Subscription List By Id Or User Route
Route::get('/user-subscription-list', [SubscriptionController::class, 'SubscriptionListByIdOrUser'])->middleware([UserVerification::class]);

/*
* Dashboard All Routes
*/

Route::middleware(['user_verify'])->group(function () {
    // Dashboard Route
    Route::get('upcoming-subcription-list', [DashboardController::class, 'UpcomingSubcriptionList']);
    // Dashboard Route
    Route::get('Payment-missed', [DashboardController::class, 'PaymentMissed']);
    // Dashboard Route
    Route::get('Month-wise-Count', [DashboardController::class, 'MonthwiseCount']);
});


// DELETE Routes *********************************
/*
 * User Route
*/
// User Delete Route
Route::delete('/user-delete', [UserController::class, 'deleteUser'])->middleware([UserVerification::class]);
