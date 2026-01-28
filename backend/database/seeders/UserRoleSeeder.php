<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vaciar la tabla pivote para un entorno limpio
        DB::table('role_user')->delete();

        // Obtener los roles
        $adminRole = Role::where('name', 'admin')->first();
        $attendeeRole = Role::where('name', 'attendee')->first();
        $speakerRole = Role::where('name', 'speaker')->first();
        $sponsorRole = Role::where('name', 'sponsor')->first();

        // Crear usuario Administrador
        $adminUser = User::create([
            'name' => 'Juan Garcia',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $adminUser->roles()->attach($adminRole);

        // Crear usuario Asistente
        $attendeeUser = User::create([
            'name' => 'Maria Rodriguez',
            'email' => 'attendee@example.com',
            'password' => Hash::make('password'),
        ]);
        $attendeeUser->roles()->attach($attendeeRole);

        // Crear usuario Speaker
        $speakerUser = User::create([
            'name' => 'Carlos Martinez',
            'email' => 'speaker@example.com',
            'password' => Hash::make('password'),
        ]);
        $speakerUser->roles()->attach($speakerRole);

        // Crear usuario Sponsor
        $sponsorUser = User::create([
            'name' => 'Ana Lopez',
            'email' => 'sponsor@example.com',
            'password' => Hash::make('password'),
        ]);
        $sponsorUser->roles()->attach($sponsorRole);
    }
}
