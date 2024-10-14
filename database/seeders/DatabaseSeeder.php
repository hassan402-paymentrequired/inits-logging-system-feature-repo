<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            UserSeeder::class, // Make sure you have a UserSeeder to create users
            VisitorSeeder::class,
            VisitorHistoriesSeeder::class,
            StaffCheckInsSeeder::class,
        ]);
    }
}
