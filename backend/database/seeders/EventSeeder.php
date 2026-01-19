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
            'title' => 'Laravel Conference 2026',
            'description' => 'A deep dive into the Laravel ecosystem.',
            'start_date' => now()->addMonths(2),
            'end_date' => now()->addMonths(2)->addDays(2),
            'city' => 'Madrid',
        ]);

        Event::create([
            'title' => 'Vue.js Forward',
            'description' => 'The future of the progressive JavaScript framework.',
            'start_date' => now()->addMonths(3),
            'end_date' => now()->addMonths(3)->addDays(1),
            'city' => 'Barcelona',
        ]);

        Event::create([
            'title' => 'Livewire Live',
            'description' => 'Build dynamic interfaces without leaving PHP.',
            'start_date' => now()->addMonths(4),
            'end_date' => now()->addMonths(4),
            'city' => 'Valencia',
        ]);
    }
}
