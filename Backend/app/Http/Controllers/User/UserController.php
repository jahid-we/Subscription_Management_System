<?php
/*
 * User Controller
 *
 * Summary of Methods:
 * 1. `__construct(UserControllerService $userDelete)`: Injects the UserControllerService for handling user-related operations, such as deletion.
 * 2. `deleteUser(Request $request)`: Handles the deletion of a user by invoking the UserControllerService to delete the user based on the provided user ID and email.
 */

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserControllerService;

class UserController extends Controller
{

    /*
     * Service instance to manage user deletion logic.
    */
    protected $userDelete;

    public function __construct(UserControllerService $userDelete)
    {
        $this->userDelete = $userDelete;
    }

    /*
     * Constructor to initialize UserController with UserControllerService.
     *
     * @param UserControllerService $userDelete Injected service for user deletion operations.
     */

    // USer Delete Method Start ********************
    public function deleteUser(Request $request)
    {
        $userId = $request->header('userId');
        $userEmail = $request->header('userEmail');
        return $this->userDelete->userDelete($userId, $userEmail, $request);
    }
    // USer Delete Method End ********************

}
