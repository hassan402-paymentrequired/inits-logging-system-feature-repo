<?php

namespace Database\Seeders;

use App\Models\StaffCheckIns;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffCheckInsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staff_check_ins = [
            "user_id" => 1,
            "check_in_time" => now(),
            "check_out_time" => now(),
        ];

        StaffCheckIns::updateOrCreate($staff_check_ins);
    }
}
