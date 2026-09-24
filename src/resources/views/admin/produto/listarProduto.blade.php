<main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Produto</h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Produto</li>
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
                        <h3 class="card-title">Produtos cadastrados</h3>
                      </div>
                      <div class="col-12 col-md-8">
                        {{-- PESQUISA E FILTRO (enviados pela URL) --}}
                        <form
                          action="{{ route('admin.produto.index') }}"
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
                              id="produto-search"
                              class="form-control"
                              placeholder="Pesquisar produtos"
                              aria-label="Pesquisar produtos"
                              style="width: 180px"
                              name="busca"
                              value="{{ $busca }}"
                            />
                          </div>
                          <select
                            id="produto-role-filter"
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
                            data-bs-target="#modal-add-produto"
                          >
                            <i class="bi bi-person-plus-fill me-1" aria-hidden="true"> </i>
                            Novo produto
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

                            <th>Foto</th>

                            <th>Produto</th>

                            <th>Categoria</th>

                            <th>Descrição</th>

                            <th>Valor</th>

                            <th>Destaque</th>

                            <th>Status</th>

                            <th class="text-end">
                              Ações
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($listaProdutos as $produto)
                            <tr>
                              {{--ID--}}
                              <td>
                                {{$produto->id_produto}}
                              </td>
                              {{--Imagem--}}
                              <td>
                                @if($produto->imagem_produto)
                                  <img
                                    src="{{ asset('barista/img/' . $produto->imagem_produto) }}"
                                    alt="{{ $produto->nome_produto }}"
                                    class="rounded"
                                    style="
                                        width: 100px;
                                        height: 60px;
                                        object-fit: cover;
                                    "
                                  >
                                @else
                                    <span class="text-muted">
                                        Sem imagem
                                    </span>
                                @endif
                              </td>
                              {{-- Título --}}
                              <td>
                                <span class="badge text-table">
                                  {{ $produto->nome_produto }}
                                </span>
                              </td>
                              {{-- Categoria --}}
                              <td>
                                <span class="badge text-table">
                                  {{ $produto->categoria?->nome_categoria }}
                                </span>
                              </td>
                              {{-- Descrição --}}
                              <td>
                                <span class="badge text-table">
                                  {{ $produto->descricao_curta_produto }}
                                </span>
                              </td>
                              {{-- Valor --}}
                              <td>
                                <span class="badge text-table"> R$
                                  {{ number_format($produto->valor_produto, 2, ',', '.') }}
                                </span>
                              </td>
                              {{-- Destaque --}}
                              <td>
                                @if($produto->destaque_produto == 1)
                                  <span class="badge text-bg-success">
                                    Produto Destaque
                                  </span>
                                @else
                                  <span class="badge text-bg-warning">

                                  </span>
                                @endif
                              </td>
                              {{-- Status --}}
                              <td>
                                @if($produto->status_produto === 'ATIVO')
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
                                    data-bs-target="#modal-edit-produto"
                                    data-nome="{{ $produto->nome_produto }}"
                                    data-categoria="{{ $produto->id_categoria }}"
                                    data-curta="{{ $produto->descricao_curta_produto }}"
                                    data-longa="{{ $produto->descricao_longa_produto }}"
                                    data-valor="{{ $produto->valor_produto }}"
                                    data-destaque="{{ $produto->destaque_produto }}"
                                    data-status="{{ $produto->status_produto }}"
                                    data-image="{{ asset('barista/img/' . $produto->imagem_produto) }}"
                                    data-url="{{ route('admin.produto.update', $produto->id_produto) }}"
                                    aria-label="Editar"
                                  >
                                    <i class="bi bi-pencil" aria-hidden="true"> </i>
                                  </button>

                                  {{-- ATIVAR / DESATIVAR --}}
                                  @if($produto->status_produto === 'ATIVO')
                                    <button
                                      type="button"
                                      class="btn btn-outline-danger"
                                      data-bs-toggle="modal"
                                      data-bs-target="#modal-status-produto"
                                      title="Desativar produto"
                                      data-url="{{ route('admin.produto.status', $produto->id_produto) }}"
                                      data-nome="{{ $produto->nome_produto }}"
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
                                      data-bs-target="#modal-status-produto"
                                      title="Ativar produto"
                                      data-url="{{ route('admin.produto.status', $produto->id_produto) }}"
                                      data-nome="{{ $produto->nome_produto }}"
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
                                  colspan="9"
                                  class="text-center py-4 text-muted"
                              >
                                  Nenhum produto cadastrado.
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
                      Total de produtos:
                      <strong>
                        {{ $listaProdutos -> total()}}
                      </strong>
                    </div>

                    @include('partials.admin.paginacao', ['paginacao' => $listaProdutos])
                  </div>
                  <!--end::Card Footer-->
                </div>
                <!--end::Card-->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->

            {{-- INICIO - MODAL CADASTRO PRODUTO --}}
            <div
              class="modal fade"
              id="modal-add-produto"
              tabindex="-1"
              aria-labelledby="modal-add-produto-label"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="{{ route('admin.produto.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-add-produto-label">Cadastrar novo produto</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="new-produto-nome" class="form-label"> Nome Produto </label>
                        <input
                          type="text"
                          class="form-control"
                          id="new-produto-nome"
                          placeholder="Café em xícara"
                          maxlength="30"
                          required
                          name="nome_produto"
                          value="{{ old('nome_produto') }}"
                        />
                      </div>
                      <div class="mb-3">
                        <label for="new-produto-categoria" class="form-label"> Categoria </label>
                        <select id="new-produto-categoria" class="form-select" name="id_categoria">
                          @foreach($listaCategorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}">{{ $categoria->nome_categoria }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="new-produto-curta" class="form-label"> Descrição curta </label>
                        <input
                          type="text"
                          class="form-control"
                          id="new-produto-curta"
                          placeholder="Café em xícara"
                          maxlength="100"
                          required
                          name="descricao_curta_produto"
                          value="{{ old('descricao_curta_produto') }}"
                        />
                      </div>
                      <div class="mb-3">
                        <label for="new-produto-longa" class="form-label"> Descrição Longa </label>
                        <textarea
                          class="form-control"
                          id="new-produto-longa"
                          placeholder="Café em xícara"
                          name="descricao_longa_produto"
                        >{{ old('descricao_longa_produto') }}</textarea>
                      </div>
                      <div class="mb-3">
                        <label for="new-produto-valor" class="form-label"> Valor (R$) </label>
                        <input
                          type="number"
                          step="0.01"
                          min="0"
                          class="form-control"
                          id="new-produto-valor"
                          placeholder="9.90"
                          required
                          name="valor_produto"
                          value="{{ old('valor_produto') }}"
                        />
                      </div>
                      <div class="mb-3">

                        <label for="img-produto" class="form-label"> Selecione uma imagem </label>
                        <input type="file" class="form-control input-banner" id="img-produto"
                          name="imagem_produto" accept="image/*" required />

                        <label for="img-produto" class="banner-upload">

                          <img id="ver-produto" src="{{ asset('admin/assets/img/sem-banner.svg') }}"
                            alt="Selecione uma imagem para o produto">

                          <div class="banner-upload">
                            <i class="bi bi-image"></i>
                            <span>Clique para selecionar a imagem</span>
                          </div>

                        </label>

                      </div>
                      <div class="mb-3">
                        <label for="new-produto-destaque" class="form-label"> Destaque </label>
                        <select id="new-produto-destaque" class="form-select" name="destaque_produto">
                          <option value="0">Não</option>
                          <option value="1">Sim</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="new-produto-status" class="form-label"> Status </label>
                        <select id="new-produto-status" class="form-select" name="status_produto">
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
            {{-- FIM - MODAL CADASTRO PRODUTO --}}


            {{-- INICIO - MODAL EDITAR PRODUTO --}}
            <div
              class="modal fade"
              id="modal-edit-produto"
              tabindex="-1"
              aria-labelledby="modal-edit-produto-label"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <form id="form-edit-produto" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-edit-produto-label">Editar produto</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="edit-produto-nome" class="form-label"> Nome Produto </label>
                        <input type="text" class="form-control" id="edit-produto-nome" maxlength="30"
                          required name="nome_produto" />
                      </div>
                      <div class="mb-3">
                        <label for="edit-produto-categoria" class="form-label"> Categoria </label>
                        <select id="edit-produto-categoria" class="form-select" name="id_categoria">
                          @foreach($listaCategorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}">{{ $categoria->nome_categoria }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="edit-produto-curta" class="form-label"> Descrição curta </label>
                        <input type="text" class="form-control" id="edit-produto-curta" maxlength="100"
                          required name="descricao_curta_produto" />
                      </div>
                      <div class="mb-3">
                        <label for="edit-produto-longa" class="form-label"> Descrição Longa </label>
                        <textarea class="form-control" id="edit-produto-longa"
                          name="descricao_longa_produto"></textarea>
                      </div>
                      <div class="mb-3">
                        <label for="edit-produto-valor" class="form-label"> Valor (R$) </label>
                        <input type="number" step="0.01" min="0" class="form-control" id="edit-produto-valor"
                          required name="valor_produto" />
                      </div>
                      <div class="mb-3">

                        <label for="edit-produto-imagem" class="form-label"> Selecione uma imagem </label>

                        <input type="file" class="form-control input-banner" id="edit-produto-imagem"
                          name="imagem_produto" accept="image/*" />

                        <label for="edit-produto-imagem" class="banner-upload">

                          <img id="edit-produto-mostrar" src="" alt="produto">

                          <div class="banner-upload">
                            <i class="bi bi-image"></i>
                            <span>Deixe vazio para manter a imagem atual</span>
                          </div>

                        </label>

                      </div>
                      <div class="mb-3">
                        <label for="edit-produto-destaque" class="form-label"> Destaque </label>
                        <select id="edit-produto-destaque" class="form-select" name="destaque_produto">
                          <option value="0">Não</option>
                          <option value="1">Sim</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="edit-produto-status" class="form-label"> Status </label>
                        <select id="edit-produto-status" class="form-select" name="status_produto">
                          <option value="ATIVO">Ativo</option>
                          <option value="INATIVO">Inativo</option>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                      </button>
                      <button type="submit" class="btn btn-primary">Atualizar produto</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            {{-- FIM - MODAL EDITAR PRODUTO --}}


            {{-- INICIO - MODAL ATIVAR/DESATIVAR PRODUTO --}}
            <div
              class="modal fade"
              id="modal-status-produto"
              tabindex="-1"
              aria-labelledby="modal-status-produto-titulo"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <form id="form-status-produto" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-status-produto-titulo">Alterar status do produto</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                      <p class="mb-0" id="modal-status-produto-txt">

                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                      </button>
                      <button type="submit" class="btn btn-danger" id="btn-status-produto">
                        Confirmar
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            {{-- FIM - MODAL ATIVAR/DESATIVAR PRODUTO --}}

          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>


