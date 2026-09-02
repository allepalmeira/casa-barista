<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use App\Http\Controllers\Controller;

class CategoriaController extends Controller
{

    public function index(){

        $listaCategorias = Categoria::where('status_categoria', 'ATIVO')
        ->orderBy('nome_categoria')
        ->get();

        return view('admin.categoria.index', compact('listaCategorias'));

    }

}