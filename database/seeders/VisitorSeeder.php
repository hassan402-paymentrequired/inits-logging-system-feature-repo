<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Create sample visitors
          for ($i = 1; $i <= 50; $i++) {
            Visitor::create([
                'name' => 'Visitor ' . $i, // Unique name
                'phone_number' => '090404746' . str_pad($i, 2, '0', STR_PAD_LEFT), // Unique phone number
                'purpose_of_visit' => 'Purpose of Visit ' . $i,
                'admin_id' => 2, // Adjust according to your logic
                'staff_id' => 1, // Adjust according to your logic
            ]);
    }}
}
