<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Application;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Application::truncate();
        Review::truncate();

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $application1 = Application::factory()->create([
            'user_id'=>$user1->id
        ]);

        $application2 = Application::factory()->create([
            'user_id'=>$user2->id
        ]);

        Review::factory(3)->create([
            'user_id'=>$user1->id,
            'application_id'=>$application2->id
        ]);

        Review::factory(2)->create([
            'user_id'=>$user2->id,
            'application_id'=>$application1->id
        ]);
    }
}
