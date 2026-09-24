<?php

use App\Http\Controllers\Site\CardapioController;
use App\Http\Controllers\Site\ContatoController;
use App\Http\Controllers\Site\EventoController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\NewsletterController as SiteNewsletterController;
use App\Http\Controllers\Site\SobreController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\GaleriaController;
use App\Http\Controllers\Admin\ProdutoController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\VendaController;
use App\Http\Controllers\Admin\LocalController;
use App\Http\Controllers\Admin\MensagemController;
use App\Http\Controllers\Admin\PerfilController;
use App\Http\Controllers\Admin\EquipeController;
use App\Http\Controllers\Admin\DepoimentoController;
use App\Http\Controllers\Admin\LinhaTempoController;
use App\Http\Controllers\Admin\NewsletterController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;


// RORAS WEB
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/sobre', [SobreController::class, 'sobre'])->name('sobre');
Route::get('/cardapio', [CardapioController::class, 'cardapio'])->name('cardapio');
Route::get('/cardapio/categoria/{idCategoria}', [CardapioController::class, 'cardapio'])->name('cardapio.categoria');
Route::get('/evento', [EventoController::class, 'evento'])->name('evento');
Route::get('/contato', [ContatoController::class, 'contato'])->name('contato');

// Formulários do site (limite de 5 envios por minuto para evitar spam)
Route::post('/contato', [ContatoController::class, 'store'])->middleware('throttle:5,1,contato')->name('contato.store');
Route::post('/newsletter', [SiteNewsletterController::class, 'store'])->middleware('throttle:5,1,newsletter')->name('newsletter.store');


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
|
| O middleware guest permite acessar estas rotas somente quando o usuário NÃO está autenticado.
|
*/

Route::middleware('guest')->group(function () {

    // Exibir tela de login
    Route::get('/login', [LoginController::class, 'index'])
        ->name('login');

    // Processar login
    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.auth');

});


