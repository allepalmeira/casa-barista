<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Locais</h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Locais</li>
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
                            <div class="row g-2 align-items-center">
                                <div class="col-12 col-md-4">
                                    <h3 class="card-title">Mesas, balcão e outros locais</h3>
                                </div>
                                <div class="col-12 col-md-8">
                                    {{-- PESQUISA E FILTRO (enviados pela URL) --}}
                                    <form action="{{ route('admin.local.index') }}" method="GET" data-pesquisa
                                        class="d-flex flex-wrap justify-content-md-end gap-2">
                                        <div class="input-group input-group-sm w-auto">
                                            <span class="input-group-text">
                                                <i class="bi bi-search" aria-hidden="true"></i>
                                            </span>
                                            <input type="search" id="local-search" class="form-control"
                                                placeholder="Pesquisar locais" aria-label="Pesquisar locais"
                                                style="width: 180px" name="busca" value="{{ $busca }}" />
                                        </div>
                                        <select id="local-role-filter" class="form-select form-select-sm w-auto"
                                            aria-label="Filtrar por status" name="status"
                                            onchange="this.form.submit()">
                                            <option value="all" @selected($status === 'all')>Todos</option>
                                            <option value="ativo" @selected($status === 'ativo')>Ativo</option>
                                            <option value="inativo" @selected($status === 'inativo')>Inativo</option>
                                        </select>
                                        <a href="{{ route('admin.local.qrcodes') }}" target="_blank"
                                            class="btn btn-sm btn-outline-light">
                                            <i class="bi bi-printer me-1" aria-hidden="true"></i>
                                            Imprimir todos
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modal-add-local">
                                            <i class="bi bi-plus-lg me-1" aria-hidden="true"> </i>
                                            Novo local
                                        </button>
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
                                            <th>Código</th>

                                            <th>Nome</th>

                                            <th>Tipo</th>

                                            <th>Código do QR</th>

                                            <th>Status</th>

                                            <th class="text-end">
                                                Ações
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($listaLocais as $local)
                                            <tr>
                                                {{-- ID --}}
                                                <td>
                                                    {{ $local->id_local }}
                                                </td>
                                                {{-- Nome --}}
                                                <td>
                                                    <span class="badge text-table">
                                                        {{ $local->nome_local }}
                                                    </span>
                                                </td>
                                                {{-- Tipo --}}
                                                <td>
                                                    {{ $local->tipo_local }}
                                                </td>
                                                {{-- Código do QR --}}
                                                <td>
                                                    <code>{{ $local->codigo_local }}</code>
                                                </td>
                                                {{-- Status --}}
                                                <td>
                                                    @if ($local->status_local === 'ATIVO')
                                                        <span class="badge text-bg-success">
                                                            Ativo
                                                        </span>
                                                    @else
                                                        <span class="badge text-bg-warning">
                                                            Inativo
                                                        </span>
                                                    @endif
                                                </td>
                                                {{-- Ações --}}
                                                <td class="text-end">
                                                    <div class="btn-group btn-group-sm">

                                                        {{-- QR CODE --}}
                                                        <a href="{{ route('admin.local.qrcode', $local->id_local) }}"
                                                            target="_blank" class="btn btn-outline-secondary"
                                                            title="Imprimir QR Code" aria-label="Imprimir QR Code">
                                                            <i class="bi bi-qr-code" aria-hidden="true"></i>
                                                        </a>

                                                        {{-- EDITAR --}}
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-toggle="modal" data-bs-target="#modal-edit-local"
                                                            data-nome="{{ $local->nome_local }}"
                                                            data-tipo="{{ $local->tipo_local }}"
                                                            data-status="{{ $local->status_local }}"
                                                            data-url="{{ route('admin.local.update', $local->id_local) }}"
                                                            aria-label="Editar">

                                                            <i class="bi bi-pencil" aria-hidden="true"> </i>
                                                        </button>

                                                        {{-- ATIVAR / DESATIVAR --}}
                                                        @if ($local->status_local === 'ATIVO')
                                                            <button type="button" class="btn btn-outline-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-status-local"
                                                                title="Desativar local"
                                                                data-url="{{ route('admin.local.status', $local->id_local) }}"
                                                                data-nome="{{ $local->nome_local }}"
                                                                data-status="ATIVO" aria-label="Desativar">

                                                                <i class="bi bi-eye-fill" aria-hidden="true"> </i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-outline-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-status-local"
                                                                title="Ativar local"
                                                                data-url="{{ route('admin.local.status', $local->id_local) }}"
                                                                data-nome="{{ $local->nome_local }}"
                                                                data-status="INATIVO" aria-label="Ativar">

                                                                <i class="bi bi-eye-slash" aria-hidden="true"> </i>
                                                            </button>
                                                        @endif

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-4 text-muted">
                                                    Nenhum local cadastrado.
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
                                Total de locais:
                                <strong>
                                    {{ $listaLocais->total() }}
                                </strong>
                            </div>

                            @include('partials.admin.paginacao', ['paginacao' => $listaLocais])
                        </div>
                        <!--end::Card Footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->

            {{-- INICIO - MODAL CADASTRO LOCAL  --}}
            <div class="modal fade" id="modal-add-local" tabindex="-1" aria-labelledby="modal-add-local-label"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        {{-- FORM DE CADASTRO --}}
                        <form action="{{ route('admin.local.store') }}" method="POST">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-add-local-label">Cadastrar novo local</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="new-local-nome" class="form-label"> Nome </label>
                                    <input type="text" class="form-control" id="new-local-nome" maxlength="30"
                                        placeholder="Mesa 01" required name="nome_local"
                                        value="{{ old('nome_local') }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="new-local-tipo" class="form-label"> Tipo </label>
                                    <select id="new-local-tipo" class="form-select" name="tipo_local">
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo }}">{{ $tipo }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="new-local-status" class="form-label"> Status </label>
                                    <select id="new-local-status" class="form-select" name="status_local">
                                        <option value="ATIVO">Ativo</option>
                                        <option value="INATIVO">Inativo</option>
                                    </select>
                                </div>

                                <p class="mb-0 small">O código do QR Code é gerado automaticamente.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                        {{-- FIM FORM DE CADASTRO --}}
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL CADASTRO LOCAL  --}}


            {{-- INICIO - MODAL EDITAR LOCAL  --}}
            <div class="modal fade" id="modal-edit-local" tabindex="-1" aria-labelledby="modal-edit-local-label"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        {{-- FORM DE EDITAR --}}
                        <form id="form-edit-local" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-edit-local-label">Editar local</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="edit-local-nome" class="form-label"> Nome </label>
                                    <input type="text" class="form-control" id="edit-local-nome" maxlength="30"
                                        required name="nome_local" />
                                </div>

                                <div class="mb-3">
                                    <label for="edit-local-tipo" class="form-label"> Tipo </label>
                                    <select id="edit-local-tipo" class="form-select" name="tipo_local">
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo }}">{{ $tipo }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="edit-local-status" class="form-label"> Status </label>
                                    <select id="edit-local-status" class="form-select" name="status_local">
                                        <option value="ATIVO">Ativo</option>
                                        <option value="INATIVO">Inativo</option>
                                    </select>
                                </div>

                                <p class="mb-0 small">O QR Code já impresso continua funcionando.</p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Atualizar local</button>
                            </div>

                        </form>
                        {{-- FIM FORM DE EDITAR --}}
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL EDITAR LOCAL  --}}


            {{-- INICIO - MODAL ATIVAR/DESATIVAR LOCAL  --}}
            <div class="modal fade" id="modal-status-local" tabindex="-1"
                aria-labelledby="modal-status-local-titulo" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form id="form-status-local" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-status-local-titulo">Alterar status do local</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <p class="mb-0" id="modal-status-local-txt">

                                </p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>

                                <button type="submit" class="btn btn-danger" id="btn-status-local">
                                    Confirmar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL ATIVAR/DESATIVAR LOCAL  --}}

        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->

