<?php
/*
 * Subscription Service
 *
 * This class manages Subscription-related business logic, including creation, retrieval, updating, and deletion of subscriptions.
 *
 * Methods Overview:
 * 1. `subscriptionCreate($userId, $userEmail, $request)`: Creates a new subscription for a user.
 * 2. `subscriptionList($userId, $userEmail, $request)`: Lists all subscriptions for a given user, including user information without sensitive data.
 * 3. `userSubscriptionList($userId, $userEmail, $request)`: Retrieves a list of subscriptions filtered by user ID, with selective user fields.
 * 4. `subscriptionUpdate($userId, $userEmail, $request)`: Updates an existing subscription by its ID.
 * 5. `subscriptionDelete($userId, $userEmail, $request)`: Deletes a subscription by its ID.
 */

namespace App\Services;

use Exception;

use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Models\UserSubscription;


class Subscription
{

    // Subscription Create Method Start ************
    public function subscriptionCreate($userId, $userEmail, $request)
    {
        try {
            $subscription = UserSubscription::create([
                'name' => $request->input('name'),
                'type' => $request->input('type'),
                'fee' => $request->input('fee'),
                'due_date' => $request->input('due_date'),
                'user_id' => $userId,
                'status' => $request->input('status'),
                'payment_date' => $request->input('payment_date'),

            ]);
            return ResponseHelper::Out('success', 'Subscription Created', 201);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', 'Subscription Not Created', 500);
        }
    }
    // Subscription Create Method End ************


    // Subscription List Method Start ************
    public function subscriptionList($userId, $userEmail, $request)
    {
    try {
        // Fetch subscriptions with associated user, excluding sensitive fields
        $data = UserSubscription::with(['user' => function ($query) {
            $query->select('id', 'name', 'email', 'phone', 'address'); // Specify only the fields you want
        }])->where('user_id', $userId)->get();

             return ResponseHelper::Out('success', $data, 200);
        }catch (Exception $e) {
             return ResponseHelper::Out('error', 'Subscription Not Found', 500);
    }
    }

    // Subscription List Method End ************


    // Subscription List By Id Or User Method Start **************
    public function userSubscriptionList($userId, $userEmail, $request)
    {
        try {
            $data = UserSubscription::where('user_id', $userId)
                ->with(['user' => function ($query) {
                    $query->select('id', 'name', 'email'); // Explicitly select fields to include
                }])
                ->get();
            return ResponseHelper::Out('success', $data, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', 'Subscription Not Found', 500);
        }
    }

    // Subscription List By Id Or User Method End **************

    // Subscription List By Id Or User Method Start **************
    public function userSubscriptionListByID($sub_id, $userId)
    {
        try {
            $data = UserSubscription::where('id', $sub_id)->where('user_id', $userId)
                ->first();
            return ResponseHelper::Out('success', $data, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', 'Subscription Not Found', 500);
        }
    }

    // Subscription List By Id Or User Method End **************

    // Subscription Update Method Start ************
    public function subscriptionUpdate($userId, $userEmail, $request)
    {
        try {
            $subscription = UserSubscription::where('id', $request->input('id'))->update([
                'name' => $request->input('name'),
                'type' => $request->input('type'),
                'fee' => $request->input('fee'),
                'due_date' => $request->input('due_date'),
                'user_id' => $userId,
                'status' => $request->input('status'),
                'payment_date' => $request->input('payment_date')
            ]);
            return ResponseHelper::Out('success', 'Subscription Updated', 201);
        } catch (Exception $e) {
            return ResponseHelper::Out('error', 'Subscription Not Updated', 500);
        }
    }
    // Subscription Update Method End ************

    // Subscription Delete Method Start ************
    public function subscriptionDelete($sub_id, $userEmail, $request)
    {
    try {
        $deleted = UserSubscription::where('id', $request->sub_id)->delete();

        if ($deleted) {
            return ResponseHelper::Out('success', 'Subscription Deleted', 200);
        } else {
            return ResponseHelper::Out('error', 'No Subscriptions Found to Delete', 404);
        }
    } catch (Exception $e) {
        return ResponseHelper::Out('error', 'Subscription Not Deleted', 500);
    }
    }
    // Subscription Delete Method End ***************
}
