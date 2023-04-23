<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Street;
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
        $this->call([
            LinkSeeder::class,
            VideoSeeder::class,
            AnnouncementSeeder::class,
            UserSeeder::class,
            StreetSeeder::class,
            HouseholdSeeder::class,
            ResidentSeeder::class,
        ]);
        \App\Models\Certificate::factory(100)->create();
        // \App\Models\Household::factory(850)->create();
        // \App\Models\Resident::factory(2500)->create();
    }
}
