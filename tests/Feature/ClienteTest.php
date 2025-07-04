<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Cliente;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    use RefreshDatabase;
    protected array $dadosCliente;

    protected function setUp(): void
    {
        parent::setUp();

        // Dados padrão reutilizáveis para testes
        $this->dadosCliente = [
            'nome' => 'Marcelo Machado',
            'cnpj' => '12.345.678/0001-95',
            'email' => 'marcelo@emailteste.com',
            'telefone' => '(11) 99999-9999',
        ];
    }

        public function test_registerWithCorrectDatas()
    {
        $response = $this->postJson('/clientes', $this->dadosCliente);

        // Simulando resposta como se a API existisse
        $response->assertStatus(status: 200)
                 ->assertJson(value: ['status' => 'pendente']);
    }

    public function test_registerWithIncorrectCNPJ()
    {
        $dadosInvalidos = [...$this->dadosCliente, 'cnpj' => '123456789000'];

        $response = $this->postJson('/clientes', $dadosInvalidos);

        $response->assertStatus(400)
        ->assertJson(['error' => 'The cnpj field format is invalid.']);
           
    }


    public function test_registerClienteWithDuplicatedCNPJ()
    {
        Cliente::factory()->create([
            'cnpj' => $this->dadosCliente['cnpj']
        ]);

        $response = $this->postJson('/clientes', $this->dadosCliente);

        $response->assertStatus(400)
        ->assertJson(['error' => 'The cnpj has already been taken.']);
    }
    

     public function test_ListOfClientsWithNameFilter()
    {
        Cliente::factory()->create(['nome' => 'Marcelo Machado']);

        $response = $this->getJson('/clientes?nome=Machado');

        $response->assertStatus(200)
                 ->assertJsonFragment(['nome' => 'Marcelo Machado']);
    }
    
    public function test_ClientApprove()
    {
        $cliente = Cliente::factory()->create();

        $response = $this->postJson("/clientes/{$cliente->id}/aprovar");

        $response->assertStatus(200)
        ->assertJson(['status' => 'aprovado']);

        $this->assertDatabaseHas('clientes', [
            'id' => $cliente->id,
            'status' => 'aprovado',
        ]);
    }


    public function test_CriarClienteNoBancoDeDados(): void 
    {
       $cliente = Cliente::factory()->create([
        'nome' => 'MARCELO',
        'cnpj' => '11.222.333/0001-44'
       ]);

       $this->assertDatabaseHas('clientes', [
        'nome' => 'MARCELO'
       ]);
    }

    
}
