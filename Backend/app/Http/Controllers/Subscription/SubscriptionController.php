<?php
/**
 * Subscription Controller
 *
 * Summary of Methods:
 * 1. `__construct(Subscription $Subscription)`: Injects the Subscription service for handling subscription operations.
 * 2. `SubscriptionCreate(Request $request)`: Handles the creation of a new subscription for the user.
 * 3. `SubscriptionList(Request $request)`: Retrieves a list of all subscriptions for the user.
 * 4. `SubscriptionListByIdOrUser(Request $request)`: Retrieves subscriptions by user ID or specific subscription ID.
 * 5. `SubscriptionUpdate(Request $request)`: Updates an existing subscription for the user.
 * 6. `SubscriptionDelete(Request $request)`: Deletes a subscription for the user.
 */

namespace App\Http\Controllers\Subscription;

use Illuminate\Http\Request;
use App\Services\Subscription;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    protected $Subscription;

    /*
     * Constructor to initialize Subscription.
     *
     * @param Subscription $subscription Injected Subscription instance.
     */
    public function __construct(Subscription $Subscription)
    {
        $this->Subscription = $Subscription;
    }

    // Subscription Create Method Start ************
    public function SubscriptionCreate(Request $request)
    {
        $userId = $request->header('userId');
        $userEmail = $request->header('userEmail');
        return $this->Subscription->subscriptionCreate($userId, $userEmail, $request);
    }
    // Subscription Create Method End ************

    // Subscription List Method Start ************
    public function SubscriptionListByID(Request $request, $sub_id)
    {
        $userId = $request->header('userId');
        return $this->Subscription->userSubscriptionListByID($sub_id, $userId);
    }
    // Subscription List Method End ************

    // Subscription List Method Start ************
    public function SubscriptionList(Request $request)
    {
        $userId = $request->header('userId');
        $userEmail = $request->header('userEmail');
        return $this->Subscription->subscriptionList($userId, $userEmail, $request);
    }
    // Subscription List Method End ************


    // Subscription List By Id Or User Method Start **************
    public function SubscriptionListByIdOrUser(Request $request)
    {
        $userId = $request->header('userId');
        $userEmail = $request->header('userEmail');
        return $this->Subscription->userSubscriptionList($userId, $userEmail, $request);
    }
    // Subscription List By Id Or User Method End **************

    // Subscription Update Method Start ************
    public function SubscriptionUpdate(Request $request)
    {
        $userId = $request->header('userId');
        $userEmail = $request->header('userEmail');
        return $this->Subscription->subscriptionUpdate($userId, $userEmail, $request);
    }
    // Subscription Update Method End ************

    // Subscription Delete Method Start ************
    public function SubscriptionDelete(Request $request)
    {
        $userId = $request->header('userId');
        $userEmail = $request->header('userEmail');
        return $this->Subscription->subscriptionDelete($userId, $userEmail, $request);
    }
    // Subscription Delete Method End ************
}
