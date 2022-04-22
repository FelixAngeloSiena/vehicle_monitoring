<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\UserFactory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Warehouse Manager',
                'email' => 'warehousemanager@gmail.com',
                'password' => '$2y$10$c8pyZHE7LmzF6IAR9rqO8u4zVLSeZGKB5dXGGA5JK9Jh4IG9H6hnG', //m@ster1124
                'role' => 'manager',
            ],
            [
                'name' => 'Requestor',
                'email' => 'requestor@gmail.com',
                'password' => '$2y$10$c8pyZHE7LmzF6IAR9rqO8u4zVLSeZGKB5dXGGA5JK9Jh4IG9H6hnG', //m@ster1124
                'role' => 'requestor',
            ],
            [
                'name' => 'logistic Assistant',
                'email' => 'logistic@gmail.com',
                'password' => '$2y$10$c8pyZHE7LmzF6IAR9rqO8u4zVLSeZGKB5dXGGA5JK9Jh4IG9H6hnG', //m@ster1124
                'role' => 'logistic',
            ],
            [
                'name' => 'Purchasing',
                'email' => 'purchasing@gmail.com',
                'password' => '$2y$10$c8pyZHE7LmzF6IAR9rqO8u4zVLSeZGKB5dXGGA5JK9Jh4IG9H6hnG', //m@ster1124
                'role' => 'purchasing',
            ],
            [
                'name' => 'Audit',
                'email' => 'audit@gmail.com',
                'password' => '$2y$10$c8pyZHE7LmzF6IAR9rqO8u4zVLSeZGKB5dXGGA5JK9Jh4IG9H6hnG', //m@ster1124
                'role' => 'Audit',
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'role' => $user['role'],
            ]);
        }
    }
}
