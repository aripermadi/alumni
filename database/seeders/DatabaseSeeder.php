<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\News;
use App\Models\Event;
use App\Models\Alumni;
use App\Models\ForumCategory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       


        // Seed event images
        $this->call(EventImageSeeder::class);
    }
}
