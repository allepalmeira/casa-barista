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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/sobre', [SobreController::class, 'sobre'])->name('sobre');

Route::get('/cardapio', [CardapioController::class, 'cardapio'])->name('cardapio');
Route::get('/cardapio/categoria/{idCategoria}', [CardapioController::class, 'cardapio'])->name('cardapio.categoria');



Route::get('/evento', [EventoController::class, 'evento'])->name('evento');
Route::get('/contato', [ContatoController::class, 'contato'])->name('contato');

//Estrutura para a área administrativa
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/banner', [BannerController::class, 'index'])->name('admin.banner.index');
Route::get('/admin/galeria', [GaleriaController::class, 'index'])->name('admin.galeria.index');
Route::get('/admin/produto', [ProdutoController::class, 'index'])->name('admin.produto.index');
Route::get('/admin/categoria', [CategoriaController::class, 'index'])->name('admin.categoria.index');
