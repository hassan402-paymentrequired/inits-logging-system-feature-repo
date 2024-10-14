<?php

namespace Database\Seeders;

use App\Models\Visitor;
use App\Models\VisitorHistories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisitorHistoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Create 50 visitor history records
      for ($i = 1; $i <= 50; $i++) {
        VisitorHistories::create([
            'visitor_id' => Visitor::inRandomOrder()->first()->id, // Random visitor
            'check_in_time' => now()->setHour(10)->setMinute(30)->addDays($i), // Today, 10:30 AM, incrementing by one day
        ]);
    }

    }
}
