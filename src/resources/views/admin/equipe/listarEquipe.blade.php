<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Equipe</h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Equipe</li>
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
                                    <h3 class="card-title">Quem aparece em "Quem Somos"</h3>
                                </div>
                                <div class="col-12 col-md-8">
                                    {{-- PESQUISA E FILTRO (enviados pela URL) --}}
                                    <form action="{{ route('admin.equipe.index') }}" method="GET" data-pesquisa
                                        class="d-flex flex-wrap justify-content-md-end gap-2">
                                        <div class="input-group input-group-sm w-auto">
                                            <span class="input-group-text">
                                                <i class="bi bi-search" aria-hidden="true"></i>
                                            </span>
                                            <input type="search" id="equipe-search" class="form-control"
                                                placeholder="Nome ou cargo" aria-label="Pesquisar na equipe"
                                                style="width: 180px" name="busca" value="{{ $busca }}" />
                                        </div>
                                        <select id="equipe-filter" class="form-select form-select-sm w-auto"
                                            aria-label="Filtrar por status" name="status"
                                            onchange="this.form.submit()">
                                            <option value="all" @selected($status === 'all')>Todos</option>
                                            <option value="ativo" @selected($status === 'ativo')>Ativo</option>
                                            <option value="inativo" @selected($status === 'inativo')>Inativo</option>
                                        </select>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modal-add-equipe">
                                            <i class="bi bi-person-plus-fill me-1" aria-hidden="true"> </i>
                                            Nova pessoa
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
                                            <th>Ordem</th>

                                            <th>Foto</th>

                                            <th>Nome</th>

                                            <th>Cargo no site</th>

                                            <th>Status</th>

                                            <th class="text-end">
                                                Ações
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($listaEquipe as $equipe)
                                            <tr>
                                                {{-- Ordem --}}
                                                <td>
                                                    {{ $equipe->ordem_equipe }}
                                                </td>
                                                {{-- Foto --}}
                                                <td>
                                                    <img src="{{ asset('barista/img/' . $equipe->foto_equipe) }}"
                                                        alt="{{ $equipe->nome_equipe }}" class="rounded"
                                                        style="width: 52px; height: 60px; object-fit: cover;">
                                                </td>
                                                {{-- Nome --}}
                                                <td>
                                                    <span class="badge text-table">
                                                        {{ $equipe->nome_equipe }}
                                                    </span>
                                                </td>
                                                {{-- Cargo --}}
                                                <td>
                                                    {{ $equipe->cargo_equipe }}
                                                </td>
                                                {{-- Status --}}
                                                <td>
                                                    @if ($equipe->status_equipe === 'ATIVO')
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
                                                            data-bs-toggle="modal" data-bs-target="#modal-edit-equipe"
                                                            data-nome="{{ $equipe->nome_equipe }}"
                                                            data-cargo="{{ $equipe->cargo_equipe }}"
                                                            data-ordem="{{ $equipe->ordem_equipe }}"
                                                            data-status="{{ $equipe->status_equipe }}"
                                                            data-image="{{ asset('barista/img/' . $equipe->foto_equipe) }}"
                                                            data-url="{{ route('admin.equipe.update', $equipe->id_equipe) }}"
                                                            aria-label="Editar">

                                                            <i class="bi bi-pencil" aria-hidden="true"> </i>
                                                        </button>

                                                        {{-- ATIVAR / DESATIVAR --}}
                                                        @if ($equipe->status_equipe === 'ATIVO')
                                                            <button type="button" class="btn btn-outline-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-status-equipe"
                                                                title="Tirar do site"
                                                                data-url="{{ route('admin.equipe.status', $equipe->id_equipe) }}"
                                                                data-nome="{{ $equipe->nome_equipe }}"
                                                                data-status="ATIVO" aria-label="Desativar">

                                                                <i class="bi bi-eye-fill" aria-hidden="true"> </i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-outline-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-status-equipe"
                                                                title="Mostrar no site"
                                                                data-url="{{ route('admin.equipe.status', $equipe->id_equipe) }}"
                                                                data-nome="{{ $equipe->nome_equipe }}"
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
                                                    Ninguém cadastrado na equipe.
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
                                Total na equipe:
                                <strong>
                                    {{ $listaEquipe->total() }}
                                </strong>
                            </div>

                            @include('partials.admin.paginacao', ['paginacao' => $listaEquipe])
                        </div>
                        <!--end::Card Footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->

            {{-- INICIO - MODAL CADASTRO EQUIPE  --}}
            <div class="modal fade" id="modal-add-equipe" tabindex="-1" aria-labelledby="modal-add-equipe-label"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        {{-- FORM DE CADASTRO --}}
                        <form action="{{ route('admin.equipe.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-add-equipe-label">Nova pessoa na equipe</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="new-equipe-nome" class="form-label"> Nome </label>
                                    <input type="text" class="form-control" id="new-equipe-nome" maxlength="50"
                                        placeholder="Lucas Ribeiro" required name="nome_equipe"
                                        value="{{ old('nome_equipe') }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="new-equipe-cargo" class="form-label"> Cargo (como aparece no site) </label>
                                    <input type="text" class="form-control" id="new-equipe-cargo" maxlength="50"
                                        placeholder="Barista Especialista" required name="cargo_equipe"
                                        value="{{ old('cargo_equipe') }}" />
                                </div>

                                <div class="mb-3">

                                    <label for="img-equipe" class="form-label"> Foto (de preferência em pé, 190 x 220) </label>
                                    <input type="file" class="form-control input-banner" id="img-equipe"
                                        name="foto_equipe" accept="image/*" required />

                                    <label for="img-equipe" class="banner-upload">

                                        <img id="ver-equipe" src="{{ asset('admin/assets/img/sem-banner.svg') }}"
                                            alt="Selecione uma foto">

                                        <div class="banner-upload">
                                            <i class="bi bi-image"></i>
                                            <span>Clique para selecionar a foto</span>
                                        </div>

                                    </label>

                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="new-equipe-ordem" class="form-label"> Ordem no site </label>
                                        <input type="number" class="form-control" id="new-equipe-ordem" min="0"
                                            max="999" required name="ordem_equipe" value="{{ old('ordem_equipe', 0) }}" />
                                    </div>

                                    <div class="col-6 mb-3">
                                        <label for="new-equipe-status" class="form-label"> Status </label>
                                        <select id="new-equipe-status" class="form-select" name="status_equipe">
                                            <option value="ATIVO">Ativo</option>
                                            <option value="INATIVO">Inativo</option>
                                        </select>
                                    </div>
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
            {{-- FIM - MODAL CADASTRO EQUIPE  --}}


            {{-- INICIO - MODAL EDITAR EQUIPE  --}}
            <div class="modal fade" id="modal-edit-equipe" tabindex="-1" aria-labelledby="modal-edit-equipe-label"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        {{-- FORM DE EDITAR --}}
                        <form id="form-edit-equipe" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-edit-equipe-label">Editar pessoa da equipe</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="edit-equipe-nome" class="form-label"> Nome </label>
                                    <input type="text" class="form-control" id="edit-equipe-nome" maxlength="50"
                                        required name="nome_equipe" />
                                </div>

                                <div class="mb-3">
                                    <label for="edit-equipe-cargo" class="form-label"> Cargo (como aparece no site) </label>
                                    <input type="text" class="form-control" id="edit-equipe-cargo" maxlength="50"
                                        required name="cargo_equipe" />
                                </div>

                                <div class="mb-3">

                                    <label for="edit-equipe-imagem" class="form-label"> Foto </label>

                                    <input type="file" class="form-control input-banner" id="edit-equipe-imagem"
                                        name="foto_equipe" accept="image/*" />

                                    <label for="edit-equipe-imagem" class="banner-upload">

                                        <img id="edit-equipe-mostrar" src="" alt="Foto atual">

                                        <div class="banner-upload">
                                            <i class="bi bi-image"></i>
                                            <span>Deixe vazio para manter a foto atual</span>
                                        </div>

                                    </label>

                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="edit-equipe-ordem" class="form-label"> Ordem no site </label>
                                        <input type="number" class="form-control" id="edit-equipe-ordem" min="0"
                                            max="999" required name="ordem_equipe" />
                                    </div>

                                    <div class="col-6 mb-3">
                                        <label for="edit-equipe-status" class="form-label"> Status </label>
                                        <select id="edit-equipe-status" class="form-select" name="status_equipe">
                                            <option value="ATIVO">Ativo</option>
                                            <option value="INATIVO">Inativo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Atualizar</button>
                            </div>

                        </form>
                        {{-- FIM FORM DE EDITAR --}}
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL EDITAR EQUIPE  --}}


            {{-- INICIO - MODAL ATIVAR/DESATIVAR EQUIPE  --}}
            <div class="modal fade" id="modal-status-equipe" tabindex="-1"
                aria-labelledby="modal-status-equipe-titulo" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form id="form-status-equipe" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-status-equipe-titulo">Alterar status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <p class="mb-0" id="modal-status-equipe-txt">

                                </p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>

                                <button type="submit" class="btn btn-danger" id="btn-status-equipe">
                                    Confirmar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL ATIVAR/DESATIVAR EQUIPE  --}}

        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->

