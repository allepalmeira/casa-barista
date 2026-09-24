<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Usuários</h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Usuários</li>
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
                                    <h3 class="card-title">Usuários cadastrados</h3>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="d-flex flex-wrap justify-content-md-end gap-2">
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modal-add-usuario">
                                            <i class="bi bi-person-plus-fill me-1" aria-hidden="true"> </i>
                                            Novo usuário
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

                                            <th>Nível</th>

                                            <th>Status</th>

                                            <th class="text-end">
                                                Ações
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($listaUsuarios as $usuario)
                                            <tr>
                                                {{-- ID --}}
                                                <td>
                                                    {{ $usuario->id_usuarios }}
                                                </td>
                                                {{-- Foto --}}
                                                <td>
                                                    @if ($usuario->foto_usuarios)
                                                        <img src="{{ asset('barista/img/' . $usuario->foto_usuarios) }}"
                                                            alt="{{ $usuario->nome_usuarios }}" class="rounded-circle"
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
                                                        {{ $usuario->nome_usuarios }}
                                                    </span>
                                                </td>
                                                {{-- E-mail --}}
                                                <td>
                                                    {{ $usuario->email_usuarios }}
                                                </td>
                                                {{-- Nível --}}
                                                <td>
                                                    <span class="badge text-table">
                                                        {{ $usuario->nivel_usuarios }}
                                                    </span>
                                                </td>
                                                {{-- Status --}}
                                                <td>
                                                    @if ($usuario->status_usuarios === 'ATIVO')
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
                                                            data-bs-toggle="modal" data-bs-target="#modal-edit-usuario"
                                                            data-nome="{{ $usuario->nome_usuarios }}"
                                                            data-email="{{ $usuario->email_usuarios }}"
                                                            data-nivel="{{ $usuario->nivel_usuarios }}"
                                                            data-status="{{ $usuario->status_usuarios }}"
                                                            data-image="{{ asset('barista/img/' . $usuario->foto_usuarios) }}"
                                                            data-url="{{ route('admin.usuario.update', $usuario->id_usuarios) }}"
                                                            aria-label="Editar">

                                                            <i class="bi bi-pencil" aria-hidden="true"> </i>
                                                        </button>

                                                        {{-- ATIVAR / DESATIVAR --}}
                                                        @if ($usuario->status_usuarios === 'ATIVO')
                                                            <button type="button" class="btn btn-outline-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-status-usuario"
                                                                title="Desativar usuário"
                                                                data-url="{{ route('admin.usuario.status', $usuario->id_usuarios) }}"
                                                                data-nome="{{ $usuario->nome_usuarios }}"
                                                                data-status="ATIVO" aria-label="Desativar">

                                                                <i class="bi bi-eye-fill" aria-hidden="true"> </i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-outline-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-status-usuario"
                                                                title="Ativar usuário"
                                                                data-url="{{ route('admin.usuario.status', $usuario->id_usuarios) }}"
                                                                data-nome="{{ $usuario->nome_usuarios }}"
                                                                data-status="INATIVO" aria-label="Ativar">

                                                                <i class="bi bi-eye-slash" aria-hidden="true"> </i>
                                                            </button>
                                                        @endif

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4 text-muted">
                                                    Nenhum usuário cadastrado.
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
                                Total de usuários:
                                <strong>
                                    {{ $listaUsuarios->count() }}
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

            {{-- INICIO - MODAL CADASTRO USUÁRIO  --}}
            <div class="modal fade" id="modal-add-usuario" tabindex="-1" aria-labelledby="modal-add-usuario-label"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        {{-- FORM DE CADASTRO --}}
                        <form action="{{ route('admin.usuario.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-add-usuario-label">Cadastrar novo usuário</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="new-usuario-nome" class="form-label"> Nome </label>
                                    <input type="text" class="form-control" id="new-usuario-nome" maxlength="50"
                                        placeholder="Carla Silva" required name="nome_usuarios"
                                        value="{{ old('nome_usuarios') }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="new-usuario-email" class="form-label"> E-mail </label>
                                    <input type="email" class="form-control" id="new-usuario-email" maxlength="80"
                                        placeholder="usuario@email.com" required name="email_usuarios"
                                        value="{{ old('email_usuarios') }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="new-usuario-senha" class="form-label"> Senha </label>
                                    <input type="password" class="form-control" id="new-usuario-senha" minlength="6"
                                        required name="senha_usuarios" autocomplete="new-password" />
                                </div>

                                <div class="mb-3">

                                    <label for="img-usuario" class="form-label"> Selecione uma foto </label>
                                    <input type="file" class="form-control input-banner" id="img-usuario"
                                        name="foto_usuarios" accept="image/*" required />

                                    <label for="img-usuario" class="banner-upload">

                                        <img id="ver-usuario" src="{{ asset('admin/assets/img/sem-banner.svg') }}"
                                            alt="Selecione uma foto para o usuário">

                                        <div class="banner-upload">
                                            <i class="bi bi-image"></i>
                                            <span>Clique para selecionar a foto</span>
                                        </div>

                                    </label>

                                </div>

                                <div class="mb-3">
                                    <label for="new-usuario-nivel" class="form-label"> Nível </label>
                                    <select id="new-usuario-nivel" class="form-select" name="nivel_usuarios">
                                        @foreach ($niveis as $nivel)
                                            <option value="{{ $nivel }}">{{ $nivel }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="new-usuario-status" class="form-label"> Status </label>
                                    <select id="new-usuario-status" class="form-select" name="status_usuarios">
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
            {{-- FIM - MODAL CADASTRO USUÁRIO  --}}


            {{-- INICIO - MODAL EDITAR USUÁRIO  --}}
            <div class="modal fade" id="modal-edit-usuario" tabindex="-1" aria-labelledby="modal-edit-usuario-label"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        {{-- FORM DE EDITAR --}}
                        <form id="form-edit-usuario" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-edit-usuario-label">Editar usuário</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="edit-usuario-nome" class="form-label"> Nome </label>
                                    <input type="text" class="form-control" id="edit-usuario-nome" maxlength="50"
                                        required name="nome_usuarios" />
                                </div>

                                <div class="mb-3">
                                    <label for="edit-usuario-email" class="form-label"> E-mail </label>
                                    <input type="email" class="form-control" id="edit-usuario-email" maxlength="80"
                                        required name="email_usuarios" />
                                </div>

                                <div class="mb-3">
                                    <label for="edit-usuario-senha" class="form-label"> Nova senha </label>
                                    <input type="password" class="form-control" id="edit-usuario-senha"
                                        minlength="6" name="senha_usuarios" autocomplete="new-password"
                                        placeholder="Deixe vazio para manter a senha atual" />
                                </div>

                                <div class="mb-3">

                                    <label for="edit-usuario-imagem" class="form-label"> Selecione uma foto </label>

                                    <input type="file" class="form-control input-banner" id="edit-usuario-imagem"
                                        name="foto_usuarios" accept="image/*" />

                                    <label for="edit-usuario-imagem" class="banner-upload">

                                        <img id="edit-usuario-mostrar" src="" alt="usuário">

                                        <div class="banner-upload">
                                            <i class="bi bi-image"></i>
                                            <span>Deixe vazio para manter a foto atual</span>
                                        </div>

                                    </label>

                                </div>

                                <div class="mb-3">
                                    <label for="edit-usuario-nivel" class="form-label"> Nível </label>
                                    <select id="edit-usuario-nivel" class="form-select" name="nivel_usuarios">
                                        @foreach ($niveis as $nivel)
                                            <option value="{{ $nivel }}">{{ $nivel }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="edit-usuario-status" class="form-label"> Status </label>
                                    <select id="edit-usuario-status" class="form-select" name="status_usuarios">
                                        <option value="ATIVO">Ativo</option>
                                        <option value="INATIVO">Inativo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Atualizar usuário</button>
                            </div>

                        </form>
                        {{-- FIM FORM DE EDITAR --}}
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL EDITAR USUÁRIO  --}}


            {{-- INICIO - MODAL ATIVAR/DESATIVAR USUÁRIO  --}}
            <div class="modal fade" id="modal-status-usuario" tabindex="-1"
                aria-labelledby="modal-status-usuario-titulo" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form id="form-status-usuario" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-status-usuario-titulo">Alterar status do usuário</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <p class="mb-0" id="modal-status-usuario-txt">

                                </p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>

                                <button type="submit" class="btn btn-danger" id="btn-status-usuario">
                                    Confirmar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL ATIVAR/DESATIVAR USUÁRIO  --}}

        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->

