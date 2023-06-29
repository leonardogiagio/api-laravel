<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    public function testBuscarTodosUsuarios()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        User::factory()->count(5)->create();

        $response = $this->getJson('/api/usuarios');

        $response->assertStatus(200)
            ->assertJsonCount(6); // Verifica se a resposta contém 6 registros de usuários (incluindo o criado com Sanctum)
    }

    public function testBuscarUsuarioPorId()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $usuario = User::factory()->create();

        $response = $this->getJson('/api/usuarios/' . $usuario->id);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id' => $usuario->id,
                'name' => $usuario->name,
                'email' => $usuario->email,
            ]); // Verifica se a resposta contém os dados corretos do usuário com o ID especificado
    }
}
