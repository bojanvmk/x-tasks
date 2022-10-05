<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Task;
use App\Models\TaskStatus;
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

        $users = User::factory()->createMany([
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

        TaskStatus::factory()->createMany([
            [
                'name' => 'opened',
            ],
            [
                'name' => 'completed',
            ],
            [
                'name' => 'cancelled',
            ]
        ]);

        $tasks = Task::factory()->count(10)->create();

        /** @var Task $task */
        foreach ($tasks as $task) {
            $task->users()->attach($users->random()->getKey());
        }
    }
}
