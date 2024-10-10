<?php

namespace Database\Seeders;

use App\Models\VisitorHistories;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;

class VisitorHistoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $visitors_history = [
            "visitor_id" => 1,
            "check_in_time" => now(),
            "check_out_time" => now(),
            "duration_time" => now()
        ];
        VisitorHistories::updateOrCreate($visitors_history);
    }
}
