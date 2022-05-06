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
                'çompany_id' => null,
            ],
            [
                'name' => 'Requestor',
                'email' => 'requestor@gmail.com',
                'password' => '$2y$10$c8pyZHE7LmzF6IAR9rqO8u4zVLSeZGKB5dXGGA5JK9Jh4IG9H6hnG', //m@ster1124
                'role' => 'requestor',
                'çompany_id' => 2,
            ],
            [
                'name' => 'logistic Assistant',
                'email' => 'logistic@gmail.com',
                'password' => '$2y$10$c8pyZHE7LmzF6IAR9rqO8u4zVLSeZGKB5dXGGA5JK9Jh4IG9H6hnG', //m@ster1124
                'role' => 'logistic',
                'çompany_id' => null,
                
            ],
            [
                'name' => 'Purchasing',
                'email' => 'purchasing@gmail.com',
                'password' => '$2y$10$c8pyZHE7LmzF6IAR9rqO8u4zVLSeZGKB5dXGGA5JK9Jh4IG9H6hnG', //m@ster1124
                'role' => 'purchasing',
                'çompany_id' => null,
            ],
            [
                'name' => 'Audit',
                'email' => 'audit@gmail.com',
                'password' => '$2y$10$c8pyZHE7LmzF6IAR9rqO8u4zVLSeZGKB5dXGGA5JK9Jh4IG9H6hnG', //m@ster1124
                'role' => 'audit',
                'çompany_id' => null,
            ],
            [
                'name' => 'Approver1',
                'email' => 'approver1@gmail.com',
                'password' => '$2y$10$c8pyZHE7LmzF6IAR9rqO8u4zVLSeZGKB5dXGGA5JK9Jh4IG9H6hnG', //m@ster1124
                'role' => 'approver',
                'çompany_id' => 2,
            ],
            [
                'name' => 'Approver2',
                'email' => 'approver2@gmail.com',
                'password' => '$2y$10$c8pyZHE7LmzF6IAR9rqO8u4zVLSeZGKB5dXGGA5JK9Jh4IG9H6hnG', //m@ster1124
                'role' => 'approver',
                'çompany_id' => 3,
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$c8pyZHE7LmzF6IAR9rqO8u4zVLSeZGKB5dXGGA5JK9Jh4IG9H6hnG', //m@ster1124
                'role' => 'admin',
                'çompany_id' => null,
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
