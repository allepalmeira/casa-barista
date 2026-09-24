<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Vendas</h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Vendas</li>
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

            {{-- ALERTAS VALIDAÇÃO --}}
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ $errors->first() }}
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
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title">Vendas realizadas</h3>
                            <button type="button" class="btn btn-sm btn-primary ms-auto" data-bs-toggle="modal"
                                data-bs-target="#modal-add-venda">
                                <i class="bi bi-plus-lg me-1" aria-hidden="true"></i>
                                Nova venda
                            </button>
                        </div>
                        <!--end::Card Header-->
                        <!--begin::Card Body-->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Código</th>

                                            <th>Data</th>

                                            <th>Local</th>

                                            <th>Cliente</th>

                                            <th>Pagamento</th>

                                            <th>Valor</th>

                                            <th>Observação</th>

                                            <th>Status</th>

                                            <th class="text-end">
                                                Ações
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($listaVendas as $venda)
                                            <tr>
                                                {{-- ID --}}
                                                <td>
                                                    {{ $venda->id_venda }}
                                                </td>
                                                {{-- Data --}}
                                                <td class="text-nowrap">
                                                    {{ date('d/m/Y H:i', strtotime($venda->data_hora_venda)) }}
                                                </td>
                                                {{-- Local --}}
                                                <td>
                                                    {{ $venda->local?->nome_local ?? '—' }}
                                                    @if ($venda->origem_venda === 'APP')
                                                        <i class="bi bi-phone" title="Pedido pelo app" aria-label="Pedido pelo app"></i>
                                                    @endif
                                                </td>
                                                {{-- Cliente --}}
                                                <td>
                                                    <span class="badge text-table">
                                                        {{ $venda->cliente?->nome_cliente ?? 'Não identificado' }}
                                                    </span>
                                                </td>
                                                {{-- Pagamento --}}
                                                <td>
                                                    {{ $venda->forma_pagamento_venda ?? '—' }}
                                                </td>
                                                {{-- Valor --}}
                                                <td class="text-nowrap">
                                                    R$ {{ number_format($venda->valor_total_venda, 2, ',', '.') }}
                                                </td>
                                                {{-- Observação --}}
                                                <td>
                                                    {{ $venda->observacao_venda }}
                                                </td>
                                                {{-- Status --}}
                                                <td>
                                                    @if ($venda->status_venda === 'FINALIZADA')
                                                        <span class="badge text-bg-success">
                                                            Finalizada
                                                        </span>
                                                    @elseif ($venda->status_venda === 'CANCELADA')
                                                        <span class="badge text-bg-danger">
                                                            Cancelada
                                                        </span>
                                                    @else
                                                        <span class="badge text-bg-warning">
                                                            Em andamento
                                                        </span>
                                                    @endif
                                                </td>
                                                {{-- Ações --}}
                                                <td class="text-end">
                                                    <div class="btn-group btn-group-sm">

                                                        {{-- ABRIR COMANDA --}}
                                                        <a href="{{ route('admin.venda.show', $venda->id_venda) }}"
                                                            class="btn btn-outline-secondary" title="Abrir comanda"
                                                            aria-label="Abrir comanda">
                                                            <i class="bi bi-receipt" aria-hidden="true"></i>
                                                        </a>

                                                        {{-- EDITAR --}}
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-toggle="modal" data-bs-target="#modal-edit-venda"
                                                            data-codigo="{{ $venda->id_venda }}"
                                                            data-local="{{ $venda->id_local }}"
                                                            data-cliente="{{ $venda->id_cliente }}"
                                                            data-observacao="{{ $venda->observacao_venda }}"
                                                            data-url="{{ route('admin.venda.update', $venda->id_venda) }}"
                                                            aria-label="Editar">

                                                            <i class="bi bi-pencil" aria-hidden="true"> </i>
                                                        </button>

                                                        {{-- CANCELAR / REABRIR --}}
                                                        @if ($venda->status_venda !== 'CANCELADA')
                                                            <button type="button" class="btn btn-outline-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-status-venda"
                                                                title="Cancelar venda"
                                                                data-url="{{ route('admin.venda.status', $venda->id_venda) }}"
                                                                data-codigo="{{ $venda->id_venda }}"
                                                                data-status="{{ $venda->status_venda }}"
                                                                aria-label="Cancelar venda">

                                                                <i class="bi bi-x-circle" aria-hidden="true"> </i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-outline-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-status-venda"
                                                                title="Reabrir venda"
                                                                data-url="{{ route('admin.venda.status', $venda->id_venda) }}"
                                                                data-codigo="{{ $venda->id_venda }}"
                                                                data-status="CANCELADA" aria-label="Reabrir venda">

                                                                <i class="bi bi-arrow-counterclockwise" aria-hidden="true"> </i>
                                                            </button>
                                                        @endif

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-4 text-muted">
                                                    Nenhuma venda cadastrada.
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
                                Total finalizado:
                                <strong>
                                    R$ {{ number_format($listaVendas->where('status_venda', 'FINALIZADA')->sum('valor_total_venda'), 2, ',', '.') }}
                                </strong>
                                em {{ $listaVendas->count() }} vendas
                                ({{ $listaVendas->where('status_venda', 'EM ANDAMENTO')->count() }} comandas abertas)
                            </div>
                        </div>
                        <!--end::Card Footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->

            {{-- INICIO - MODAL NOVA VENDA (ABRIR COMANDA)  --}}
            <div class="modal fade" id="modal-add-venda" tabindex="-1" aria-labelledby="modal-add-venda-label"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        {{-- FORM DE CADASTRO --}}
                        <form action="{{ route('admin.venda.store') }}" method="POST">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-add-venda-label">Nova venda</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="new-venda-local" class="form-label"> Local </label>
                                    <select id="new-venda-local" class="form-select" name="id_local" required>
                                        @foreach ($listaLocais->where('status_local', 'ATIVO') as $local)
                                            <option value="{{ $local->id_local }}">{{ $local->nome_local }} ({{ $local->tipo_local }})</option>
                                        @endforeach
                                    </select>
                                    @if ($listaLocais->where('status_local', 'ATIVO')->isEmpty())
                                        <p class="small mt-1 mb-0">
                                            Nenhum local ativo. <a href="{{ route('admin.local.index') }}">Cadastre um local</a>.
                                        </p>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="new-venda-cliente" class="form-label"> Cliente (opcional) </label>
                                    <select id="new-venda-cliente" class="form-select" name="id_cliente">
                                        <option value="">Não identificado</option>
                                        @foreach ($listaClientes->where('status_cliente', 'ATIVO') as $cliente)
                                            <option value="{{ $cliente->id_cliente }}">{{ $cliente->nome_cliente }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="new-venda-observacao" class="form-label"> Observação </label>
                                    <input type="text" class="form-control" id="new-venda-observacao"
                                        maxlength="100" name="observacao_venda" placeholder="Ex.: sem açúcar" />
                                </div>

                                <p class="mb-0 small">A comanda abre vazia. Os itens e o pagamento são lançados na próxima tela.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary" @disabled($listaLocais->where('status_local', 'ATIVO')->isEmpty())>
                                    Abrir comanda
                                </button>
                            </div>
                        </form>
                        {{-- FIM FORM DE CADASTRO --}}
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL NOVA VENDA  --}}


            {{-- INICIO - MODAL EDITAR VENDA  --}}
            <div class="modal fade" id="modal-edit-venda" tabindex="-1" aria-labelledby="modal-edit-venda-label"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        {{-- FORM DE EDITAR --}}
                        <form id="form-edit-venda" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-edit-venda-label">Editar venda</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="edit-venda-local" class="form-label"> Local </label>
                                    <select id="edit-venda-local" class="form-select" name="id_local">
                                        <option value="">Sem local</option>
                                        @foreach ($listaLocais as $local)
                                            <option value="{{ $local->id_local }}">{{ $local->nome_local }} ({{ $local->tipo_local }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="edit-venda-cliente" class="form-label"> Cliente </label>
                                    <select id="edit-venda-cliente" class="form-select" name="id_cliente">
                                        <option value="">Não identificado</option>
                                        @foreach ($listaClientes as $cliente)
                                            <option value="{{ $cliente->id_cliente }}">{{ $cliente->nome_cliente }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="edit-venda-observacao" class="form-label"> Observação </label>
                                    <input type="text" class="form-control" id="edit-venda-observacao"
                                        maxlength="100" name="observacao_venda" />
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Atualizar venda</button>
                            </div>

                        </form>
                        {{-- FIM FORM DE EDITAR --}}
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL EDITAR VENDA  --}}


            @include('admin.venda.modalStatus')

        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->

</main>


{{-- Editar venda --}}
<script>
    const modalEditarVenda = document.getElementById('modal-edit-venda');
    const formEditVenda = document.getElementById('form-edit-venda');
    const tituloEditVenda = document.getElementById('modal-edit-venda-label');
    const editLocal = document.getElementById('edit-venda-local');
    const editCliente = document.getElementById('edit-venda-cliente');
    const editObservacao = document.getElementById('edit-venda-observacao');

    // Carregar as informações no modal
    modalEditarVenda.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        // Form Action
        formEditVenda.action = botao.getAttribute('data-url');

        // Preencher
        tituloEditVenda.textContent = 'Editar venda #' + botao.getAttribute('data-codigo');
        editLocal.value = botao.getAttribute('data-local');
        editCliente.value = botao.getAttribute('data-cliente');
        editObservacao.value = botao.getAttribute('data-observacao');

    });
</script>


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
