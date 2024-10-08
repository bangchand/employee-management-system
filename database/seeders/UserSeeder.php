<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Manager',
                'email' => 'manager@example.com',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'company_id' => 1,
            ],
            [
                'name' => 'Manager1',
                'email' => 'manager1@example.com',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'company_id' => 2,
            ],
            [
                'name' => 'Employee User',
                'email' => 'employee@example.com',
                'password' => Hash::make('password'),
                'role' => 'employee',
                'company_id' => 1,
            ],
            [
                'name' => 'Employee 2',
                'email' => 'employee2@example.com',
                'password' => Hash::make('password'),
                'role' => 'employee',
                'company_id' => 1,
            ],
            [
                'name' => 'Employee 3',
                'email' => 'employee3@example.com',
                'password' => Hash::make('password'),
                'role' => 'employee',
                'company_id' => 2,
            ],
            [
                'name' => 'Employee 4',
                'email' => 'employee4@example.com',
                'password' => Hash::make('password'),
                'role' => 'employee',
                'company_id' => 2,
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
                'company_id' => $userData['company_id'],
            ]);

            // Assign role if Spatie Laravel Permission is used
            if (isset($userData['role'])) {
                $user->assignRole($userData['role']);
            }
        }
    }
}
