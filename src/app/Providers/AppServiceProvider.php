<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Categoria;
use App\Models\Contato;
use App\Models\Depoimento;
use App\Models\Equipe;
use App\Models\Galeria;
use App\Models\LinhaTempo;
use App\Models\Newsletter;
use App\Models\Produto;
use App\Models\Venda;
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


        /*
        |--------------------------------------------------------------------------
        | SEÇÕES DO SITE - cada seção busca os seus dados cadastrados no dashboard
        | (funciona em qualquer página que incluir a seção: Home, Sobre, Eventos, Contato)
        |--------------------------------------------------------------------------
        */

        //Banner: banners ATIVOS em ordem aleatória
        View::composer('site.home.banner', function ($view){

            $listaBanner = Banner::where('status_banner', 'ATIVO')->inRandomOrder()->get();

            $view->with('listaBanner', $listaBanner);

        });

        //Bem-vindo: os 3 marcos mais recentes da Linha do tempo (do mais antigo para o mais novo)
        View::composer('site.home.bemvindo', function ($view){

            $listaLinhaTempo = LinhaTempo::where('status_linha_tempo', 'ATIVO')
            ->orderByDesc('ano_linha_tempo')
            ->limit(3)
            ->get()
            ->sortBy('ano_linha_tempo');

            $view->with('listaLinhaTempo', $listaLinhaTempo);

        });

        //Destaque: 3 produtos ATIVOS marcados como destaque
        View::composer('site.home.destaque', function ($view){

            $listaDestaque = Produto::where('status_produto', 'ATIVO')
            ->where('destaque_produto', 1)
            ->inRandomOrder()
            ->limit(3)
            ->get();

            $view->with('listaDestaque', $listaDestaque);

        });

        //Cardápio da home: 6 produtos ATIVOS (os de destaque primeiro)
        View::composer('site.home.cardapio', function ($view){

            $listaCardapio = Produto::where('status_produto', 'ATIVO')
            ->orderByDesc('destaque_produto')
            ->orderBy('nome_produto')
            ->limit(6)
            ->get();

            $view->with('listaCardapio', $listaCardapio);

        });

        //Galeria: imagens ATIVAS
        View::composer('site.home.galeria', function ($view){

            $listaGaleria = Galeria::where('status_galeria', 'ATIVO')
            ->orderByDesc('id_galeria')
            ->get();

            $view->with('listaGaleria', $listaGaleria);

        });

        //Equipe (Quem Somos): pessoas ATIVAS na ordem definida no dashboard
        View::composer('site.home.equipe', function ($view){

            $listaEquipe = Equipe::where('status_equipe', 'ATIVO')
            ->orderBy('ordem_equipe')
            ->orderBy('nome_equipe')
            ->get();

            $view->with('listaEquipe', $listaEquipe);

        });

        //Depoimentos APROVADOS junto com os dados dos clientes
        View::composer('site.home.depoimento', function ($view){

            $listaDepo = Depoimento::with('DepoimentoCliente')
            ->where('status_depoimento', 'APROVADO')
            ->orderByDesc('id_depoimento')
            ->get();

            $view->with('listaDepo', $listaDepo);

        });

        //Topo do admin: mensagens novas e notificações
        View::composer('partials.admin.topo', function ($view){

            //Mensagens do site ainda não lidas (as 3 mais recentes no menu)
            $qtdeMensagensNovas = Contato::where('status_contato', 'NOVO')->count();

            $mensagensNovas = Contato::where('status_contato', 'NOVO')
            ->orderByDesc('data_criacao_contato')
            ->limit(3)
            ->get();

            //Notificações: o que está esperando alguma ação (some quando é resolvido)
            $notificacoes = [];

            if ($qtdeMensagensNovas > 0) {
                $notificacoes[] = [
                    'icone' => 'bi-envelope-fill',
                    'texto' => $qtdeMensagensNovas . ($qtdeMensagensNovas === 1 ? ' mensagem nova' : ' mensagens novas'),
                    'quando' => Contato::where('status_contato', 'NOVO')->max('data_criacao_contato'),
                    'link' => route('admin.mensagem.index', ['status' => 'novo']),
                ];
            }

            $qtdeComandas = Venda::where('status_venda', 'EM ANDAMENTO')->count();

            if ($qtdeComandas > 0) {
                $notificacoes[] = [
                    'icone' => 'bi-receipt',
                    'texto' => $qtdeComandas . ($qtdeComandas === 1 ? ' comanda aberta' : ' comandas abertas'),
                    'quando' => Venda::where('status_venda', 'EM ANDAMENTO')->max('data_hora_venda'),
                    'link' => route('admin.venda.index'),
                ];
            }

            $qtdeDepoimentos = Depoimento::where('status_depoimento', 'PENDENTE')->count();

            if ($qtdeDepoimentos > 0) {
                $notificacoes[] = [
                    'icone' => 'bi-chat-quote-fill',
                    'texto' => $qtdeDepoimentos . ($qtdeDepoimentos === 1 ? ' depoimento para aprovar' : ' depoimentos para aprovar'),
                    'quando' => Depoimento::where('status_depoimento', 'PENDENTE')->max('data_criacao_depoimento'),
                    'link' => route('admin.depoimento.index'),
                ];
            }

            $qtdeInscritos = Newsletter::where('aceite_news', 1)->where('data_criacao_news', '>=', now()->subDays(7))->count();

            if ($qtdeInscritos > 0) {
                $notificacoes[] = [
                    'icone' => 'bi-person-plus-fill',
                    'texto' => $qtdeInscritos . ($qtdeInscritos === 1 ? ' inscrito novo na newsletter' : ' inscritos novos na newsletter'),
                    'quando' => Newsletter::where('aceite_news', 1)->max('data_criacao_news'),
                    'link' => route('admin.newsletter.index'),
                ];
            }

            //Número do sino = soma de tudo que está pendente
            $qtdeNotificacoes = $qtdeMensagensNovas + $qtdeComandas + $qtdeDepoimentos + $qtdeInscritos;

            $view->with(compact('qtdeMensagensNovas', 'mensagensNovas', 'notificacoes', 'qtdeNotificacoes'));

        });
    }
}
