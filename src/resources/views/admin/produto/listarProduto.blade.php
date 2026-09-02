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
                        <div class="d-flex flex-wrap justify-content-md-end gap-2">
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
                            />
                          </div>
                          <select
                            id="produto-role-filter"
                            class="form-select form-select-sm w-auto"
                            aria-label="Filter by role"
                          >
                            <option value="all" selected>Todos</option>
                            <option value="ativo">Ativo</option>
                            <option value="inativo">Inativo</option>
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
                                @if($produto->destaque_produto === 1)
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
                                  <button
                                    type="button"
                                    class="btn btn-outline-secondary"
                                    aria-label="Editar"
                                  >
                                    <i class="bi bi-pencil" aria-hidden="true"> </i>
                                  </button>
                                  <button
                                    type="button"
                                    class="btn btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal-delete-produto"
                                    aria-label="Deletar"
                                  >
                                    <i class="bi bi-trash" aria-hidden="true"> </i>
                                  </button>
                                </div>
                              </td>
                            </tr>
                          @empty  
                            <tr>
                              <td
                                  colspan="5"
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
                        {{ $produto -> count()}}
                      </strong>
                    </div>
                    <ul class="pagination pagination-sm m-0 float-end">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous"> &laquo; </a>
                      </li>
                      <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">3</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">4</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">5</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next"> &raquo; </a>
                      </li>
                    </ul>
                  </div>
                  <!--end::Card Footer-->
                </div>
                <!--end::Card-->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->

            <!--begin::Add produto Modal-->
            <div
              class="modal fade"
              id="modal-add-produto"
              tabindex="-1"
              aria-labelledby="modal-add-produto-label"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <form>
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
                        <label for="new-produto-name" class="form-label"> Nome Produto </label>
                        <input
                          type="text"
                          class="form-control"
                          id="new-produto-name"
                          placeholder="Café em xícara"
                          required
                        />
                      </div>
                      <div class="mb-3">
                        <label for="new-produto-role" class="form-label"> Categoria </label>
                        <select id="new-produto-role" class="form-select">
                          <option selected>CAFÉ</option>
                          <option>PROMOÇÃO</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="new-produto-name" class="form-label"> Descrição curta </label>
                        <input
                          type="text"
                          class="form-control"
                          id="new-produto-name"
                          placeholder="Café em xícara"
                          required
                        />
                      </div>
                      <div class="mb-3">
                        <label for="new-produto-name" class="form-label"> Descrição Longa </label>
                        <textarea
                          type="text"
                          class="form-control"
                          id="new-produto-name"
                          placeholder="Café em xícara"
                          required
                        >
                        </textarea>
                      </div>
                      <div class="mb-3">                        
                        <label for="new-produto-role" class="form-label"> Selecione uma imagem </label>
                        <div class="input-group">
                          <input type="file" class="form-control" id="inputGroupFile02" />
                          <label class="input-group-text" for="inputGroupFile02">Carregar...</label>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="new-produto-role" class="form-label"> Status </label>
                        <select id="new-produto-role" class="form-select">
                          <option selected>Ativo</option>
                          <option>Inativo</option>
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
            <!--end::Add produto Modal-->

            <!--begin::Delete produto Modal-->
            <div
              class="modal fade"
              id="modal-delete-produto"
              tabindex="-1"
              aria-labelledby="modal-delete-produto-label"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modal-delete-produto-label">Deletar produto</h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    ></button>
                  </div>
                  <div class="modal-body">
                    <p class="mb-0">
                      Tem certeza de que deseja excluir este produto? <br>
                      Todo o conteúdo pertencente à conta será transferido 
                      para o administrador do site. Esta ação não pode ser desfeita.
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                      Cancelar
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                      Deletar produto
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!--end::Delete produto Modal-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>