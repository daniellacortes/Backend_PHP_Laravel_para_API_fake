<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pessoa>
 */
class PessoaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        $tipo = $faker->randomElement(['Cliente', 'Fornecedor', 'Empregado']);

        return [
                'nome' => fake()->name(),
                'email' => fake()->email(),
                'tipo' => $tipo
        ];
    }
}
