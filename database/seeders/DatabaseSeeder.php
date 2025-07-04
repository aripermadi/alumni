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
       

        // Seeder contoh alumni
        $user1 = \App\Models\User::firstOrCreate([
            'email' => 'alumni1@example.com'
        ], [
            'name' => 'Alumni Satu',
            'password' => bcrypt('password'),
            'role' => 'alumni',
        ]);
        $user2 = \App\Models\User::firstOrCreate([
            'email' => 'alumni2@example.com'
        ], [
            'name' => 'Alumni Dua',
            'password' => bcrypt('password'),
            'role' => 'alumni',
        ]);
        Alumni::create([
            'user_id' => $user1->id,
            'angkatan' => '2015',
            'jurusan' => 'Kedokteran',
            'pekerjaan' => 'Dokter Umum',
            'alamat' => 'Jl. Mawar No. 1',
            'no_hp' => '081234567890',
            'foto' => null,
        ]);
        Alumni::create([
            'user_id' => $user2->id,
            'angkatan' => '2017',
            'jurusan' => 'Kedokteran',
            'pekerjaan' => 'Peneliti',
            'alamat' => 'Jl. Melati No. 2',
            'no_hp' => '081298765432',
            'foto' => null,
        ]);

        ForumCategory::insert([
            ['nama' => 'Umum', 'slug' => 'umum', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Lowongan', 'slug' => 'lowongan', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Event', 'slug' => 'event', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Tips & Pengalaman', 'slug' => 'tips-pengalaman', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Teknologi', 'slug' => 'teknologi', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
