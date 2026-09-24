<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Depoimentos</h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Depoimentos</li>
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
                        <div class="card-header">
                            <h3 class="card-title">Depoimentos enviados pelos clientes</h3>
                        </div>
                        <!--end::Card Header-->
                        <!--begin::Card Body-->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Código</th>

                                            <th>Cliente</th>

                                            <th>Título</th>

                                            <th>Depoimento</th>

                                            <th>Nota</th>

                                            <th>Status</th>

                                            <th class="text-end">
                                                Ações
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($listaDepoimentos as $depoimento)
                                            <tr>
                                                {{-- ID --}}
                                                <td>
                                                    {{ $depoimento->id_depoimento }}
                                                </td>
                                                {{-- Cliente --}}
                                                <td>
                                                    <span class="badge text-table">
                                                        {{ $depoimento->DepoimentoCliente?->nome_cliente }}
                                                    </span>
                                                </td>
                                                {{-- Título --}}
                                                <td>
                                                    <span class="badge text-table">
                                                        {{ $depoimento->titulo_depoimento }}
                                                    </span>
                                                </td>
                                                {{-- Depoimento --}}
                                                <td>
                                                    {{ \Illuminate\Support\Str::limit($depoimento->descricao_depoimento, 80) }}
                                                </td>
                                                {{-- Nota --}}
                                                <td class="text-nowrap">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="bi {{ $i <= $depoimento->nota_depoimento ? 'bi-star-fill' : 'bi-star' }}"
                                                            aria-hidden="true"></i>
                                                    @endfor
                                                </td>
                                                {{-- Status --}}
                                                <td>
                                                    @if ($depoimento->status_depoimento === 'APROVADO')
                                                        <span class="badge text-bg-success">
                                                            Aprovado
                                                        </span>
                                                    @else
                                                        <span class="badge text-bg-warning">
                                                            Pendente
                                                        </span>
                                                    @endif
                                                </td>
                                                {{-- Ações --}}
                                                <td class="text-end">
                                                    <div class="btn-group btn-group-sm">

                                                        {{-- EDITAR --}}
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-edit-depoimento"
                                                            data-cliente="{{ $depoimento->DepoimentoCliente?->nome_cliente }}"
                                                            data-titulo="{{ $depoimento->titulo_depoimento }}"
                                                            data-descricao="{{ $depoimento->descricao_depoimento }}"
                                                            data-nota="{{ $depoimento->nota_depoimento }}"
                                                            data-status="{{ $depoimento->status_depoimento }}"
                                                            data-url="{{ route('admin.depoimento.update', $depoimento->id_depoimento) }}"
                                                            aria-label="Editar">

                                                            <i class="bi bi-pencil" aria-hidden="true"> </i>
                                                        </button>

                                                        {{-- APROVAR / VOLTAR PARA PENDENTE --}}
                                                        @if ($depoimento->status_depoimento === 'APROVADO')
                                                            <button type="button" class="btn btn-outline-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-status-depoimento"
                                                                title="Retirar do site"
                                                                data-url="{{ route('admin.depoimento.status', $depoimento->id_depoimento) }}"
                                                                data-titulo="{{ $depoimento->titulo_depoimento }}"
                                                                data-status="APROVADO" aria-label="Retirar do site">

                                                                <i class="bi bi-eye-fill" aria-hidden="true"> </i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-outline-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-status-depoimento"
                                                                title="Aprovar depoimento"
                                                                data-url="{{ route('admin.depoimento.status', $depoimento->id_depoimento) }}"
                                                                data-titulo="{{ $depoimento->titulo_depoimento }}"
                                                                data-status="PENDENTE" aria-label="Aprovar">

                                                                <i class="bi bi-eye-slash" aria-hidden="true"> </i>
                                                            </button>
                                                        @endif

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4 text-muted">
                                                    Nenhum depoimento cadastrado.
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
                                Aprovados:
                                <strong>
                                    {{ $listaDepoimentos->where('status_depoimento', 'APROVADO')->count() }}
                                </strong>
                                de {{ $listaDepoimentos->count() }}
                            </div>
                        </div>
                        <!--end::Card Footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->

            {{-- INICIO - MODAL EDITAR DEPOIMENTO  --}}
            <div class="modal fade" id="modal-edit-depoimento" tabindex="-1"
                aria-labelledby="modal-edit-depoimento-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        {{-- FORM DE EDITAR --}}
                        <form id="form-edit-depoimento" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-edit-depoimento-label">Editar depoimento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="edit-depoimento-cliente" class="form-label"> Cliente </label>
                                    <input type="text" class="form-control" id="edit-depoimento-cliente" disabled />
                                </div>

                                <div class="mb-3">
                                    <label for="edit-depoimento-titulo" class="form-label"> Título </label>
                                    <input type="text" class="form-control" id="edit-depoimento-titulo"
                                        maxlength="50" required name="titulo_depoimento" />
                                </div>

                                <div class="mb-3">
                                    <label for="edit-depoimento-descricao" class="form-label"> Depoimento </label>
                                    <textarea class="form-control" id="edit-depoimento-descricao" rows="4" required
                                        name="descricao_depoimento"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="edit-depoimento-nota" class="form-label"> Nota </label>
                                    <select id="edit-depoimento-nota" class="form-select" name="nota_depoimento">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="edit-depoimento-status" class="form-label"> Status </label>
                                    <select id="edit-depoimento-status" class="form-select"
                                        name="status_depoimento">
                                        <option value="APROVADO">Aprovado</option>
                                        <option value="PENDENTE">Pendente</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Atualizar depoimento</button>
                            </div>

                        </form>
                        {{-- FIM FORM DE EDITAR --}}
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL EDITAR DEPOIMENTO  --}}


            {{-- INICIO - MODAL APROVAR/PENDENTE DEPOIMENTO  --}}
            <div class="modal fade" id="modal-status-depoimento" tabindex="-1"
                aria-labelledby="modal-status-depoimento-titulo" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form id="form-status-depoimento" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-status-depoimento-titulo">Alterar status do depoimento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <p class="mb-0" id="modal-status-depoimento-txt">

                                </p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>

                                <button type="submit" class="btn btn-danger" id="btn-status-depoimento">
                                    Confirmar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL APROVAR/PENDENTE DEPOIMENTO  --}}

        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->

