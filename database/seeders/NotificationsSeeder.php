<?php

namespace Database\Seeders;

use App\Models\Notifications;
use App\Models\User;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fake = faker::create();
        //
      $notification =  [
            "content" => $fake->sentence(),
            "owner_id" => 1,
            "is_read" => 0,
      ];
        Notifications::updateOrCreate($notification);
    }
}