</main>


{{-- Carregando a foto do modal cadastrar --}}
<script>
    const inputUsuario = document.getElementById('img-usuario');
    const previewUsuario = document.getElementById('ver-usuario');

    inputUsuario.addEventListener('change', function() {

        const arquivo = this.files[0];

        if (arquivo) {

            previewUsuario.src = URL.createObjectURL(arquivo);

        }

    });
</script>


{{-- Editar usuário --}}
<script>
    const modalEditarUsuario = document.getElementById('modal-edit-usuario');
    const formEditUsuario = document.getElementById('form-edit-usuario');
    const editNome = document.getElementById('edit-usuario-nome');
    const editEmail = document.getElementById('edit-usuario-email');
    const editSenha = document.getElementById('edit-usuario-senha');
    const editNivel = document.getElementById('edit-usuario-nivel');
    const editStatus = document.getElementById('edit-usuario-status');
    const editImagem = document.getElementById('edit-usuario-imagem');
    const editMostrar = document.getElementById('edit-usuario-mostrar');

    // Carregar as informações no modal
    modalEditarUsuario.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        // Form Action
        formEditUsuario.action = botao.getAttribute('data-url');

        // Preencher
        editNome.value = botao.getAttribute('data-nome');
        editEmail.value = botao.getAttribute('data-email');
        editNivel.value = botao.getAttribute('data-nivel');
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


{{-- Ativar e Desativar Usuario --}}
<script>
    const modalStatusUsuario = document.getElementById('modal-status-usuario');
    const formStatusUsuario = document.getElementById('form-status-usuario');
    const tituloStatusUsuario = document.getElementById('modal-status-usuario-titulo');
    const txtStatusUsuario = document.getElementById('modal-status-usuario-txt');
    const btnStatusUsuario = document.getElementById('btn-status-usuario');


    modalStatusUsuario.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        const url = botao.getAttribute('data-url');
        const nome = botao.getAttribute('data-nome');
        const status = botao.getAttribute('data-status');

        formStatusUsuario.action = url;

        if (status === 'ATIVO') {

            tituloStatusUsuario.textContent = 'Desativar usuário';
            txtStatusUsuario.textContent = 'Tem certeza de que deseja desativar o usuário "' + nome + '"?';
            btnStatusUsuario.textContent = 'Desativar';

            btnStatusUsuario.className = 'btn btn-danger'

        } else {

            tituloStatusUsuario.textContent = 'Ativar usuário';
            txtStatusUsuario.textContent = 'Tem certeza de que deseja ativar o usuário "' + nome + '"?';
            btnStatusUsuario.textContent = 'Ativar';

            btnStatusUsuario.className = 'btn btn-success'

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
