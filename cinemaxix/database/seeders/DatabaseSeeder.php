<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'role' => 'admin',
                'username' => 'admin',
                'password' => bcrypt('admin'),
            ],
            [
                'name' => 'User',
                'role' => 'user',
                'username' => 'user',
                'password' => bcrypt('user'),
            ]
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
