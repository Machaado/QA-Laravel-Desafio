<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SolicitacaoCredito>
 */
class SolicitacaoCreditoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente_id' => Cliente::factory(),
            'valor' => $this->faker->randomFloat(2,1000,10000),
            'status' => 'pendente',
        ];
    }
}
