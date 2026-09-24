<section class="equipe">
    <header class="parallax-padrao  wow animate__animated animate__fadeInUp">
        <h2>Quem Somos</h2>
        <h3>O café é feito por pessoas</h3>
    </header>

    {{-- Equipe cadastrada no dashboard. Até 3 pessoas: cards lado a lado;
         mais que isso vira carrossel (slideEquipe, configurado no script.js) --}}
    <div class="site cardEquipe {{ $listaEquipe->count() > 3 ? 'slideEquipe' : '' }}  wow animate__animated animate__fadeInUp">
        @foreach ($listaEquipe as $linha)
        <article>
            <img src="{{ asset('barista/img/' . $linha->foto_equipe) }}" alt="{{ $linha->nome_equipe }} - {{ $linha->cargo_equipe }}">
            <h4>{{ $linha->nome_equipe }}</h4>
            <h5>{{ $linha->cargo_equipe }}</h5>
        </article>
        @endforeach
    </div>

</section>
