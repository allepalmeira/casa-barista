<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome_usuarios' => fake()->name(),
            'email_usuarios' => fake()->unique()->safeEmail(),
            // O cast 'hashed' do model já criptografa a senha.
            'senha_usuarios' => 'password',
            'foto_usuarios' => '',
            'nivel_usuarios' => 'ATENDENTE',
            'status_usuarios' => 'ATIVO',
        ];
    }
}
