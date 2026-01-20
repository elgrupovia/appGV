<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Limpia los usuarios creados por defecto para evitar duplicados.
        User::query()->delete();

        $this->call([
            RoleSeeder::class,
            UserRoleSeeder::class,
            EventSeeder::class,
        ]);
    }
}
