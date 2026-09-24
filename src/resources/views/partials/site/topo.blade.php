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
                    <a class="{{ request()->routeIs('home') ? 'menu-ativo' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('sobre') ? 'menu-ativo' : '' }}" href="{{ route('sobre') }}">Sobre</a>
                </li>

                <li class="item-submenu">
                    <a class="{{ request()->routeIs('cardapio*') ? 'menu-ativo' : '' }}" href="{{ route('cardapio') }}">Cardápio</a>

                    <!-- SUB MENU -->
                    <ul class="submenu">
                        @foreach ($categoriaMenu as $linha)
                        <li>
                            <a href="{{ route('cardapio.categoria',$linha->id_categoria) }}">{{ $linha->nome_categoria }}</a>
                        </li>
                        @endforeach
                    </ul>
                    <!-- FIM SUB MENU -->
                </li> <!-- Fim Cardápio -->

                <li>
                    <a class="{{ request()->routeIs('evento') ? 'menu-ativo' : '' }}" href="{{ route('evento') }}">Eventos</a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('contato') ? 'menu-ativo' : '' }}" href="{{ route('contato') }}">Contato</a>
                </li>
            </ul>

            <div>
                <!-- LOGIN (já logado: vai direto para o dashboard) -->
                @auth
                    <a href="{{ route('dashboard') }}" class="login" title="Área administrativa">
                        <img src="{{ asset('barista/img/login.png') }}" alt="Área administrativa Casa do Barista">
                    </a>
                @else
                    <a href="{{ route('login') }}" class="login" title="Entrar">
                        <img src="{{ asset('barista/img/login.png') }}" alt="Login Casa do Barista">
                    </a>
                @endauth

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