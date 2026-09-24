# Models User

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tabela utilizada para autenticação
    protected $table = 'tbl_usuarios';

    // Chave primária
    protected $primaryKey = 'id_usuarios';

    // Datas personalizadas da tabela
    const CREATED_AT = 'data_criacao_usuarios';
    const UPDATED_AT = 'data_atualizacao_usuarios';

    // Campos permitidos
    protected $fillable = [
        'nome_usuarios',
        'email_usuarios',
        'senha_usuarios',
        'foto_usuarios',
        'nivel_usuarios',
        'status_usuarios',
    ];

    // Campos ocultos
    protected $hidden = [
        'senha_usuarios',
    ];

    /**
     * Conversões automáticas
     */
    protected function casts(): array
    {
        return [
            'senha_usuarios' => 'hashed',
        ];
    }

    /**
     * Campo utilizado pelo Laravel como senha.
     */
    public function getAuthPasswordName(): string
    {
        return 'senha_usuarios';
    }

    /**
     * Retorna a senha criptografada.
     */
    public function getAuthPassword(): string
    {
        return $this->senha_usuarios;
    }
}


# Login Controller

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Exibir tela de login
    public function index()
    {
        return view('auth.login');
    }


    // Realizar login
    public function login(Request $request)
    {
        // 1 - Validar dados
        $dados = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'password.required' => 'Informe sua senha.',
        ]);


        // 2 - Tentar autenticar
        if (Auth::attempt([
            'email_usuarios' => $dados['email'],
            'password' => $dados['password'],
            'status_usuarios' => 'ATIVO',
        ])) {

            // Segurança: cria uma nova sessão
            $request->session()->regenerate();

            // Vai para a página solicitada ou dashboard
            return redirect()
                ->intended(route('dashboard'));
        }


        // 3 - Login inválido
        return back()
            ->withErrors([
                'email' => 'E-mail ou senha incorretos.',
            ])
            ->onlyInput('email');
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Logout realizado com sucesso.');
    }
}


#  ÁREA RESTRITA - Todas as rotas deste grupo exigem autenticação.

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

        Route::get('/galeria', [GaleriaController::class, 'index'])
            ->name('admin.galeria.index');


        /*
        |--------------------------------------------------------------------------
        | CRUD PRODUTO
        |--------------------------------------------------------------------------
        */

        Route::get('/produto', [ProdutoController::class, 'index'])
            ->name('admin.produto.index');


        /*
        |--------------------------------------------------------------------------
        | CRUD CATEGORIA
        |--------------------------------------------------------------------------
        */

        Route::get('/categoria', [CategoriaController::class, 'index'])
            ->name('admin.categoria.index');

    });

});


# Views - auth/login.blade.php

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login | Casa do Barista</title>

    <link
        rel="stylesheet"
        href="{{ asset('admin/css/estilo-admin.css') }}"
    >
</head>

<body class="login-body">

    <main class="login-container">

        <section class="login-box">

            <div class="login-logo">

                <img
                    src="{{ asset('barista/img/logo.png') }}"
                    alt="Casa do Barista"
                >

            </div>


            <div class="login-header">

                <h1>Área Restrita</h1>

                <p>
                    Acesso exclusivo para funcionários
                </p>

            </div>


            @if(session('success'))

                <div class="login-alert login-success">
                    {{ session('success') }}
                </div>

            @endif


            @if($errors->any())

                <div class="login-alert login-error">

                    {{ $errors->first() }}

                </div>

            @endif


            <form
                action="{{ route('login.auth') }}"
                method="POST"
            >

                @csrf


                <div class="login-group">

                    <label for="email">
                        E-mail
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        placeholder="seu@email.com"
                        required
                        autofocus
                    >

                </div>


                <div class="login-group">

                    <label for="password">
                        Senha
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Digite sua senha"
                        required
                    >

                </div>


                <div class="login-options">

                    <label>

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                        >

                        Manter conectado

                    </label>

                </div>


                <button
                    type="submit"
                    class="login-button"
                >

                    Entrar

                </button>


            </form>


            <div class="login-footer">

                <p>
                    Casa do Barista
                </p>

                <small>
                    Acesso administrativo
                </small>

            </div>

        </section>

    </main>

</body>

</html>


# Ajuste no card do topo:

