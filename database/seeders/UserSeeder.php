<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        User::create([
            'name' => 'secretary account',
            'email' => 'secretary@server.com',
            'password' => bcrypt('secretary'),
            'email_verified_at' => now(),
            'user_type' => 0
        ]);
        User::create([
            'name' => 'profiling account',
            'email' => 'profiling@server.com',
            'password' => bcrypt('profiling'),
            'email_verified_at' => now(),
            'user_type' => 1
        ]);
        User::create([
            'name' => 'announcements account',
            'email' => 'announcements@server.com',
            'password' => bcrypt('announcements'),
            'email_verified_at' => now(),
            'user_type' => 2
        ]);
        User::create([
            'name' => 'forms account',
            'email' => 'forms@server.com',
            'password' => bcrypt('forms'),
            'email_verified_at' => now(),
            'user_type' => 3
        ]);
    }
}