</main>


{{-- Editar depoimento --}}
<script>
    const modalEditarDepoimento = document.getElementById('modal-edit-depoimento');
    const formEditDepoimento = document.getElementById('form-edit-depoimento');
    const editCliente = document.getElementById('edit-depoimento-cliente');
    const editTitulo = document.getElementById('edit-depoimento-titulo');
    const editDescricao = document.getElementById('edit-depoimento-descricao');
    const editNota = document.getElementById('edit-depoimento-nota');
    const editStatus = document.getElementById('edit-depoimento-status');

    // Carregar as informações no modal
    modalEditarDepoimento.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        // Form Action
        formEditDepoimento.action = botao.getAttribute('data-url');

        // Preencher
        editCliente.value = botao.getAttribute('data-cliente');
        editTitulo.value = botao.getAttribute('data-titulo');
        editDescricao.value = botao.getAttribute('data-descricao');
        editNota.value = botao.getAttribute('data-nota');
        editStatus.value = botao.getAttribute('data-status');

    });
</script>


{{-- Aprovar e voltar para pendente --}}
<script>
    const modalStatusDepoimento = document.getElementById('modal-status-depoimento');
    const formStatusDepoimento = document.getElementById('form-status-depoimento');
    const tituloStatusDepoimento = document.getElementById('modal-status-depoimento-titulo');
    const txtStatusDepoimento = document.getElementById('modal-status-depoimento-txt');
    const btnStatusDepoimento = document.getElementById('btn-status-depoimento');


    modalStatusDepoimento.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        const url = botao.getAttribute('data-url');
        const titulo = botao.getAttribute('data-titulo');
        const status = botao.getAttribute('data-status');

        formStatusDepoimento.action = url;

        if (status === 'APROVADO') {

            tituloStatusDepoimento.textContent = 'Retirar depoimento do site';
            txtStatusDepoimento.textContent = 'O depoimento "' + titulo + '" voltará para PENDENTE e deixará de aparecer no site. Confirmar?';
            btnStatusDepoimento.textContent = 'Retirar';

            btnStatusDepoimento.className = 'btn btn-danger'

        } else {

            tituloStatusDepoimento.textContent = 'Aprovar depoimento';
            txtStatusDepoimento.textContent = 'O depoimento "' + titulo + '" será APROVADO e aparecerá no site. Confirmar?';
            btnStatusDepoimento.textContent = 'Aprovar';

            btnStatusDepoimento.className = 'btn btn-success'

        }

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
