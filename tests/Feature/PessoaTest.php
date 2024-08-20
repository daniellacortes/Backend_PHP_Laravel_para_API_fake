<?php

namespace Tests\Feature;

use App\Models\Pessoa;
use Database\Seeders\PessoaSeeder;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PessoaTest extends TestCase
{
    use RefreshDatabase;

     public function testsStore()
    {
        $faker = Factory::create();

        $nome = $faker->name;
        $email = $faker->email;
        $tipo = $faker->randomElement(['1', '2', '3']);

        $payload = [
            'nome' => $nome,
            'email' => $email,
            'tipo' => $tipo
        ];

        $this->json('POST', '/api/pessoa', $payload)
            ->assertStatus(201)
            ->assertJson([
                'nome' => $nome,
                'email' => $email,
                'tipo' => $tipo
            ]);
    }

    public function testsDestroy()
    {
        $novaPessoa = Pessoa::factory()->create();

        $this->json('DELETE', '/api/pessoa/' . $novaPessoa->id, [])
            ->assertStatus(204);
        $this->assertDatabaseMissing('pessoas', ['id' => $novaPessoa->id,]);
        $this->assertModelMissing($novaPessoa);
    }

    public function testIndex()
    {
        $pessoa1 = Pessoa::factory()->create();

        $pessoa2 = Pessoa::factory()->create();

        $this->json('GET', '/api/pessoa', [])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    ['nome' => $pessoa1->nome, 'email' => $pessoa1->email, 'tipo' => $pessoa1->tipo],
                    ['nome' => $pessoa2->nome, 'email' => $pessoa2->email, 'tipo' => $pessoa2->tipo],
                ]])
            ->assertJsonStructure([
                'data' => [['id', 'nome', 'email', 'tipo', 'created_at', 'updated_at']],
            ]);
    }

    public function testShow()
    {
        $this->seed(PessoaSeeder::class);
 
        $pessoa = Pessoa::factory()->create();

        $this->json('GET', '/api/pessoa/'.$pessoa->id, [])
            ->assertStatus(200)
            ->assertJson(['nome' => $pessoa->nome, 'email' => $pessoa->email, 'tipo' => $pessoa->tipo])
            ->assertJsonStructure(['id', 'nome', 'email', 'tipo', 'created_at', 'updated_at'],
            );
    }

    public function testUpdate()
    {
        $faker = Factory::create();

        $pessoa = Pessoa::factory()->create();

        $nome = $faker->name;
        $email = $faker->email;
        $tipo = $faker->randomElement(['1', '2', '3']);

        $payload = [
            'nome' => $nome,
            'email' => $email,
            'tipo' => $tipo
        ];

        $this->json('PUT', '/api/pessoa/'.$pessoa->id, $payload)
            ->assertStatus(200)
            ->assertJson(['nome' => $nome, 'email' => $email, 'tipo' => $tipo]);
    }
}
