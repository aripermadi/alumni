<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\EventImage;

class EventImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil event yang sudah ada
        $events = Event::all();
        
        foreach ($events as $event) {
            // Tambahkan beberapa gambar contoh untuk setiap event
            $sampleImages = [
                [
                    'image_path' => 'events/sample1.jpg',
                    'caption' => 'Foto kegiatan utama event'
                ],
                [
                    'image_path' => 'events/sample2.jpg',
                    'caption' => 'Foto dokumentasi peserta'
                ],
                [
                    'image_path' => 'events/sample3.jpg',
                    'caption' => 'Foto suasana acara'
                ]
            ];
            
            foreach ($sampleImages as $index => $imageData) {
                EventImage::create([
                    'event_id' => $event->id,
                    'image_path' => $imageData['image_path'],
                    'caption' => $imageData['caption'],
                    'order' => $index,
                ]);
            }
        }
    }
}
