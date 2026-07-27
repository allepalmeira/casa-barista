<section class="banner">
    @foreach ($listaBanner as $linha)
        <img src="{{ asset("barista/img/$linha->imagem_banner") }}" alt="{{ $linha->titulo_banner }}">
    @endforeach
   

</section>