<?php

namespace Database\Seeders;

use App\Models\StaffCheckIns;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffCheckInsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            StaffCheckIns::create([
                'user_id' => $i, 
                'check_in_time' => Carbon::now()->subDays(rand(0, 10))->setTime(rand(8, 10), rand(0, 59)), // Random check-in time within the last 10 days
                'check_out_time' => null
            ]);
        }
    
    }
}
