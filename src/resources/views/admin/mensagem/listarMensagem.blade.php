<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Mensagens</h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Mensagens</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end::Row-->

            {{-- ALERTAS SUCESSO --}}
            @if (session('sucesso'))
                <div class="alert alert-success" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('sucesso') }}
                </div>
            @endif

            {{-- ALERTAS ERRO --}}
            @if (session('erro'))
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ session('erro') }}
                </div>
            @endif

        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-12">
                    <!--begin::Card-->
                    <div class="card mb-4">
                        <!--begin::Card Header-->
                        <div class="card-header">
                            <div class="row g-2 align-items-center">
                                <div class="col-12 col-md-4">
                                    <h3 class="card-title">Mensagens do site</h3>
                                </div>
                                <div class="col-12 col-md-8">
                                    {{-- PESQUISA E FILTRO (enviados pela URL) --}}
                                    <form action="{{ route('admin.mensagem.index') }}" method="GET" data-pesquisa
                                        class="d-flex flex-wrap justify-content-md-end gap-2">
                                        <div class="input-group input-group-sm w-auto">
                                            <span class="input-group-text">
                                                <i class="bi bi-search" aria-hidden="true"></i>
                                            </span>
                                            <input type="search" id="mensagem-search" class="form-control"
                                                placeholder="Nome, e-mail ou assunto" aria-label="Pesquisar mensagens"
                                                style="width: 200px" name="busca" value="{{ $busca }}" />
                                        </div>
                                        <select id="mensagem-filter" class="form-select form-select-sm w-auto"
                                            aria-label="Filtrar por status" name="status"
                                            onchange="this.form.submit()">
                                            <option value="all" @selected($status === 'all')>Todas</option>
                                            <option value="novo" @selected($status === 'novo')>Novas</option>
                                            <option value="lido" @selected($status === 'lido')>Lidas</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--end::Card Header-->
                        <!--begin::Card Body-->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Data</th>

                                            <th>Nome</th>

                                            <th>Assunto</th>

                                            <th>Mensagem</th>

                                            <th>Status</th>

                                            <th class="text-end">
                                                Ações
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($listaMensagens as $mensagem)
                                            <tr>
                                                {{-- Data --}}
                                                <td class="text-nowrap">
                                                    {{ date('d/m/Y H:i', strtotime($mensagem->data_criacao_contato)) }}
                                                </td>
                                                {{-- Nome --}}
                                                <td>
                                                    <span class="badge text-table {{ $mensagem->status_contato === 'NOVO' ? 'fw-bold' : '' }}">
                                                        {{ $mensagem->nome_contato }}
                                                    </span>
                                                </td>
                                                {{-- Assunto --}}
                                                <td>
                                                    {{ $mensagem->assunto_contato }}
                                                </td>
                                                {{-- Mensagem --}}
                                                <td>
                                                    {{ \Illuminate\Support\Str::limit($mensagem->mensagem_contato, 60) }}
                                                </td>
                                                {{-- Status --}}
                                                <td>
                                                    @if ($mensagem->status_contato === 'NOVO')
                                                        <span class="badge text-bg-warning">
                                                            Nova
                                                        </span>
                                                    @else
                                                        <span class="badge text-bg-success">
                                                            Lida
                                                        </span>
                                                    @endif
                                                </td>
                                                {{-- Ações --}}
                                                <td class="text-end">
                                                    <div class="btn-group btn-group-sm">

                                                        {{-- LER --}}
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-toggle="modal" data-bs-target="#modal-ler-mensagem"
                                                            id="ler-{{ $mensagem->id_contato }}"
                                                            data-nome="{{ $mensagem->nome_contato }}"
                                                            data-email="{{ $mensagem->email_contato }}"
                                                            data-telefone="{{ $mensagem->telefone_contato }}"
                                                            data-assunto="{{ $mensagem->assunto_contato }}"
                                                            data-data="{{ date('d/m/Y H:i', strtotime($mensagem->data_criacao_contato)) }}"
                                                            data-mensagem="{{ $mensagem->mensagem_contato }}"
                                                            data-status="{{ $mensagem->status_contato }}"
                                                            data-url="{{ route('admin.mensagem.status', $mensagem->id_contato) }}"
                                                            title="Ler mensagem" aria-label="Ler mensagem">

                                                            <i class="bi bi-envelope-open" aria-hidden="true"> </i>
                                                        </button>

                                                        {{-- MARCAR LIDA / NÃO LIDA --}}
                                                        <form action="{{ route('admin.mensagem.status', $mensagem->id_contato) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')

                                                            @if ($mensagem->status_contato === 'NOVO')
                                                                <button type="submit" class="btn btn-outline-success"
                                                                    title="Marcar como lida" aria-label="Marcar como lida">
                                                                    <i class="bi bi-check2-all" aria-hidden="true"></i>
                                                                </button>
                                                            @else
                                                                <button type="submit" class="btn btn-outline-secondary"
                                                                    title="Marcar como não lida" aria-label="Marcar como não lida">
                                                                    <i class="bi bi-envelope" aria-hidden="true"></i>
                                                                </button>
                                                            @endif
                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-4 text-muted">
                                                    Nenhuma mensagem encontrada.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!--end::Card Body-->
                        <!--begin::Card Footer-->
                        <div class="card-footer clearfix">
                            <div class="float-start pt-1 fs-7 text-body-secondary">
                                Total de mensagens:
                                <strong>
                                    {{ $listaMensagens->total() }}
                                </strong>
                            </div>

                            @include('partials.admin.paginacao', ['paginacao' => $listaMensagens])
                        </div>
                        <!--end::Card Footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->

            {{-- INICIO - MODAL LER MENSAGEM  --}}
            <div class="modal fade" id="modal-ler-mensagem" tabindex="-1" aria-labelledby="modal-ler-mensagem-titulo"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form id="form-ler-mensagem" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-ler-mensagem-titulo">Mensagem</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <p class="mb-1"><strong>De:</strong> <span id="ler-nome"></span></p>
                                <p class="mb-1"><strong>E-mail:</strong> <span id="ler-email"></span></p>
                                <p class="mb-1"><strong>Telefone:</strong> <span id="ler-telefone"></span></p>
                                <p class="mb-3"><strong>Recebida em:</strong> <span id="ler-data"></span></p>
                                <p class="mb-0" id="ler-mensagem" style="white-space: pre-line"></p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Fechar
                                </button>
                                <button type="submit" class="btn btn-primary" id="btn-ler-mensagem">
                                    Marcar como lida
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL LER MENSAGEM  --}}

        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->