</main>


{{-- Carregando a foto do modal cadastrar --}}
<script>
    const inputEquipe = document.getElementById('img-equipe');
    const previewEquipe = document.getElementById('ver-equipe');

    inputEquipe.addEventListener('change', function() {

        const arquivo = this.files[0];

        if (arquivo) {

            previewEquipe.src = URL.createObjectURL(arquivo);

        }

    });
</script>


{{-- Editar equipe --}}
<script>
    const modalEditarEquipe = document.getElementById('modal-edit-equipe');
    const formEditEquipe = document.getElementById('form-edit-equipe');
    const editNome = document.getElementById('edit-equipe-nome');
    const editCargo = document.getElementById('edit-equipe-cargo');
    const editOrdem = document.getElementById('edit-equipe-ordem');
    const editStatus = document.getElementById('edit-equipe-status');
    const editImagem = document.getElementById('edit-equipe-imagem');
    const editMostrar = document.getElementById('edit-equipe-mostrar');

    // Carregar as informações no modal
    modalEditarEquipe.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        // Form Action
        formEditEquipe.action = botao.getAttribute('data-url');

        // Preencher
        editNome.value = botao.getAttribute('data-nome');
        editCargo.value = botao.getAttribute('data-cargo');
        editOrdem.value = botao.getAttribute('data-ordem');
        editStatus.value = botao.getAttribute('data-status');
        editMostrar.src = botao.getAttribute('data-image');

        editImagem.value = '';

    });

    // VER FOTO PARA EDITAR
    editImagem.addEventListener('change', function() {

        const arquivo = this.files[0];

        if (arquivo) {

            editMostrar.src = URL.createObjectURL(arquivo);

        }

    });
