<section class="destaque">

    <header class="parallax-padrao wow animate__animated animate__fadeInUp">
        <h2>Destaque</h2>
        <h3>O que você encontra na Casa do Barista</h3>
    </header>

    {{-- Produtos marcados como destaque no dashboard --}}
    <div class="site card wow animate__animated animate__fadeInUp">
        @foreach ($listaDestaque as $linha)
        <article>
            <img src="{{ asset('barista/img/' . $linha->imagem_produto) }}" alt="Casa do Barista - {{ $linha->nome_produto }}">
            <h4>{{ $linha->nome_produto }}</h4>
            <h5>{{ $linha->descricao_curta_produto }}</h5>
        </article>
        @endforeach
    </div>
</section>
