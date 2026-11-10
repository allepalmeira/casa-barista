<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Produto;



class ProdutoController extends Controller
{
    // LISTAR TODOS OS PRODUTOS
    public function index(): JsonResponse
    {

        // 1- Consultar os produto no banco
        $produto = Produto::where('status_produto', 'ATIVO')
        ->orderBy('nome_produto', 'asc')
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'Produtos consultados com sucesso',
            'total' => $produto->count(),
            'data' => $produto
        ], 200);

    }
}
