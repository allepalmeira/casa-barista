<section class="galeria  wow animate__animated animate__fadeInUp">
            <header class="parallax-padrao">
                <h2>Galeria</h2>
                <h3>Momentos que traduzem nosso propósito</h3>
            </header>

            {{-- Imagens ativas da Galeria do dashboard.
                 A lista é repetida porque o carrossel mostra 6 de uma vez
                 e só gira quando existem mais imagens do que isso. --}}
            <div class="itensGaleria">
                @for ($volta = 0; $volta < 2; $volta++)
                    @foreach ($listaGaleria as $linha)
                        <img src="{{ asset('barista/img/' . $linha->imagem_galeria) }}" alt="{{ $linha->nome_galeria }} - Casa do Barista">
                    @endforeach
                @endfor
            </div>
        </section>
