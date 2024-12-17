<?php

/**
 * DashboardServices
 *
 * This service class provides methods to manage and retrieve data related to user subscriptions
 * for the dashboard. It includes:
 * 1. **UpcomingSubcriptionList**: Retrieves subscriptions with overdue payments.
 * 2. **PaymentMissed**: Retrieves subscriptions with future payment dates but are still pending.
 * 3. **MonthwiseCount**: Provides a monthly breakdown of subscriptions based on their creation date.
 */

namespace App\Services;

use App\Helper\ResponseHelper; // Helper for standardizing API responses
use App\Models\UserSubscription; // Model representing user subscriptions

class DashboardServices
{
    /**
     * Get the list of upcoming subscriptions.
     *
     * Criteria:
     * - Subscriptions where the payment date is **in the past** (`< now()`).
     * - The subscription status is **Pending**.
     * - Results are ordered by the payment date in descending order.
     *
     */
    public function UpcomingSubcriptionList($userId)
    {
        $Subcription = UserSubscription::where('payment_date', '<', now())
            ->where('status', 'Pending')
            ->where('user_id', $userId)
            ->latest('payment_date') // Order by payment_date descending
            ->get();
        // Return the data using the response helper
        return ResponseHelper::Out('success', $Subcription, 200);
    }

    /**
     * Get the list of missed payments.
     *
     * Criteria:
     * - Subscriptions where the payment date is **in the future** (`> now()`).
     * - The subscription status is **Pending**.
     * - Results are ordered by the payment date in descending order.
     *
     */
    public function PaymentMissed($userId)
    {
        $Subcription = UserSubscription::where('payment_date', '>', now())
            ->where('status', 'Pending')
            ->where('user_id', $userId)
            ->latest('payment_date') // Order by payment_date descending
            ->get();

        // Return the data using the response helper
        return ResponseHelper::Out('success', $Subcription, 200);
    }

    /**
     * Get a count of subscriptions grouped by month and year.
     *
     * Criteria:
     * - Groups subscriptions by the `created_at` year and month.
     * - Orders results by year and month in ascending order.
     *
     */
    public function MonthwiseCount($userId)
    {
        $data = UserSubscription::selectRaw('strftime("%Y", created_at) as year, strftime("%m", created_at) as month, COUNT(*) as count')
            ->groupByRaw('strftime("%Y", created_at), strftime("%m", created_at)') // Group by year and month
            ->orderByRaw('strftime("%Y", created_at), strftime("%m", created_at)') // Order by year and month
            ->where('user_id', $userId)
            ->get();

        // Return the grouped data using the response helper
        return ResponseHelper::Out('success', $data, 200);
    }
}
