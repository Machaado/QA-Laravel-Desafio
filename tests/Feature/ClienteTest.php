<?php

namespace Tests\Feature;


use Tests\TestCase;

class ClienteTest extends TestCase
{
    
    public function test_registerWithCorrectDatas()
    {
        $response = $this->postJson('/api/clientes', [
            'nome' => 'Marcelo Machado',
            'cnpj' => '12.345.678/0001-95',
            'email' => 'marcelo@emailteste.com',
            'telefone' => '(11) 99999-9999',
        ]);

        // Simulando resposta como se a API existisse
        $response->assertStatus(201)
                 ->assertJson(['status' => 'pendente']);
    }



    public function test_registerWithIncorrectCNPJ()
    {
        $response = $this->postJson('/api/clientes', [
            'nome' => 'Marcelo Machado',
            'cnpj' => '12345678900000',
            'email'=> 'marcelo@emailteste.com',
            'telefone'=> '(11) 99999-9999'
        ]);

        $response -> assertStatus(422) 
                  -> assertJson(['error'=> 'CNPJ Inválido']);
           
    }


    public function test_registerClienteWithDuplicatedCNPJ()
    {
        $this->postJson('/api/clientes', [
            'nome' => 'Cliente 1',
            'cnpj' => '12.345.678/0001-95',
            'email' => 'cliente1@teste.com',
            'telefone' => '(11) 99999-9999',
        ]);


        $response = $this->postJson('/api/clientes', [
            'nome' => 'Cliente 2',
            'cnpj' => '12.345.678/0001-95', // mesmo CNPJ da conta criada acima.
            'email' => 'cliente2@teste.com',
            'telefone' => '(11) 88888-8888',
        ]);

        $response->assertStatus(409)
                 ->assertJson(['error' => 'CNPJ já cadastrado']);
    }
    

     public function test_ListOfClientsWithNameFilter()
    {
        $response = $this->getJson('/api/clientes?nome=Machado');

        $response->assertStatus(200)
                 ->assertJsonFragment(['nome' => 'Marcelo Machado']);
    }
    
    public function test_ClientApprove()
    {
        $response = $this->postJson('/api/clientes/1/aprovar');

        $response->assertStatus(200)
                 ->assertJson(['status' => 'aprovado']);
    }
    


}
