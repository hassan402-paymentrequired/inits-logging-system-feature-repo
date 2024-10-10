<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;

use function PHPSTORM_META\map;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ["name" => "Staff"],
            ["name" => "Admin"]
        ];

         array_map(fn($role) => Role::updateOrCreate(['name' => $role["name"]], ['name' => $role["name"]]), $roles);    
    }
}


