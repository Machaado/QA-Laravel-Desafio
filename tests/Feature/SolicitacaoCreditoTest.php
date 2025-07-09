<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Cliente;

class SolicitacaoCreditoTest extends TestCase
{
    use RefreshDatabase;

    public function test_nao_aprova_credito_para_cliente_inadimplente() {
        

        $cliente = Cliente::factory()->create([
            'inadimplente' => true
        ]);

        $response = $this->postJson("/solicitar-credito/{$cliente->id}", [
            'valor' => 5000
        ]);

        $response->assertStatus(422)
        ->assertJson(['error' => 'Cooperado inadimplente']);

    }

    public function test_aprova_credito_para_cliente_em_dia() {

        $cliente = Cliente::factory()->create();

        $response = $this->postJson("/solicitar-credito/{$cliente->id}", [
            'valor' => 3000
        ]);

        $response->assertStatus(200)
        ->assertJson(['status' => 'aprovado']);
    }
}
