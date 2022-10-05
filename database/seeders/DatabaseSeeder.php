<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $roles = Role::factory()->createMany([
            [
                'name' => 'admin',
            ],
            [
                'name' => 'user'
            ]
        ]);

        User::factory()->createMany([
            [
                'name'     => 'Admin',
                'role_id'  => $roles->firstWhere('name', 'admin')->getKey(),
                'email'    => 'a@abc.org',
                'password' => Hash::make('Secret!'),
            ],
            [
                'name'     => 'User',
                'role_id'  => $roles->firstWhere('name', 'user')->getKey(),
                'email'    => 'b@abc.org',
                'password' => Hash::make('Secret!'),
            ],
        ]);
    }
}
