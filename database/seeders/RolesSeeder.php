<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = ["staff", "admin"];
        $staff_roles = [
            "name" => $role[mt_rand(0,1)],
        ];

        Role::updateOrCreate($staff_roles);
    
    }
}

// class M {
//         function s(){

//         }
// }

// M

