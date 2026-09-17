<?php

use App\Http\Controllers\Site\CardapioController;
use App\Http\Controllers\Site\ContatoController;
use App\Http\Controllers\Site\EventoController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\SobreController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\GaleriaController;
use App\Http\Controllers\Admin\ProdutoController;
use App\Http\Controllers\Admin\CategoriaController;
use Illuminate\Support\Facades\Route;


// RORAS WEB
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/sobre', [SobreController::class, 'sobre'])->name('sobre');
Route::get('/cardapio', [CardapioController::class, 'cardapio'])->name('cardapio');
Route::get('/cardapio/categoria/{idCategoria}', [CardapioController::class, 'cardapio'])->name('cardapio.categoria');
Route::get('/evento', [EventoController::class, 'evento'])->name('evento');
Route::get('/contato', [ContatoController::class, 'contato'])->name('contato');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

// RORAS DASHBOARD
Route::prefix('admin')->group(function (){

    

    // CRUD BANNER
    Route::get('/banner', [BannerController::class, 'index'])->name('admin.banner.index'); // Listar Banner
    Route::post('/banner', [BannerController::class, 'store'])->name('admin.banner.store');// Cadastrar Banner
    //Route::get('/banner/{id}/editar', [BannerController::class, 'edit'])->name('admin.banner.edit');// Abrir o form de Editar banner
    Route::put('/banner/{id}', [BannerController::class, 'update'])->name('admin.banner.update');// Atualizar Banner
    Route::patch('/banner/{id}', [BannerController::class, 'status'])->name('admin.banner.status');// Ativar ou Desativar Banner


    // CRUD GALERIA
    Route::get('/galeria', [GaleriaController::class, 'index'])->name('admin.galeria.index');


    // CRUD PRODUTO
    Route::get('/produto', [ProdutoController::class, 'index'])->name('admin.produto.index');


    // CRUD CATEGORIA
    Route::get('/categoria', [CategoriaController::class, 'index'])->name('admin.categoria.index');
});