/*
|--------------------------------------------------------------------------
| ÁREA RESTRITA
|--------------------------------------------------------------------------
|
| Todas as rotas deste grupo exigem autenticação.
|
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');


    /*
    |--------------------------------------------------------------------------
    | ROTAS ADMINISTRATIVAS
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')->group(function () {


        /*
        |--------------------------------------------------------------------------
        | CRUD BANNER
        |--------------------------------------------------------------------------
        */

        // Listar banners
        Route::get('/banner', [BannerController::class, 'index'])
            ->name('admin.banner.index');

        // Cadastrar banner
        Route::post('/banner', [BannerController::class, 'store'])
            ->name('admin.banner.store');

        // Editar banner
        // Route::get('/banner/{id}/editar', [BannerController::class, 'edit'])
        //     ->name('admin.banner.edit');

        // Atualizar banner
        Route::put('/banner/{id}', [BannerController::class, 'update'])
            ->name('admin.banner.update');

        // Ativar / desativar banner
        Route::patch('/banner/{id}', [BannerController::class, 'status'])
            ->name('admin.banner.status');


        /*
        |--------------------------------------------------------------------------
        | CRUD GALERIA
        |--------------------------------------------------------------------------
        */

        // Listar galeria
        Route::get('/galeria', [GaleriaController::class, 'index'])
            ->name('admin.galeria.index');

        // Cadastrar imagem na galeria
        Route::post('/galeria', [GaleriaController::class, 'store'])
            ->name('admin.galeria.store');

        // Atualizar imagem da galeria
        Route::put('/galeria/{id}', [GaleriaController::class, 'update'])
            ->name('admin.galeria.update');

        // Ativar / desativar imagem da galeria
        Route::patch('/galeria/{id}', [GaleriaController::class, 'status'])
            ->name('admin.galeria.status');


        /*
        |--------------------------------------------------------------------------
        | CRUD PRODUTO
        |--------------------------------------------------------------------------
        */

        // Listar produtos
        Route::get('/produto', [ProdutoController::class, 'index'])
            ->name('admin.produto.index');

        // Cadastrar produto
        Route::post('/produto', [ProdutoController::class, 'store'])
            ->name('admin.produto.store');

        // Atualizar produto
        Route::put('/produto/{id}', [ProdutoController::class, 'update'])
            ->name('admin.produto.update');

        // Ativar / desativar produto
        Route::patch('/produto/{id}', [ProdutoController::class, 'status'])
            ->name('admin.produto.status');


        /*
        |--------------------------------------------------------------------------
        | CRUD CATEGORIA
        |--------------------------------------------------------------------------
        */

        // Listar categorias
        Route::get('/categoria', [CategoriaController::class, 'index'])
            ->name('admin.categoria.index');

        // Cadastrar categoria
        Route::post('/categoria', [CategoriaController::class, 'store'])
            ->name('admin.categoria.store');

        // Atualizar categoria
        Route::put('/categoria/{id}', [CategoriaController::class, 'update'])
            ->name('admin.categoria.update');

        // Ativar / desativar categoria
        Route::patch('/categoria/{id}', [CategoriaController::class, 'status'])
            ->name('admin.categoria.status');


        /*
        |--------------------------------------------------------------------------
        | VENDAS (comanda: abre -> lança itens -> fecha com pagamento)
        |--------------------------------------------------------------------------
        */

        // Listar vendas
        Route::get('/venda', [VendaController::class, 'index'])
            ->name('admin.venda.index');

        // Abrir comanda (nova venda)
        Route::post('/venda', [VendaController::class, 'store'])
            ->name('admin.venda.store');

        // Ver comanda
        Route::get('/venda/{id}', [VendaController::class, 'show'])
            ->name('admin.venda.show');

        // Atualizar venda (local, cliente, observação)
        Route::put('/venda/{id}', [VendaController::class, 'update'])
            ->name('admin.venda.update');

        // Cancelar / reabrir venda
        Route::patch('/venda/{id}', [VendaController::class, 'status'])
            ->name('admin.venda.status');

        // Adicionar item na comanda
        Route::post('/venda/{id}/item', [VendaController::class, 'adicionarItem'])
            ->name('admin.venda.item.store');

        // Remover item da comanda
        Route::delete('/venda/{id}/item/{idItem}', [VendaController::class, 'removerItem'])
            ->name('admin.venda.item.destroy');

        // Fechar comanda (pagamento)
        Route::patch('/venda/{id}/fechar', [VendaController::class, 'fechar'])
            ->name('admin.venda.fechar');


        /*
        |--------------------------------------------------------------------------
        | CRUD LOCAL (mesas, balcão... com QR Code)
        |--------------------------------------------------------------------------
        */

        // Listar locais
        Route::get('/local', [LocalController::class, 'index'])
            ->name('admin.local.index');

        // Cadastrar local
        Route::post('/local', [LocalController::class, 'store'])
            ->name('admin.local.store');

        // Atualizar local
        Route::put('/local/{id}', [LocalController::class, 'update'])
            ->name('admin.local.update');

        // Ativar / desativar local
        Route::patch('/local/{id}', [LocalController::class, 'status'])
            ->name('admin.local.status');

        // Imprimir QR Code de todos os locais ativos
        Route::get('/local/qrcode', [LocalController::class, 'qrcode'])
            ->name('admin.local.qrcodes');

        // Imprimir QR Code de um local
        Route::get('/local/{id}/qrcode', [LocalController::class, 'qrcode'])
            ->name('admin.local.qrcode');


        /*
        |--------------------------------------------------------------------------
        | CRUD CLIENTE
        |--------------------------------------------------------------------------
        */

        // Listar clientes
        Route::get('/cliente', [ClienteController::class, 'index'])
            ->name('admin.cliente.index');

        // Cadastrar cliente
        Route::post('/cliente', [ClienteController::class, 'store'])
            ->name('admin.cliente.store');

        // Atualizar cliente
        Route::put('/cliente/{id}', [ClienteController::class, 'update'])
            ->name('admin.cliente.update');

        // Ativar / desativar cliente
        Route::patch('/cliente/{id}', [ClienteController::class, 'status'])
            ->name('admin.cliente.status');


        /*
        |--------------------------------------------------------------------------
        | CRUD USUÁRIO
        |--------------------------------------------------------------------------
        */

        // Listar usuários
        Route::get('/usuario', [UsuarioController::class, 'index'])
            ->name('admin.usuario.index');

        // Cadastrar usuário
        Route::post('/usuario', [UsuarioController::class, 'store'])
            ->name('admin.usuario.store');

        // Atualizar usuário
        Route::put('/usuario/{id}', [UsuarioController::class, 'update'])
            ->name('admin.usuario.update');

        // Ativar / desativar usuário
        Route::patch('/usuario/{id}', [UsuarioController::class, 'status'])
            ->name('admin.usuario.status');


        /*
        |--------------------------------------------------------------------------
        | DEPOIMENTOS (enviados pelo site: aqui só listar, editar e aprovar)
        |--------------------------------------------------------------------------
        */

        // Listar depoimentos
        Route::get('/depoimento', [DepoimentoController::class, 'index'])
            ->name('admin.depoimento.index');

        // Atualizar depoimento
        Route::put('/depoimento/{id}', [DepoimentoController::class, 'update'])
            ->name('admin.depoimento.update');

        // Aprovar / voltar para pendente
        Route::patch('/depoimento/{id}', [DepoimentoController::class, 'status'])
            ->name('admin.depoimento.status');


        /*
        |--------------------------------------------------------------------------
        | CRUD LINHA DO TEMPO
        |--------------------------------------------------------------------------
        */

        // Listar linha do tempo
        Route::get('/linha-tempo', [LinhaTempoController::class, 'index'])
            ->name('admin.linha-tempo.index');

        // Cadastrar marco
        Route::post('/linha-tempo', [LinhaTempoController::class, 'store'])
            ->name('admin.linha-tempo.store');

        // Atualizar marco
        Route::put('/linha-tempo/{id}', [LinhaTempoController::class, 'update'])
            ->name('admin.linha-tempo.update');

        // Ativar / desativar marco
        Route::patch('/linha-tempo/{id}', [LinhaTempoController::class, 'status'])
            ->name('admin.linha-tempo.status');


        /*
        |--------------------------------------------------------------------------
        | CRUD NEWSLETTER
        |--------------------------------------------------------------------------
        */

        // Listar newsletter
        Route::get('/newsletter', [NewsletterController::class, 'index'])
            ->name('admin.newsletter.index');

        // Cadastrar e-mail
        Route::post('/newsletter', [NewsletterController::class, 'store'])
            ->name('admin.newsletter.store');

        // Atualizar e-mail
        Route::put('/newsletter/{id}', [NewsletterController::class, 'update'])
            ->name('admin.newsletter.update');

        // Ativar / cancelar inscrição
        Route::patch('/newsletter/{id}', [NewsletterController::class, 'status'])
            ->name('admin.newsletter.status');


        /*
        |--------------------------------------------------------------------------
        | CRUD EQUIPE (seção "Quem Somos" do site)
        |--------------------------------------------------------------------------
        */

        // Listar equipe
        Route::get('/equipe', [EquipeController::class, 'index'])
            ->name('admin.equipe.index');

        // Cadastrar pessoa
        Route::post('/equipe', [EquipeController::class, 'store'])
            ->name('admin.equipe.store');

        // Atualizar pessoa
        Route::put('/equipe/{id}', [EquipeController::class, 'update'])
            ->name('admin.equipe.update');

        // Mostrar / tirar do site
        Route::patch('/equipe/{id}', [EquipeController::class, 'status'])
            ->name('admin.equipe.status');


        /*
        |--------------------------------------------------------------------------
        | MENSAGENS (formulário de contato do site)
        |--------------------------------------------------------------------------
        */

        // Listar mensagens
        Route::get('/mensagem', [MensagemController::class, 'index'])
            ->name('admin.mensagem.index');

        // Marcar como lida / não lida
        Route::patch('/mensagem/{id}', [MensagemController::class, 'status'])
            ->name('admin.mensagem.status');


        /*
        |--------------------------------------------------------------------------
        | PERFIL (funcionário logado)
        |--------------------------------------------------------------------------
        */

        // Ver perfil e histórico
        Route::get('/perfil', [PerfilController::class, 'index'])
            ->name('admin.perfil.index');

        // Atualizar perfil
        Route::put('/perfil', [PerfilController::class, 'update'])
            ->name('admin.perfil.update');

    });

});
