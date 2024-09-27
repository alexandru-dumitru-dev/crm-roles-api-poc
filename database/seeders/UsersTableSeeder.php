<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(50)->create()->each(function ($user) {
            $user->assignRole(RolesEnum::STUDENT);
        });

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ])->assignRole(RolesEnum::ADMIN);


        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
        ])->assignRole(RolesEnum::USER);

        User::factory()->create([
            'name' => 'Trainer',
            'email' => 'trainer@example.com',
        ])->assignRole(RolesEnum::TRAINER);

        User::factory()->create([
            'name' => 'Student',
            'email' => 'student@example.com',
        ])->assignRole(RolesEnum::STUDENT);
    }
}
