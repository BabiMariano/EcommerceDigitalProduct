<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Informar as class do seeders que serão executados
        $this->call([
            // irá carregar todas as classes que foram criadas no seeder especificado, ao executar o db:seed
            UsersSeeder::class,
            CategoriasSeeder::class,
            ProdutosSeeder::class,
        ]);
    }
}
