<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            StateSeeder::class,
            CategoryTableSeeder::class,
            CompanyTableSeeder::class,
            ProductSeeder::class,
            EventsSeeder::class,
            BlogsSeeder::class,
            JobsTableSeeder::class,
            ForumSeeder::class,
            DealSeeder::class,
            RateReviewSeeder::class,
            RequirementTableSeeder::class
        ]);
    }
}
