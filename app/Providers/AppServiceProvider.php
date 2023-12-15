<?php

namespace App\Providers;

use App\Models\Categoria;

use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        $categoriasMenu = Categoria::all();
        // C/ a chave categoriaMenu é possivel receperar as categ. de forma dinamica e add em qualquer parte do código
        view()->share('categoriasMenu', $categoriasMenu);
    }
}
