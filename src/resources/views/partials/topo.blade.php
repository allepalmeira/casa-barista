<header class="topo" id="topoFixo">

    <div class="site">

        <!-- LOGO -->
        <h1>Casa do Barista</h1>

        <!-- MENU -->
        <button class="abrir-menu"></button>
        <nav class="menu">
            <button class="fechar-menu"></button>
            <ul>
                <li>
                    <a class="menu-ativo" href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <a class="" href="{{ route('sobre') }}">Sobre</a>
                </li>
                <li>
                    <a class="" href="{{ route('cardapio') }}">Cardápio</a>
                </li>
                <li>
                    <a class="" href="{{ route('evento') }}">Eventos</a>
                </li>
                <li>
                    <a class="" href="{{ route('contato') }}">Contato</a>
                </li>
            </ul>

            <div>
                <!-- LOGIN -->
                <a href="#" class="login">
                    <img src="{{ asset('barista/img/login.png') }}" alt="Login Casa do Barista">
                </a>

                <!-- Rede Social  | ul>li*3>a>img -->
                <ul class="redeSocial">
                    <li><a href="#" target="_blank"><img src="{{ asset('barista/img/facebook-24.png') }}"
                                alt="Logo Facebook - Casa do Barista"></a></li>
                    <li><a href="#" target="_blank"><img src="{{ asset('barista/img/instagram-24.png') }}"
                                alt="Logo Instagram - Casa do Barista"></a></li>
                    <li><a href="https://wa.me/5511988662233?text=Ol%C3%A1%21%20Gostaria%20de%20falar%20com%20a%20Casa%20Do%20Barista%20%E2%98%95"
                            target="_blank"><img src="{{ asset('barista/img/whatsapp-24.png') }}" alt="Logo WhastApp - Casa do Barista"></a>
                    </li>
                </ul>
            </div>

        </nav>

    </div>

</header>