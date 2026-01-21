<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'name' => 'Laravel Conference 2026',
            'date' => now()->addMonths(2),
            'city' => 'Madrid',
            'type' => 'Normal',
            'location' => '123 Main St, Madrid',
            'sponsors' => 'Sponsor A, Sponsor B',
            'image' => 'https://via.placeholder.com/640x480.png/00ff77?text=Event+Image',
        ]);

        Event::create([
            'name' => 'Vue.js Forward',
            'date' => now()->addMonths(3),
            'city' => 'Barcelona',
            'type' => 'Networking',
            'location' => '456 Market St, Barcelona',
            'sponsors' => 'Sponsor C',
            'image' => 'https://via.placeholder.com/640x480.png/00ff77?text=Event+Image',
        ]);

        Event::create([
            'name' => 'Livewire Live',
            'date' => now()->addMonths(4),
            'city' => 'Valencia',
            'type' => 'Normal',
            'location' => '789 Beach Rd, Valencia',
            'sponsors' => null,
            'image' => 'https://via.placeholder.com/640x480.png/00ff77?text=Event+Image',
        ]);
    }
}
