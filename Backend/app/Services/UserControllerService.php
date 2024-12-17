<?php
/*
 * User Controller Service
 *
 * This class manages user-related business logic, including user deletion.
 *
 * Methods Overview:
 * 1. `userDelete($userId, $userEmail, $request)`: Deletes a user based on their user ID, returning success if the deletion is successful, or an error if the user is not found or an exception occurs.
 */
namespace App\Services;

use App\Models\User;
use Exception;
use App\Helper\ResponseHelper;

class UserControllerService{
    public function userDelete($userId, $userEmail, $request)
    {
        try {
            // Attempt to delete the user by their ID
            $user = User::where('id', $userId)->delete();

            // Return success response if deletion is successful
            if ($user) {
                return ResponseHelper::Out('success', 'User Deleted', 200);
            } else {
                return ResponseHelper::Out('error', 'User Not Found', 404);
            }
        } catch (Exception $e) {
            // Catch and handle any exceptions during deletion
            return ResponseHelper::Out('error', 'User Not Deleted', 500);
        }
    }
}
