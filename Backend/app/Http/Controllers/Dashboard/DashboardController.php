<?php

/**
 * DashboardController
 *
 * This controller handles requests related to dashboard data. It delegates logic to the `DashboardServices` class
 * and provides endpoints for:
 * 1. **Upcoming Subscription List**: Subscriptions with overdue payments.
 * 2. **Payment Missed**: Subscriptions with future due dates but pending status.
 * 3. **Month-wise Count**: Monthly breakdown of subscription counts.
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\DashboardServices;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @var DashboardServices Handles the business logic for dashboard-related operations.
     */
    private $Dashboard;
    /**
     * DashboardController constructor.
     *
     * Injects the `DashboardServices` dependency to handle dashboard operations.
     *
     */
    public function __construct(DashboardServices $dashboardServices)
    {
        $this->Dashboard = $dashboardServices;
    }

    /**
     * Handle the request to get a list of upcoming subscriptions.
     *
     */
    public function UpcomingSubcriptionList(Request $request)
    {
        $userId = $request->header('userId');
        return $this->Dashboard->UpcomingSubcriptionList($userId);
    }

    /**
     * Handle the request to get a list of missed payments.
     *
     */
    public function PaymentMissed(Request $request)
    {
        $userId = $request->header('userId');
        return $this->Dashboard->PaymentMissed($userId);
    }

    /**
     * Handle the request to get the count of subscriptions grouped by month and year.
     *
     */
    public function MonthwiseCount(Request $request)
    {
        $userId = $request->header('userId');
        return $this->Dashboard->MonthwiseCount($userId);
    }
}
