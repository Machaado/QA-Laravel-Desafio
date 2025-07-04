<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'cnpj' => $this->gerarCnpjValido(),
            'email' => $this->faker->unique()->safeEmail(),
            'telefone' => $this->faker->phoneNumber(),
            'status' => 'pendente', // valor padrão, pode ser sobrescrito no teste
        ];
    }

    protected function gerarCNPJValido(): string {
        return $this->faker->numerify('##.###.###/0001-##');
    }
}
