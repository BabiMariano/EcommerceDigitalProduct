<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //Gerando categorias fakes, cada categoria possui uma palavra única
            'nome' => $this->faker->unique()->word,
            'descricao' => $this->faker->text,
        ];
    }
}
