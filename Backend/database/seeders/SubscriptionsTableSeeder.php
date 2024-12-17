<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserSubscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserSubscription::create([
            'name' => 'Monthly Subscription',
            'type' => 'Monthly',
            'fee' => 9.99,
            'due_date' => now()->addMonth(),
            'user_id' => 1,
            'status' => 'Completed',
            'payment_date' => now()
        ]);
        UserSubscription::create([
            'name' => 'Yearly Subscription',
            'type' => 'Yearly',
            'fee' => 99.99,
            'due_date' => now()->addYear(),
            'user_id' => 1,
            'status' => 'Pending',
            'payment_date' => now()
        ]);
        UserSubscription::create([
            'name' => 'Custom Subscription',
            'type' => 'Custom',
            'fee' => 49.99,
            'due_date' => now()->addDays(30),
            'user_id' => 1,
            'status' => 'Completed',
            'payment_date' => now()
        ]);
    }
}
