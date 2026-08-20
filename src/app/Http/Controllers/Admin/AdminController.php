<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda;

class AdminController extends Controller{
   
    public function dashboard(){

        //Quantidade total de Clientes ATIVOS
        $qtdeClientes = Cliente::where('status_cliente', 'ATIVO')->count();
        //Quantidade total de Produtos ATIVOS
        $qtdeProdutos = Produto::where('status_produto', 'ATIVO')->count();
        //Quantidade total de Produtos EM DESTAQUE
        $qtdeProdutosDestaque = Produto::where('destaque_produto', 1)->count();
        //Valor total de Vendas
        $valorTotalVendas = Venda::where('status_venda', 'FINALIZADA')->sum('valor_total_venda');


        return view('admin.dashboard.dashboard', compact('qtdeClientes','qtdeProdutos','qtdeProdutosDestaque','valorTotalVendas'));

    }

} // FIM DA CLASS