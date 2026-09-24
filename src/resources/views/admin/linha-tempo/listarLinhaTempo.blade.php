<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Linha do tempo</h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Linha do tempo</li>
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
                                    <h3 class="card-title">Marcos cadastrados</h3>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="d-flex flex-wrap justify-content-md-end gap-2">
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modal-add-linha-tempo">
                                            <i class="bi bi-plus-lg me-1" aria-hidden="true"> </i>
                                            Novo marco
                                        </button>
                                    </div>
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

                                            <th>Ano</th>

                                            <th>Título</th>

                                            <th>Descrição</th>

                                            <th>Status</th>

                                            <th class="text-end">
                                                Ações
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($listaLinhaTempo as $linhaTempo)
                                            <tr>
                                                {{-- ID --}}
                                                <td>
                                                    {{ $linhaTempo->id_linha_tempo }}
                                                </td>
                                                {{-- Ano --}}
                                                <td>
                                                    {{ substr($linhaTempo->ano_linha_tempo, 0, 4) }}
                                                </td>
                                                {{-- Título --}}
                                                <td>
                                                    <span class="badge text-table">
                                                        {{ $linhaTempo->titulo_linha_tempo }}
                                                    </span>
                                                </td>
                                                {{-- Descrição --}}
                                                <td>
                                                    {{ $linhaTempo->descricao_linha_tempo }}
                                                </td>
                                                {{-- Status --}}
                                                <td>
                                                    @if ($linhaTempo->status_linha_tempo === 'ATIVO')
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

                                                        {{-- EDITAR --}}
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-edit-linha-tempo"
                                                            data-titulo="{{ $linhaTempo->titulo_linha_tempo }}"
                                                            data-ano="{{ substr($linhaTempo->ano_linha_tempo, 0, 4) }}"
                                                            data-descricao="{{ $linhaTempo->descricao_linha_tempo }}"
                                                            data-status="{{ $linhaTempo->status_linha_tempo }}"
                                                            data-url="{{ route('admin.linha-tempo.update', $linhaTempo->id_linha_tempo) }}"
                                                            aria-label="Editar">

                                                            <i class="bi bi-pencil" aria-hidden="true"> </i>
                                                        </button>

                                                        {{-- ATIVAR / DESATIVAR --}}
                                                        @if ($linhaTempo->status_linha_tempo === 'ATIVO')
                                                            <button type="button" class="btn btn-outline-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-status-linha-tempo"
                                                                title="Desativar marco"
                                                                data-url="{{ route('admin.linha-tempo.status', $linhaTempo->id_linha_tempo) }}"
                                                                data-titulo="{{ $linhaTempo->titulo_linha_tempo }}"
                                                                data-status="ATIVO" aria-label="Desativar">

                                                                <i class="bi bi-eye-fill" aria-hidden="true"> </i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-outline-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-status-linha-tempo"
                                                                title="Ativar marco"
                                                                data-url="{{ route('admin.linha-tempo.status', $linhaTempo->id_linha_tempo) }}"
                                                                data-titulo="{{ $linhaTempo->titulo_linha_tempo }}"
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
                                                    Nenhum marco cadastrado.
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
                                Total de marcos:
                                <strong>
                                    {{ $listaLinhaTempo->count() }}
                                </strong>
                            </div>
                        </div>
                        <!--end::Card Footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->

            {{-- INICIO - MODAL CADASTRO LINHA DO TEMPO  --}}
            <div class="modal fade" id="modal-add-linha-tempo" tabindex="-1"
                aria-labelledby="modal-add-linha-tempo-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        {{-- FORM DE CADASTRO --}}
                        <form action="{{ route('admin.linha-tempo.store') }}" method="POST">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-add-linha-tempo-label">Cadastrar novo marco</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="new-linha-tempo-titulo" class="form-label"> Título </label>
                                    <input type="text" class="form-control" id="new-linha-tempo-titulo"
                                        maxlength="30" placeholder="Fundação" required name="titulo_linha_tempo"
                                        value="{{ old('titulo_linha_tempo') }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="new-linha-tempo-ano" class="form-label"> Ano </label>
                                    <input type="number" class="form-control" id="new-linha-tempo-ano" min="1900"
                                        max="2100" placeholder="2001" required name="ano_linha_tempo"
                                        value="{{ old('ano_linha_tempo') }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="new-linha-tempo-descricao" class="form-label"> Descrição </label>
                                    <textarea class="form-control" id="new-linha-tempo-descricao" maxlength="255" required
                                        name="descricao_linha_tempo">{{ old('descricao_linha_tempo') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="new-linha-tempo-status" class="form-label"> Status </label>
                                    <select id="new-linha-tempo-status" class="form-select"
                                        name="status_linha_tempo">
                                        <option value="ATIVO">Ativo</option>
                                        <option value="INATIVO">Inativo</option>
                                    </select>
                                </div>
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
            {{-- FIM - MODAL CADASTRO LINHA DO TEMPO  --}}


            {{-- INICIO - MODAL EDITAR LINHA DO TEMPO  --}}
            <div class="modal fade" id="modal-edit-linha-tempo" tabindex="-1"
                aria-labelledby="modal-edit-linha-tempo-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        {{-- FORM DE EDITAR --}}
                        <form id="form-edit-linha-tempo" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-edit-linha-tempo-label">Editar marco</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="edit-linha-tempo-titulo" class="form-label"> Título </label>
                                    <input type="text" class="form-control" id="edit-linha-tempo-titulo"
                                        maxlength="30" required name="titulo_linha_tempo" />
                                </div>

                                <div class="mb-3">
                                    <label for="edit-linha-tempo-ano" class="form-label"> Ano </label>
                                    <input type="number" class="form-control" id="edit-linha-tempo-ano"
                                        min="1900" max="2100" required name="ano_linha_tempo" />
                                </div>

                                <div class="mb-3">
                                    <label for="edit-linha-tempo-descricao" class="form-label"> Descrição </label>
                                    <textarea class="form-control" id="edit-linha-tempo-descricao" maxlength="255" required
                                        name="descricao_linha_tempo"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="edit-linha-tempo-status" class="form-label"> Status </label>
                                    <select id="edit-linha-tempo-status" class="form-select"
                                        name="status_linha_tempo">
                                        <option value="ATIVO">Ativo</option>
                                        <option value="INATIVO">Inativo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Atualizar marco</button>
                            </div>

                        </form>
                        {{-- FIM FORM DE EDITAR --}}
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL EDITAR LINHA DO TEMPO  --}}


            {{-- INICIO - MODAL ATIVAR/DESATIVAR LINHA DO TEMPO  --}}
            <div class="modal fade" id="modal-status-linha-tempo" tabindex="-1"
                aria-labelledby="modal-status-linha-tempo-titulo" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form id="form-status-linha-tempo" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-status-linha-tempo-titulo">Alterar status do marco</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <p class="mb-0" id="modal-status-linha-tempo-txt">

                                </p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>

                                <button type="submit" class="btn btn-danger" id="btn-status-linha-tempo">
                                    Confirmar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL ATIVAR/DESATIVAR LINHA DO TEMPO  --}}

        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->