</main>


{{-- Ler mensagem --}}
<script>
    const modalLerMensagem = document.getElementById('modal-ler-mensagem');
    const formLerMensagem = document.getElementById('form-ler-mensagem');
    const btnLerMensagem = document.getElementById('btn-ler-mensagem');

    // Carregar as informações no modal
    modalLerMensagem.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        formLerMensagem.action = botao.getAttribute('data-url');

        document.getElementById('modal-ler-mensagem-titulo').textContent = botao.getAttribute('data-assunto');
        document.getElementById('ler-nome').textContent = botao.getAttribute('data-nome');
        document.getElementById('ler-email').textContent = botao.getAttribute('data-email');
        document.getElementById('ler-telefone').textContent = botao.getAttribute('data-telefone');
        document.getElementById('ler-data').textContent = botao.getAttribute('data-data');
        document.getElementById('ler-mensagem').textContent = botao.getAttribute('data-mensagem');

        // Mensagem já lida: o botão só aparece para as novas
        btnLerMensagem.hidden = botao.getAttribute('data-status') !== 'NOVO';

    });

    // Vindo do topo (?ler=ID): abre a mensagem direto
    // (espera a página carregar, porque o Bootstrap é incluído no final do layout)
    document.addEventListener('DOMContentLoaded', function() {

        const lerId = new URLSearchParams(window.location.search).get('ler');
        const botaoLer = lerId ? document.getElementById('ler-' + lerId) : null;

        if (botaoLer) {
            botaoLer.click();
        }

    });
</script>


{{-- Pesquisa enquanto digita --}}
@include('partials.admin.pesquisa')


{{-- Time para o alerta --}}
<script>

    setTimeout(() => {

        const alertas = document.querySelectorAll('.alert');

        alertas.forEach(function(alerta){

            const instancia = bootstrap.Alert.getOrCreateInstance(alerta);

            instancia.close();

        });

    }, 5000);

</script>
