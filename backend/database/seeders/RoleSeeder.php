<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vaciar la tabla para un entorno limpio
        DB::table('roles')->delete();

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'attendee']);
        Role::create(['name' => 'speaker']);
        Role::create(['name' => 'sponsor']);
    }
}