<!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">

                <!-- Usuário no topo -->
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">

                    <img src="{{ asset('admin/assets/img/user2-160x160.jpg') }}"
                        class="user-image rounded-circle shadow" alt="{{ auth()->user()->nome_usuarios }}" />

                    <span class="d-none d-md-inline">
                        {{ auth()->user()->nome_usuarios }}
                    </span>

                </a>


                <!-- Dropdown -->
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">

                    <!-- Cabeçalho do usuário -->
                    <li class="user-header text-bg-primary">

                        <img src="{{ asset('admin/assets/img/user2-160x160.jpg') }}" class="rounded-circle shadow"
                            alt="{{ auth()->user()->nome_usuarios }}" />

                        <p>

                            {{ auth()->user()->nome_usuarios }}

                            <small>
                                {{ ucfirst(strtolower(auth()->user()->nivel_usuarios)) }}
                            </small>

                        </p>

                    </li>


                    <!-- Informações do usuário -->
                    <li class="user-body">

                        <div class="row">

                            <div class="col-12">

                                <p class="mb-1">
                                    <strong>E-mail:</strong>
                                    {{ auth()->user()->email_usuarios }}
                                </p>

                                <p class="mb-1">
                                    <strong>Nível:</strong>
                                    {{ ucfirst(strtolower(auth()->user()->nivel_usuarios)) }}
                                </p>

                                <p class="mb-0">
                                    <strong>Status:</strong>

                                    @if (auth()->user()->status_usuarios === 'ATIVO')
                                        <span class="badge text-bg-success">
                                            Ativo
                                        </span>
                                    @else
                                        <span class="badge text-bg-danger">
                                            Inativo
                                        </span>
                                    @endif

                                </p>

                            </div>

                        </div>

                    </li>


                    <!-- Rodapé -->
                    <li class="user-footer">

                        <a href="#" class="btn btn-outline-secondary">
                            <i class="bi bi-person me-1"></i>
                            Perfil
                        </a>


                        <form action="{{ route('logout') }}" method="POST" class="d-inline float-end">

                            @csrf

                            <button type="submit" class="btn btn-outline-danger">

                                <i class="bi bi-box-arrow-right me-1"></i>
                                Sair

                            </button>

                        </form>

                    </li>

                </ul>

            </li>
            <!--end::User Menu Dropdown-->


# Estilo Login - public/admin/css/estilo-admin.js:


.login-body {
    margin: 0;
    min-height: 100vh;

    display: flex;
    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            rgba(10, 10, 10, 0.92),
            rgba(10, 10, 10, 0.96)
        ),
        #111;

    font-family: Arial, Helvetica, sans-serif;
}


.login-container {
    width: 100%;
    padding: 20px;

    display: flex;
    justify-content: center;
}


.login-box {
    width: 100%;
    max-width: 420px;

    background: #f4e9da;

    border-radius: 8px;

    overflow: hidden;

    box-shadow:
        0 20px 60px rgba(0, 0, 0, 0.45);

    padding: 40px;
}


.login-logo {
    text-align: center;
    margin-bottom: 30px;
}


.login-logo img {
    max-width: 170px;
}


.login-header {
    text-align: center;

    margin-bottom: 30px;
}


.login-header h1 {
    margin: 0 0 8px;

    color: #4b2b1b;

    font-size: 28px;
}


.login-header p {
    margin: 0;

    color: #866046;

    font-size: 14px;
}


.login-group {
    margin-bottom: 20px;
}


.login-group label {
    display: block;

    margin-bottom: 7px;

    color: #4b2b1b;

    font-weight: 600;

    font-size: 13px;
}


.login-group input {
    width: 100%;

    box-sizing: border-box;

    padding: 13px 15px;

    border: 1px solid #c6a386;

    border-radius: 5px;

    background: #fff;

    outline: none;

    font-size: 14px;
}


.login-group input:focus {
    border-color: #bd692d;

    box-shadow:
        0 0 0 3px rgba(189, 105, 45, 0.12);
}


.login-options {
    margin-bottom: 22px;

    color: #745039;

    font-size: 13px;
}


.login-button {
    width: 100%;

    border: 0;

    padding: 14px;

    border-radius: 5px;

    background: #b9692e;

    color: #fff;

    font-weight: bold;

    font-size: 14px;

    cursor: pointer;

    transition: 0.2s;
}


.login-button:hover {
    background: #935126;
}


.login-alert {
    margin-bottom: 20px;

    padding: 12px 14px;

    border-radius: 5px;

    font-size: 13px;
}


.login-error {
    background: #f8d7da;
    color: #842029;
}


.login-success {
    background: #d1e7dd;
    color: #0f5132;
}


.login-footer {
    margin-top: 30px;

    padding-top: 20px;

    border-top: 1px solid #d7c1af;

    text-align: center;

    color: #76523a;
}


.login-footer p {
    margin: 0;

    font-weight: bold;
}


.login-footer small {
    font-size: 11px;
}


# Criar funcionário
docker compose exec app php artisan tinker

\App\Models\User::create([
    'nome_usuario' => 'Administrador',
    'email' => 'admin@casadobarista.com.br',
    'password' => '12345678',
    'perfil_usuario' => 'ADMIN',
    'status_usuario' => 'ATIVO',
]);

exit