{{-- Carregando a foto do modal cadastrar --}}
<script>
    const inputProduto = document.getElementById('img-produto');
    const previewProduto = document.getElementById('ver-produto');

    inputProduto.addEventListener('change', function() {

        const arquivo = this.files[0];

        if (arquivo) {

            previewProduto.src = URL.createObjectURL(arquivo);

        }

    });
</script>


{{-- Editar produto --}}
<script>
    const modalEditarProduto = document.getElementById('modal-edit-produto');
    const formEditProduto = document.getElementById('form-edit-produto');
    const editNome = document.getElementById('edit-produto-nome');
    const editCategoria = document.getElementById('edit-produto-categoria');
    const editCurta = document.getElementById('edit-produto-curta');
    const editLonga = document.getElementById('edit-produto-longa');
    const editValor = document.getElementById('edit-produto-valor');
    const editDestaque = document.getElementById('edit-produto-destaque');
    const editStatus = document.getElementById('edit-produto-status');
    const editImagem = document.getElementById('edit-produto-imagem');
    const editMostrar = document.getElementById('edit-produto-mostrar');

    // Carregar as informações no modal
    modalEditarProduto.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        // Form Action
        formEditProduto.action = botao.getAttribute('data-url');

        // Preencher
        editNome.value = botao.getAttribute('data-nome');
        editCategoria.value = botao.getAttribute('data-categoria');
        editCurta.value = botao.getAttribute('data-curta');
        editLonga.value = botao.getAttribute('data-longa');
        editValor.value = botao.getAttribute('data-valor');
        editDestaque.value = botao.getAttribute('data-destaque');
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


{{-- Ativar e Desativar Produto --}}
<script>
    const modalStatusProduto = document.getElementById('modal-status-produto');
    const formStatusProduto = document.getElementById('form-status-produto');
    const tituloStatusProduto = document.getElementById('modal-status-produto-titulo');
    const txtStatusProduto = document.getElementById('modal-status-produto-txt');
    const btnStatusProduto = document.getElementById('btn-status-produto');


    modalStatusProduto.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        const url = botao.getAttribute('data-url');
        const nome = botao.getAttribute('data-nome');
        const status = botao.getAttribute('data-status');

        formStatusProduto.action = url;

        if (status === 'ATIVO') {

            tituloStatusProduto.textContent = 'Desativar produto';
            txtStatusProduto.textContent = 'Tem certeza de que deseja desativar o produto "' + nome + '"?';
            btnStatusProduto.textContent = 'Desativar';

            btnStatusProduto.className = 'btn btn-danger'

        } else {

            tituloStatusProduto.textContent = 'Ativar produto';
            txtStatusProduto.textContent = 'Tem certeza de que deseja ativar o produto "' + nome + '"?';
            btnStatusProduto.textContent = 'Ativar';

            btnStatusProduto.className = 'btn btn-success'

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
