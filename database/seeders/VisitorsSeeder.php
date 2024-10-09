<?php

namespace Database\Seeders;

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
        visitors::factory(10)->create();
    }
}
