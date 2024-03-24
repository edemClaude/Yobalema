<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'client',
            'chauffeur',
        ];

        foreach ($roles as $role) {
            // Ajoutez un rôle avec un nom donné
            DB::table('roles')->insertGetId([
                'name' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->call(CategorySeeder::class);

        User::factory()->create([
            'nom' => 'Admin',
            'prenom' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('passer123'),
            'role_id' => 1,
            'telephone' => '77 777 77 77',
            'adresse' => 'Adresse Admin',
        ]);

        User::factory(20)->create();

        Vehicule::factory(20)->create();
    }
}