</main>


{{-- Editar linha do tempo --}}
<script>
    const modalEditarLinhaTempo = document.getElementById('modal-edit-linha-tempo');
    const formEditLinhaTempo = document.getElementById('form-edit-linha-tempo');
    const editTitulo = document.getElementById('edit-linha-tempo-titulo');
    const editAno = document.getElementById('edit-linha-tempo-ano');
    const editDescricao = document.getElementById('edit-linha-tempo-descricao');
    const editStatus = document.getElementById('edit-linha-tempo-status');

    // Carregar as informações no modal
    modalEditarLinhaTempo.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        // Form Action
        formEditLinhaTempo.action = botao.getAttribute('data-url');

        // Preencher
        editTitulo.value = botao.getAttribute('data-titulo');
        editAno.value = botao.getAttribute('data-ano');
        editDescricao.value = botao.getAttribute('data-descricao');
        editStatus.value = botao.getAttribute('data-status');

    });
</script>


{{-- Ativar e Desativar Linha do tempo --}}
<script>
    const modalStatusLinhaTempo = document.getElementById('modal-status-linha-tempo');
    const formStatusLinhaTempo = document.getElementById('form-status-linha-tempo');
    const tituloStatusLinhaTempo = document.getElementById('modal-status-linha-tempo-titulo');
    const txtStatusLinhaTempo = document.getElementById('modal-status-linha-tempo-txt');
    const btnStatusLinhaTempo = document.getElementById('btn-status-linha-tempo');


    modalStatusLinhaTempo.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        const url = botao.getAttribute('data-url');
        const titulo = botao.getAttribute('data-titulo');
        const status = botao.getAttribute('data-status');

        formStatusLinhaTempo.action = url;

        if (status === 'ATIVO') {

            tituloStatusLinhaTempo.textContent = 'Desativar marco';
            txtStatusLinhaTempo.textContent = 'Tem certeza de que deseja desativar o marco "' + titulo + '"?';
            btnStatusLinhaTempo.textContent = 'Desativar';

            btnStatusLinhaTempo.className = 'btn btn-danger'

        } else {

            tituloStatusLinhaTempo.textContent = 'Ativar marco';
            txtStatusLinhaTempo.textContent = 'Tem certeza de que deseja ativar o marco "' + titulo + '"?';
            btnStatusLinhaTempo.textContent = 'Ativar';

            btnStatusLinhaTempo.className = 'btn btn-success'

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
