<main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Categoria</h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Categoria</li>
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
                        <h3 class="card-title">Categorias cadastradas</h3>
                      </div>
                      <div class="col-12 col-md-8">
                        {{-- PESQUISA E FILTRO (enviados pela URL) --}}
                        <form
                          action="{{ route('admin.categoria.index') }}"
                          data-pesquisa
                          method="GET"
                          class="d-flex flex-wrap justify-content-md-end gap-2"
                        >
                          <div class="input-group input-group-sm w-auto">
                            <span class="input-group-text">
                              <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input
                              type="search"
                              id="categoria-search"
                              class="form-control"
                              placeholder="Pesquisar categorias"
                              aria-label="Pesquisar categorias"
                              style="width: 180px"
                              name="busca"
                              value="{{ $busca }}"
                            />
                          </div>
                          <select
                            id="categoria-role-filter"
                            class="form-select form-select-sm w-auto"
                            aria-label="Filtrar por status"
                            name="status"
                            onchange="this.form.submit()"
                          >
                            <option value="all" @selected($status === 'all')>Todos</option>
                            <option value="ativo" @selected($status === 'ativo')>Ativo</option>
                            <option value="inativo" @selected($status === 'inativo')>Inativo</option>
                          </select>
                          <button
                            type="button"
                            class="btn btn-sm btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modal-add-categoria"
                          >
                            <i class="bi bi-person-plus-fill me-1" aria-hidden="true"> </i>
                            Nova categoria
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

                            <th>Categoria</th>

                            <th>Status</th>

                            <th class="text-end">
                              Ações
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($listaCategorias as $categoria)
                            <tr>
                              {{--ID--}}
                              <td>
                                {{$categoria->id_categoria}}
                              </td>
                              {{-- Nome --}}
                              <td>
                                <span class="badge text-table">
                                  {{ $categoria->nome_categoria }}
                                </span>
                              </td>
                              {{-- Status --}}
                              <td>
                                @if($categoria->status_categoria === 'ATIVO')
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
                                  <button
                                    type="button"
                                    class="btn btn-outline-secondary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal-edit-categoria"
                                    data-nome="{{ $categoria->nome_categoria }}"
                                    data-status="{{ $categoria->status_categoria }}"
                                    data-url="{{ route('admin.categoria.update', $categoria->id_categoria) }}"
                                    aria-label="Editar"
                                  >
                                    <i class="bi bi-pencil" aria-hidden="true"> </i>
                                  </button>

                                  {{-- ATIVAR / DESATIVAR --}}
                                  @if($categoria->status_categoria === 'ATIVO')
                                    <button
                                      type="button"
                                      class="btn btn-outline-danger"
                                      data-bs-toggle="modal"
                                      data-bs-target="#modal-status-categoria"
                                      title="Desativar categoria"
                                      data-url="{{ route('admin.categoria.status', $categoria->id_categoria) }}"
                                      data-nome="{{ $categoria->nome_categoria }}"
                                      data-status="ATIVO"
                                      aria-label="Desativar"
                                    >
                                      <i class="bi bi-eye-fill" aria-hidden="true"> </i>
                                    </button>
                                  @else
                                    <button
                                      type="button"
                                      class="btn btn-outline-success"
                                      data-bs-toggle="modal"
                                      data-bs-target="#modal-status-categoria"
                                      title="Ativar categoria"
                                      data-url="{{ route('admin.categoria.status', $categoria->id_categoria) }}"
                                      data-nome="{{ $categoria->nome_categoria }}"
                                      data-status="INATIVO"
                                      aria-label="Ativar"
                                    >
                                      <i class="bi bi-eye-slash" aria-hidden="true"> </i>
                                    </button>
                                  @endif

                                </div>
                              </td>
                            </tr>
                          @empty
                            <tr>
                              <td
                                  colspan="5"
                                  class="text-center py-4 text-muted"
                              >
                                  Nenhuma categoria cadastrada.
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
                      Total de categorias:
                      <strong>
                        {{ $listaCategorias -> total()}}
                      </strong>
                    </div>

                    @include('partials.admin.paginacao', ['paginacao' => $listaCategorias])
                  </div>
                  <!--end::Card Footer-->
                </div>
                <!--end::Card-->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->

            {{-- INICIO - MODAL CADASTRO CATEGORIA --}}
            <div
              class="modal fade"
              id="modal-add-categoria"
              tabindex="-1"
              aria-labelledby="modal-add-categoria-label"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="{{ route('admin.categoria.store') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-add-categoria-label">Cadastrar nova categoria</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="new-categoria-name" class="form-label"> Nome categoria </label>
                        <input
                          type="text"
                          class="form-control"
                          id="new-categoria-name"
                          placeholder="Café em xícara"
                          required
                          name="nome_categoria"
                        />
                      </div>
                      <div class="mb-3">
                        <label for="new-categoria-role" class="form-label"> Status </label>
                        <select id="new-categoria-role" class="form-select" name="status_categoria">
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
                </div>
              </div>
            </div>
            {{-- FIM - MODAL CADASTRO CATEGORIA --}}


            {{-- INICIO - MODAL EDITAR CATEGORIA --}}
            <div
              class="modal fade"
              id="modal-edit-categoria"
              tabindex="-1"
              aria-labelledby="modal-edit-categoria-label"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <form id="form-edit-categoria" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-edit-categoria-label">Editar categoria</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="edit-categoria-nome" class="form-label"> Nome categoria </label>
                        <input
                          type="text"
                          class="form-control"
                          id="edit-categoria-nome"
                          required
                          name="nome_categoria"
                        />
                      </div>
                      <div class="mb-3">
                        <label for="edit-categoria-status" class="form-label"> Status </label>
                        <select id="edit-categoria-status" class="form-select" name="status_categoria">
                          <option value="ATIVO">Ativo</option>
                          <option value="INATIVO">Inativo</option>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                      </button>
                      <button type="submit" class="btn btn-primary">Atualizar categoria</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            {{-- FIM - MODAL EDITAR CATEGORIA --}}


            {{-- INICIO - MODAL ATIVAR/DESATIVAR CATEGORIA --}}
            <div
              class="modal fade"
              id="modal-status-categoria"
              tabindex="-1"
              aria-labelledby="modal-status-categoria-titulo"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <form id="form-status-categoria" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-status-categoria-titulo">Alterar status da categoria</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                      <p class="mb-0" id="modal-status-categoria-txt">

                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                      </button>
                      <button type="submit" class="btn btn-danger" id="btn-status-categoria">
                        Confirmar
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            {{-- FIM - MODAL ATIVAR/DESATIVAR CATEGORIA --}}

          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>


