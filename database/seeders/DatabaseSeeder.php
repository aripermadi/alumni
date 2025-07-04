<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\News;
use App\Models\Event;
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
        // User::factory(10)->create();

        // Seeder contoh berita
        News::create([
            'title' => 'Inovasi Baru dalam Penanganan COVID-19',
            'content' => 'Peneliti UNISMA mengembangkan metode baru untuk penanganan pasien COVID-19 yang lebih efektif...',
            'published_at' => now()->subDays(2),
            'user_id' => 1,
            'image' => null,
        ]);
        News::create([
            'title' => 'Fakultas Kedokteran UNISMA Raih Akreditasi A',
            'content' => 'Fakultas Kedokteran UNISMA berhasil meraih akreditasi A dari BAN-PT...',
            'published_at' => now()->subDays(5),
            'user_id' => 1,
            'image' => null,
        ]);

        // Seeder contoh event
        Event::create([
            'title' => 'Seminar Kesehatan Nasional',
            'description' => 'Seminar tentang inovasi kesehatan nasional.',
            'event_date' => now()->addDays(5),
            'location' => 'Aula FK UNISMA',
            'user_id' => 1,
            'image' => null,
        ]);
        Event::create([
            'title' => 'Workshop Penulisan Karya Ilmiah',
            'description' => 'Workshop teknik penulisan karya ilmiah yang baik dan benar.',
            'event_date' => now()->addDays(10),
            'location' => 'Ruang Seminar FK',
            'user_id' => 1,
            'image' => null,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
