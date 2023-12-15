<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Produto;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // O model relacionado ao policy
        'App\Models\Produto' => 'App\Policies\ProdutoPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // responsavel por mostrar os detalhes do produto, apenas se o id do user auth for o mesmo id do user que cadastrou o produto 
        // define(nome-da constante que será chamada no SiteController.details, função que recebe o model user e produto )
        Gate::define('ver-produto', function(User $user, Produto $produto){
            // irá retorna um boll, true p/ se o id do user auth for igual ao id do user que cadastrou o produto
            return $user->id === $produto->id_user;
        });

        //
    }
}
