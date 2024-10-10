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
            UserSeeder::class,
            NotificationsSeeder::class,
            VisitorsSeeder::class,
            VisitorHistoriesSeeder::class,
            StaffCheckInsSeeder::class,
        ]);
    }
}
