<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Clientes</h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Clientes</li>
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
                                    <h3 class="card-title">Clientes cadastrados</h3>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="d-flex flex-wrap justify-content-md-end gap-2">
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modal-add-cliente">
                                            <i class="bi bi-person-plus-fill me-1" aria-hidden="true"> </i>
                                            Novo cliente
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

                                            <th>Foto</th>

                                            <th>Nome</th>

                                            <th>E-mail</th>

                                            <th>Status</th>

                                            <th class="text-end">
                                                Ações
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($listaClientes as $cliente)
                                            <tr>
                                                {{-- ID --}}
                                                <td>
                                                    {{ $cliente->id_cliente }}
                                                </td>
                                                {{-- Foto --}}
                                                <td>
                                                    @if ($cliente->foto_cliente)
                                                        <img src="{{ asset('barista/img/' . $cliente->foto_cliente) }}"
                                                            alt="{{ $cliente->nome_cliente }}" class="rounded-circle"
                                                            style="width: 48px; height: 48px; object-fit: cover;">
                                                    @else
                                                        <span class="text-muted">
                                                            Sem foto
                                                        </span>
                                                    @endif
                                                </td>
                                                {{-- Nome --}}
                                                <td>
                                                    <span class="badge text-table">
                                                        {{ $cliente->nome_cliente }}
                                                    </span>
                                                </td>
                                                {{-- E-mail --}}
                                                <td>
                                                    {{ $cliente->email_cliente }}
                                                </td>
                                                {{-- Status --}}
                                                <td>
                                                    @if ($cliente->status_cliente === 'ATIVO')
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
                                                            data-bs-toggle="modal" data-bs-target="#modal-edit-cliente"
                                                            data-nome="{{ $cliente->nome_cliente }}"
                                                            data-email="{{ $cliente->email_cliente }}"
                                                            data-status="{{ $cliente->status_cliente }}"
                                                            data-image="{{ asset('barista/img/' . $cliente->foto_cliente) }}"
                                                            data-url="{{ route('admin.cliente.update', $cliente->id_cliente) }}"
                                                            aria-label="Editar">

                                                            <i class="bi bi-pencil" aria-hidden="true"> </i>
                                                        </button>

                                                        {{-- ATIVAR / DESATIVAR --}}
                                                        @if ($cliente->status_cliente === 'ATIVO')
                                                            <button type="button" class="btn btn-outline-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-status-cliente"
                                                                title="Desativar cliente"
                                                                data-url="{{ route('admin.cliente.status', $cliente->id_cliente) }}"
                                                                data-nome="{{ $cliente->nome_cliente }}"
                                                                data-status="ATIVO" aria-label="Desativar">

                                                                <i class="bi bi-eye-fill" aria-hidden="true"> </i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-outline-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-status-cliente"
                                                                title="Ativar cliente"
                                                                data-url="{{ route('admin.cliente.status', $cliente->id_cliente) }}"
                                                                data-nome="{{ $cliente->nome_cliente }}"
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
                                                    Nenhum cliente cadastrado.
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
                                Total de clientes:
                                <strong>
                                    {{ $listaClientes->count() }}
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

            {{-- INICIO - MODAL CADASTRO CLIENTE  --}}
            <div class="modal fade" id="modal-add-cliente" tabindex="-1" aria-labelledby="modal-add-cliente-label"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        {{-- FORM DE CADASTRO --}}
                        <form action="{{ route('admin.cliente.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-add-cliente-label">Cadastrar novo cliente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="new-cliente-nome" class="form-label"> Nome </label>
                                    <input type="text" class="form-control" id="new-cliente-nome" maxlength="50"
                                        placeholder="Lucas Martins" required name="nome_cliente"
                                        value="{{ old('nome_cliente') }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="new-cliente-email" class="form-label"> E-mail </label>
                                    <input type="email" class="form-control" id="new-cliente-email" maxlength="80"
                                        placeholder="cliente@email.com" required name="email_cliente"
                                        value="{{ old('email_cliente') }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="new-cliente-senha" class="form-label"> Senha </label>
                                    <input type="password" class="form-control" id="new-cliente-senha" minlength="6"
                                        required name="senha_cliente" autocomplete="new-password" />
                                </div>

                                <div class="mb-3">

                                    <label for="img-cliente" class="form-label"> Selecione uma foto </label>
                                    <input type="file" class="form-control input-banner" id="img-cliente"
                                        name="foto_cliente" accept="image/*" required />

                                    <label for="img-cliente" class="banner-upload">

                                        <img id="ver-cliente" src="{{ asset('admin/assets/img/sem-banner.svg') }}"
                                            alt="Selecione uma foto para o cliente">

                                        <div class="banner-upload">
                                            <i class="bi bi-image"></i>
                                            <span>Clique para selecionar a foto</span>
                                        </div>

                                    </label>

                                </div>

                                <div class="mb-3">
                                    <label for="new-cliente-status" class="form-label"> Status </label>
                                    <select id="new-cliente-status" class="form-select" name="status_cliente">
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
            {{-- FIM - MODAL CADASTRO CLIENTE  --}}


            {{-- INICIO - MODAL EDITAR CLIENTE  --}}
            <div class="modal fade" id="modal-edit-cliente" tabindex="-1" aria-labelledby="modal-edit-cliente-label"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        {{-- FORM DE EDITAR --}}
                        <form id="form-edit-cliente" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-edit-cliente-label">Editar cliente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="edit-cliente-nome" class="form-label"> Nome </label>
                                    <input type="text" class="form-control" id="edit-cliente-nome" maxlength="50"
                                        required name="nome_cliente" />
                                </div>

                                <div class="mb-3">
                                    <label for="edit-cliente-email" class="form-label"> E-mail </label>
                                    <input type="email" class="form-control" id="edit-cliente-email" maxlength="80"
                                        required name="email_cliente" />
                                </div>

                                <div class="mb-3">
                                    <label for="edit-cliente-senha" class="form-label"> Nova senha </label>
                                    <input type="password" class="form-control" id="edit-cliente-senha"
                                        minlength="6" name="senha_cliente" autocomplete="new-password"
                                        placeholder="Deixe vazio para manter a senha atual" />
                                </div>

                                <div class="mb-3">

                                    <label for="edit-cliente-imagem" class="form-label"> Selecione uma foto </label>

                                    <input type="file" class="form-control input-banner" id="edit-cliente-imagem"
                                        name="foto_cliente" accept="image/*" />

                                    <label for="edit-cliente-imagem" class="banner-upload">

                                        <img id="edit-cliente-mostrar" src="" alt="cliente">

                                        <div class="banner-upload">
                                            <i class="bi bi-image"></i>
                                            <span>Deixe vazio para manter a foto atual</span>
                                        </div>

                                    </label>

                                </div>

                                <div class="mb-3">
                                    <label for="edit-cliente-status" class="form-label"> Status </label>
                                    <select id="edit-cliente-status" class="form-select" name="status_cliente">
                                        <option value="ATIVO">Ativo</option>
                                        <option value="INATIVO">Inativo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Atualizar cliente</button>
                            </div>

                        </form>
                        {{-- FIM FORM DE EDITAR --}}
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL EDITAR CLIENTE  --}}


            {{-- INICIO - MODAL ATIVAR/DESATIVAR CLIENTE  --}}
            <div class="modal fade" id="modal-status-cliente" tabindex="-1"
                aria-labelledby="modal-status-cliente-titulo" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form id="form-status-cliente" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-status-cliente-titulo">Alterar status do cliente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <p class="mb-0" id="modal-status-cliente-txt">

                                </p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>

                                <button type="submit" class="btn btn-danger" id="btn-status-cliente">
                                    Confirmar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL ATIVAR/DESATIVAR CLIENTE  --}}

        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->