</script>


{{-- Ativar e Desativar --}}
<script>
    const modalStatusEquipe = document.getElementById('modal-status-equipe');
    const formStatusEquipe = document.getElementById('form-status-equipe');
    const tituloStatusEquipe = document.getElementById('modal-status-equipe-titulo');
    const txtStatusEquipe = document.getElementById('modal-status-equipe-txt');
    const btnStatusEquipe = document.getElementById('btn-status-equipe');


    modalStatusEquipe.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        const url = botao.getAttribute('data-url');
        const nome = botao.getAttribute('data-nome');
        const status = botao.getAttribute('data-status');

        formStatusEquipe.action = url;

        if (status === 'ATIVO') {

            tituloStatusEquipe.textContent = 'Tirar do site';
            txtStatusEquipe.textContent = nome + ' deixará de aparecer em "Quem Somos". Confirmar?';
            btnStatusEquipe.textContent = 'Tirar do site';

            btnStatusEquipe.className = 'btn btn-danger'

        } else {

            tituloStatusEquipe.textContent = 'Mostrar no site';
            txtStatusEquipe.textContent = nome + ' voltará a aparecer em "Quem Somos". Confirmar?';
            btnStatusEquipe.textContent = 'Mostrar no site';

            btnStatusEquipe.className = 'btn btn-success'

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
