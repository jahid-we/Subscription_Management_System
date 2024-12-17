<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Jahid',
            'email' => 'jahidhasan370919@gmail.com',
            'phone' => '01700000000',
            'address' => '123 Admin Street',
            'password' => '1234',  // Plain text password
            'otp' => '0',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'address' => '456 Maple Avenue',
            'password' => 'password123',  // Plain text password
            'otp' => '234567',
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '9876543210',
            'address' => '789 Oak Street',
            'password' => 'password123',  // Plain text password
            'otp' => '345678',
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Alice Johnson',
            'email' => 'alice@example.com',
            'phone' => '5555555555',
            'address' => '321 Elm Drive',
            'password' => 'password123',  // Plain text password
            'otp' => '456789',
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Bob Williams',
            'email' => 'bob@example.com',
            'phone' => '1111111111',
            'address' => '654 Pine Road',
            'password' => 'password123',  // Plain text password
            'otp' => '567890',
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Charlie Brown',
            'email' => 'charlie@example.com',
            'phone' => '9999959999',
            'address' => '987 Birch Lane',
            'password' => 'password123',  // Plain text password
            'otp' => '678901',
            'role' => 'user',
        ]);
    }
}