</main>


{{-- Editar local --}}
<script>
    const modalEditarLocal = document.getElementById('modal-edit-local');
    const formEditLocal = document.getElementById('form-edit-local');
    const editNome = document.getElementById('edit-local-nome');
    const editTipo = document.getElementById('edit-local-tipo');
    const editStatus = document.getElementById('edit-local-status');

    // Carregar as informações no modal
    modalEditarLocal.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        // Form Action
        formEditLocal.action = botao.getAttribute('data-url');

        // Preencher
        editNome.value = botao.getAttribute('data-nome');
        editTipo.value = botao.getAttribute('data-tipo');
        editStatus.value = botao.getAttribute('data-status');

    });
</script>


{{-- Ativar e Desativar Local --}}
<script>
    const modalStatusLocal = document.getElementById('modal-status-local');
    const formStatusLocal = document.getElementById('form-status-local');
    const tituloStatusLocal = document.getElementById('modal-status-local-titulo');
    const txtStatusLocal = document.getElementById('modal-status-local-txt');
    const btnStatusLocal = document.getElementById('btn-status-local');


    modalStatusLocal.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        const url = botao.getAttribute('data-url');
        const nome = botao.getAttribute('data-nome');
        const status = botao.getAttribute('data-status');

        formStatusLocal.action = url;

        if (status === 'ATIVO') {

            tituloStatusLocal.textContent = 'Desativar local';
            txtStatusLocal.textContent = 'Tem certeza de que deseja desativar "' + nome + '"? Ele não poderá receber novas vendas.';
            btnStatusLocal.textContent = 'Desativar';

            btnStatusLocal.className = 'btn btn-danger'

        } else {

            tituloStatusLocal.textContent = 'Ativar local';
            txtStatusLocal.textContent = 'Tem certeza de que deseja ativar "' + nome + '"?';
            btnStatusLocal.textContent = 'Ativar';

            btnStatusLocal.className = 'btn btn-success'

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
