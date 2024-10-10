<?php

namespace Database\Seeders;

use App\Models\Visitor;
use App\Models\visitors;
use Database\Factories\VisitorsFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisitorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $visitor = [
            "name" => 1,
            "phone_number" => "+234 **** **** ***",
            "purpose_of_visit" => "for money",
            "admin_id" => 1,
            "staff_id" => 1,
        ];
        Visitor::updateOrCreate($visitor);
    }
}
