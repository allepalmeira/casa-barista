<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Depoimento;
use App\Models\Newsletter;
use App\Models\Produto;

use App\Models\Venda;
use Illuminate\Support\Facades\DB;

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


        /*
        |--------------------------------------------------------------------------
        | RESUMO
        |--------------------------------------------------------------------------
        */

        //Quantidade de vendas FINALIZADAS e ticket médio
        $qtdeVendas = Venda::where('status_venda', 'FINALIZADA')->count();
        $ticketMedio = $qtdeVendas > 0 ? $valorTotalVendas / $qtdeVendas : 0;

        //Depoimentos esperando aprovação e nota média de todos
        $qtdeDepoimentosPendentes = Depoimento::where('status_depoimento', 'PENDENTE')->count();
        $notaMediaDepoimentos = Depoimento::avg('nota_depoimento') ?? 0;

        //Inscritos na newsletter
        $qtdeInscritos = Newsletter::where('aceite_news', 1)->count();

        //Últimas 5 vendas
        $ultimasVendas = Venda::with('cliente')
            ->orderByDesc('data_hora_venda')
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | GRÁFICOS
        |--------------------------------------------------------------------------
        */

        //1 - Faturamento dos últimos 12 meses (meses sem venda aparecem com 0)
        $inicio = now()->startOfMonth()->subMonths(11);

        $totalPorMes = Venda::where('status_venda', 'FINALIZADA')
            ->where('data_hora_venda', '>=', $inicio)
            ->selectRaw("DATE_FORMAT(data_hora_venda, '%Y-%m') as mes, SUM(valor_total_venda) as total")
            ->groupBy('mes')
            ->pluck('total', 'mes');

        $graficoMeses = ['rotulos' => [], 'valores' => []];

        for ($i = 0; $i < 12; $i++) {
            $mes = $inicio->copy()->addMonths($i);

            $graficoMeses['rotulos'][] = $mes->locale('pt_BR')->translatedFormat('M/y');
            $graficoMeses['valores'][] = round((float) ($totalPorMes[$mes->format('Y-m')] ?? 0), 2);
        }

        //2 - Faturamento por forma de pagamento
        $graficoPagamento = Venda::where('status_venda', 'FINALIZADA')
            ->selectRaw('forma_pagamento_venda as forma, SUM(valor_total_venda) as total')
            ->groupBy('forma')
            ->orderByDesc('total')
            ->pluck('total', 'forma');

        //3 - Top 5 produtos mais vendidos (quantidade, só vendas FINALIZADAS)
        $graficoMaisVendidos = DB::table('tbl_itens_venda as i')
            ->join('tbl_produto as p', 'p.id_produto', '=', 'i.id_produto')
            ->join('tbl_venda as v', 'v.id_venda', '=', 'i.id_venda')
            ->where('v.status_venda', 'FINALIZADA')
            ->selectRaw('p.nome_produto as produto, SUM(i.qtde_itens_venda) as qtde')
            ->groupBy('p.nome_produto')
            ->orderByDesc('qtde')
            ->limit(5)
            ->pluck('qtde', 'produto');

        //4 - Produtos ativos por categoria ativa
        $graficoCategorias = Categoria::where('status_categoria', 'ATIVO')
            ->withCount(['produtos' => function ($consulta) {
                $consulta->where('status_produto', 'ATIVO');
            }])
            ->orderByDesc('produtos_count')
            ->pluck('produtos_count', 'nome_categoria');


        return view('admin.dashboard', compact(
            'qtdeClientes', 'qtdeProdutos', 'qtdeProdutosDestaque', 'valorTotalVendas',
            'qtdeVendas', 'ticketMedio', 'qtdeDepoimentosPendentes', 'notaMediaDepoimentos', 'qtdeInscritos',
            'ultimasVendas',
            'graficoMeses', 'graficoPagamento', 'graficoMaisVendidos', 'graficoCategorias'
        ));

    }

} // FIM DA CLASS
