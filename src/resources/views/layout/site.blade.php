<!DOCTYPE html>
<html lang="pt-br">

<head>
    @include('partials.site.head')
</head>

<body>
    @include('partials.site.topo')
    <!-- TESTE -->
    <main>
        @yield('content')
    </main>

    @include('partials.site.rodape')

    @include('partials.site.script')
</body>

</html>