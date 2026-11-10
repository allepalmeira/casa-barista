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
        // User::factory(10)->create();

        User::factory()->create([
            'nome_usuarios' => 'Administrador',
            'email_usuarios' => 'admin@example.com',
            'nivel_usuarios' => 'ADMINISTRADOR',
        ]);
    }
}
