<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        for ($i = 1; $i <= 3; $i++) {
            User::create([
                "name" => "User $i",
                "email" => "user$i@gmail.com",
                "email_verified_at" => now(),
                "password" => Hash::make("user$i@gmail.com"),
            ]);
        }

        Message::create([
            "user_id" => 1,
            "to_user" => 2,
            "message" => "Halo user 2"
        ]);

        Message::create([
            "user_id" => 2,
            "to_user" => 1,
            "message" => "Halo user 1"
        ]);

        Message::create([
            "user_id" => 2,
            "to_user" => 3,
            "message" => "Halo user 3"
        ]);

        Message::create([
            "user_id" => 3,
            "to_user" => 2,
            "message" => "Halo user 2"
        ]);
    }
}
