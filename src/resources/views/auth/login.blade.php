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