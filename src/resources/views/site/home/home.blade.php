@extends('layout.site')

@section('content')

<!-- Inicio Banner -->
        <!-- Fim Banner -->
        @include('site.home.banner')

        <!-- Inicio Sessão Bem Vindo -->
        @include('site.home.bemvindo')

        <!-- Inicio Sessão Destaque --> 
        @include('site.home.destaque')  

        <!-- INÍCIO DA SEÇÃO CARDÁPIO -->
        @include('site.home.cardapio')

        <!-- INÍCIO DA SEÇÃO EQUIPE -->
        @include('site.home.equipe')

        <!-- INÍCIO DA SEÇÃO EVENTO -->
        @include('site.home.evento')

        <!-- INÍCIO DA SEÇÃO GALERIA -->
        @include('site.home.galeria')

        <!-- INÍCIO DA SEÇÃO DEPOIMENTO -->
        @include('site.home.depoimento')          


@endsection