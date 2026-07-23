@extends('layout.site')

@section('content')

        <!-- Inicio Sessão Bem Vindo -->
        @include('site.home.bemvindo')

        <!-- INÍCIO DA SEÇÃO EQUIPE -->
        @include('site.home.equipe')

        <!-- INÍCIO DA SEÇÃO DEPOIMENTO -->
        @include('site.home.depoimento')

    
@endsection