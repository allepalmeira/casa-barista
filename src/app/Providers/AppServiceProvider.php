<?php

namespace App\Providers;

use App\Models\Categoria;
use Illuminate\Support\ServiceProvider;
//use Illuminate\View\View;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Carregar um submenu de categoria
        View::composer('partials.site.topo', function ($view){

            $categoriaMenu = Categoria::query()
            ->where('status_categoria', 'ATIVO')
            ->orderBy('nome_categoria')
            ->get();

            //dd($categoriaMenu);

            $view->with('categoriaMenu', $categoriaMenu);

        });
    }
}
