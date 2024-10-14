<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => "mariam",
                'email' => "mariam@gmail.com",
                'is_active' => mt_rand(0, 1),
                'phone_number' => "+234709493892",
                'role_id' => 2,
                'email_verified_at' => now(),
                'password' =>  Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "tami",
                'email' => "tami@gmail.com",
                'is_active' => mt_rand(0, 1),
                'phone_number' => "+234709494892",
                'role_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "John",
                'email' => "John@gmail.com",
                'is_active' => mt_rand(0, 1),
                'phone_number' => "+234709493892",
                'role_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Deji",
                'email' => "Deji@gmail.com",
                'is_active' => mt_rand(0, 1),
                'phone_number' => "+234709493892",
                'role_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Jane",
                'email' => "Jane@gmail.com",
                'is_active' => mt_rand(0, 1),
                'phone_number' => "+234709493892",
                'role_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Yemi",
                'email' => "Yemi@gmail.com",
                'is_active' => mt_rand(0, 1),
                'phone_number' => "+234709493892",
                'role_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Favour",
                'email' => "Favour@gmail.com",
                'is_active' => mt_rand(0, 1),
                'phone_number' => "+234709493892",
                'role_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Ope",
                'email' => "Ope@gmail.com",
                'is_active' => mt_rand(0, 1),
                'phone_number' => "+234709493892",
                'role_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Victor",
                'email' => "Victor@gmail.com",
                'is_active' => mt_rand(0, 1),
                'phone_number' => "+234709493892",
                'role_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Stanley",
                'email' => "Stanley@gmail.com",
                'is_active' => mt_rand(0, 1),
                'phone_number' => "+234709493892",
                'role_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Charles",
                'email' => "Charles@gmail.com",
                'is_active' => mt_rand(0, 1),
                'phone_number' => "+234709493892",
                'role_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Hassan",
                'email' => "Hassan@gmail.com",
                'is_active' => mt_rand(0, 1),
                'phone_number' => "+234709493892",
                'role_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Oyinda",
                'email' => "Oyinda@gmail.com",
                'is_active' => mt_rand(0, 1),
                'phone_number' => "+234709493892",
                'role_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]
        ];

        array_map(fn($user) => User::updateOrCreate($user), $users);
        
    }
}
