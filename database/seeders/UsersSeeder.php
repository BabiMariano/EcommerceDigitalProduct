<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inserindo dados no bd
        // User::create([
        //     'firstName' => 'Ana',
        //     'lastName' => 'silva',
        //     'email' => 'ana@teste.com',
        //     'password' => bcrypt('12345'),
        // ]);

        User::factory(10)->create();

    }
}
