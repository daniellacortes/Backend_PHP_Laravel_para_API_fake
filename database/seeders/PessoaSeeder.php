<?php

namespace Database\Seeders;

use App\Models\Pessoa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pessoa::truncate();

        $faker = \Faker\Factory::create();

        
        for ($i = 0; $i < 10; $i++) {
            Pessoa::create([
                'nome' => $faker->name,
                'email' => $faker->email,
                'tipo' => $faker->randomElements(['Cliente', 'Fornecedor', 'Empregado'])
            ]);
        }
    }
}
