<section class="depo  wow animate__animated animate__fadeInUp">
    <header class="parallax-padrao">
        <h2>DEPOIMENTOS</h2>
        <h3>Nada nos inspira mais do que ouvir a experiência de quem passa por aqui</h3>
    </header>

    <div class="site itensDepo">

        <!-- DEPO 01 -->
        @forelse ($listaDepo as $linha)

        @php

            // Garantir que as estrelas fique entre 0 a 5
            $estrela = max(
                0,
                min(5, (int) $linha->nota_depoimento)
            );

            // Clilente relacionado com o Depoimento
            $cliente = $linha->DepoimentoCliente;

            
        @endphp

            <article>
                <div class="estrela">
                    <ul>
                        @for($i = 1; $i <= 5; $i++)
                        <li class="{{ $i <= $estrela ? 'estrela-ativa' : 'estrela-inativa' }}" >
                            <img src="{{ asset('barista/img/star.svg') }}" alt="{{ $i <= $estrela ? 'Estrela preenchida' : 'Estrela não preenchida'}}">
                        </li>
                        @endfor
                    </ul>
                </div>
                <div class="dadosDepo">
                    <p>{{ $linha->descricao_depoimento}}</p>
                    <img src="{{ asset('barista/img/'. $cliente->foto_cliente)}}" alt="{{ $cliente->nome_cliente }}">
                    <h4>{{ $cliente->nome_cliente }}</h4>
                    <div>
                        <h5>Data: {{ $linha->data_criacao_depoimento ? $linha->data_criacao_depoimento->format('d/m/Y') : 'Data não informada'}}</h5>
                        <h5>{{ $linha->titulo_depoimento }}</h5>
                    </div>
                </div>

            </article>
            
        @empty
            
        @endforelse
       

    </div>
</section>