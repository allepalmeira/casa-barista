{{-- PAGINAÇÃO - recebe $paginacao (resultado do ->paginate()) --}}
<ul class="pagination pagination-sm m-0 float-end">

    {{-- Página anterior --}}
    <li class="page-item {{ $paginacao->onFirstPage() ? 'disabled' : '' }}">
        <a class="page-link" href="{{ $paginacao->previousPageUrl() ?? '#' }}" aria-label="Previous"> &laquo; </a>
    </li>

    {{-- Números das páginas --}}
    @for ($pagina = 1; $pagina <= $paginacao->lastPage(); $pagina++)
        <li class="page-item {{ $pagina === $paginacao->currentPage() ? 'active' : '' }}">
            <a class="page-link" href="{{ $paginacao->url($pagina) }}">{{ $pagina }}</a>
        </li>
    @endfor

    {{-- Próxima página --}}
    <li class="page-item {{ $paginacao->hasMorePages() ? '' : 'disabled' }}">
        <a class="page-link" href="{{ $paginacao->nextPageUrl() ?? '#' }}" aria-label="Next"> &raquo; </a>
    </li>

</ul>