</main>


{{-- Carregando a foto do modal cadastrar --}}
<script>
    const inputCliente = document.getElementById('img-cliente');
    const previewCliente = document.getElementById('ver-cliente');

    inputCliente.addEventListener('change', function() {

        const arquivo = this.files[0];

        if (arquivo) {

            previewCliente.src = URL.createObjectURL(arquivo);

        }

    });
</script>


{{-- Editar cliente --}}
<script>
    const modalEditarCliente = document.getElementById('modal-edit-cliente');
    const formEditCliente = document.getElementById('form-edit-cliente');
    const editNome = document.getElementById('edit-cliente-nome');
    const editEmail = document.getElementById('edit-cliente-email');
    const editSenha = document.getElementById('edit-cliente-senha');
    const editStatus = document.getElementById('edit-cliente-status');
    const editImagem = document.getElementById('edit-cliente-imagem');
    const editMostrar = document.getElementById('edit-cliente-mostrar');

    // Carregar as informações no modal
    modalEditarCliente.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        // Form Action
        formEditCliente.action = botao.getAttribute('data-url');

        // Preencher
        editNome.value = botao.getAttribute('data-nome');
        editEmail.value = botao.getAttribute('data-email');
        editStatus.value = botao.getAttribute('data-status');
        editMostrar.src = botao.getAttribute('data-image');

        editSenha.value = '';
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


{{-- Ativar e Desativar Cliente --}}
<script>
    const modalStatusCliente = document.getElementById('modal-status-cliente');
    const formStatusCliente = document.getElementById('form-status-cliente');
    const tituloStatusCliente = document.getElementById('modal-status-cliente-titulo');
    const txtStatusCliente = document.getElementById('modal-status-cliente-txt');
    const btnStatusCliente = document.getElementById('btn-status-cliente');


    modalStatusCliente.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        const url = botao.getAttribute('data-url');
        const nome = botao.getAttribute('data-nome');
        const status = botao.getAttribute('data-status');

        formStatusCliente.action = url;

        if (status === 'ATIVO') {

            tituloStatusCliente.textContent = 'Desativar cliente';
            txtStatusCliente.textContent = 'Tem certeza de que deseja desativar o cliente "' + nome + '"?';
            btnStatusCliente.textContent = 'Desativar';

            btnStatusCliente.className = 'btn btn-danger'

        } else {

            tituloStatusCliente.textContent = 'Ativar cliente';
            txtStatusCliente.textContent = 'Tem certeza de que deseja ativar o cliente "' + nome + '"?';
            btnStatusCliente.textContent = 'Ativar';

            btnStatusCliente.className = 'btn btn-success'

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
