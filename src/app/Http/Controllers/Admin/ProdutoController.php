<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use App\Models\Produto;
use App\Http\Controllers\Controller;

class ProdutoController extends Controller
{

    public function index(?int $idCategoria = null){

        $listaCategorias = Categoria::where('status_categoria', 'ATIVO')
        ->orderBy('nome_categoria')
        ->get();

        //SE nenhuma categoria estiver na URL
        if($idCategoria === null){
            $categoriaSelecionada = $listaCategorias->first();
        }else{
            $categoriaSelecionada = $listaCategorias->firstWhere('id_categoria', $idCategoria);
        }

        //Caso não tenha a categoria
        abort_if($categoriaSelecionada === null, 404, 'Categoria não encontada');

        //Buscar somente os produtos relacionado a categoria
        $listaProdutos = Produto::with('categoria')
        ->where('status_produto', 'ATIVO')
        ->orderBy('nome_produto')
        ->get();

        $produtos = Produto::query()
        ->where('id_categoria', $categoriaSelecionada->id_categoria)
        ->where('status_produto', 'ATIVO')
        ->orderBy('nome_produto')
        ->get();

        //dd($produtos);
        //dd($listaCategorias);

        return view('admin.produto.index', compact('listaCategorias', 'listaProdutos', 'produtos', 'categoriaSelecionada'));

    }

}