{{-- Editar categoria --}}
<script>
    const modalEditarCategoria = document.getElementById('modal-edit-categoria');
    const formEditCategoria = document.getElementById('form-edit-categoria');
    const editNome = document.getElementById('edit-categoria-nome');
    const editStatus = document.getElementById('edit-categoria-status');

    // Carregar as informações no modal
    modalEditarCategoria.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        // Form Action
        formEditCategoria.action = botao.getAttribute('data-url');

        // Preencher
        editNome.value = botao.getAttribute('data-nome');
        editStatus.value = botao.getAttribute('data-status');

    });
</script>


{{-- Ativar e Desativar Categoria --}}
<script>
    const modalStatusCategoria = document.getElementById('modal-status-categoria');
    const formStatusCategoria = document.getElementById('form-status-categoria');
    const tituloStatusCategoria = document.getElementById('modal-status-categoria-titulo');
    const txtStatusCategoria = document.getElementById('modal-status-categoria-txt');
    const btnStatusCategoria = document.getElementById('btn-status-categoria');


    modalStatusCategoria.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        const url = botao.getAttribute('data-url');
        const nome = botao.getAttribute('data-nome');
        const status = botao.getAttribute('data-status');

        formStatusCategoria.action = url;

        if (status === 'ATIVO') {

            tituloStatusCategoria.textContent = 'Desativar categoria';
            txtStatusCategoria.textContent = 'Tem certeza de que deseja desativar a categoria "' + nome + '"?';
            btnStatusCategoria.textContent = 'Desativar';

            btnStatusCategoria.className = 'btn btn-danger'

        } else {

            tituloStatusCategoria.textContent = 'Ativar categoria';
            txtStatusCategoria.textContent = 'Tem certeza de que deseja ativar a categoria "' + nome + '"?';
            btnStatusCategoria.textContent = 'Ativar';

            btnStatusCategoria.className = 'btn btn-success'

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
