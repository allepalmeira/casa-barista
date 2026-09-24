<section class="cardapio">
    <header class="parallax-padrao wow animate__animated animate__fadeInUp">
        <h2>CARDÁPIO</h2>
        <h3>Sabores que despertam memórias</h3>
    </header>

    {{-- Produtos ativos cadastrados no dashboard (os de destaque primeiro) --}}
    <div class="site card-cardapio">

        @foreach ($listaCardapio as $linha)
        <div class="card-flip  wow animate__animated animate__fadeInUp">
            <article class="card-flip-miolo">
                <div class="flip1">
                    <h4>{{ $linha->nome_produto }}</h4>
                </div>
                <div class="flip2">
                    <h4>{{ $linha->nome_produto }} <span>R$ {{ number_format($linha->valor_produto, 2, ',', '.') }}</span></h4>
                    <h5>{{ $linha->descricao_curta_produto }}</h5>
                </div>
            </article>
        </div>
        @endforeach

    </div>

    <div class="site btn-cardapio">
        <a class="btn" href="{{ route('cardapio') }}">Veja Mais</a>
    </div>

</section>
