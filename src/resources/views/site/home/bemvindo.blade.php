<section class="bem-vindo">

    <div class="site">

        <header>
            <h3>Bem Vindo à</h3>
            <h2>Casa do Barista</h2>
            <p>A Casa do Barista nasceu da vontade de unir pessoas através de algo simples e profundo: o ato de
                compartilhar uma xícara de café. Acreditamos no poder das histórias que começam no campo, passam
                pelo barista e chegam até você em forma de aroma, sabor e sentimento. Valorizamos pequenos
                produtores, técnicas artesanais e processos manuais que resgatam o verdadeiro significado do
                café brasileiro: riqueza cultural, dedicação e tradição.</p>
        </header>

        {{-- Marcos da Linha do tempo (cadastrados no dashboard) --}}
        <div class="wow animate__animated animate__fadeInUp">
            @foreach ($listaLinhaTempo as $linha)
            <article>
                <h5>{{ substr($linha->ano_linha_tempo, 0, 4) }}</h5>
                <h4>{{ $linha->titulo_linha_tempo }}</h4>
                <img src="{{ asset('barista/img/coffee.svg') }}" alt="Casa do Barista - {{ $linha->titulo_linha_tempo }}">
                <p>{{ $linha->descricao_linha_tempo }}</p>
            </article>
            @endforeach
        </div>

    </div>

</section>