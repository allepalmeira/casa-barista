<main class="app-main" id="main" tabindex="-1">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-3">Galeria</h1>
        </div>
        <div class="col-sm-6">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Galeria</li>
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
      <!--begin::Card-->
      <div class="card">
        <!--begin::Card Header-->
        <div class="card-header d-flex flex-wrap align-items-center gap-2">
          <div class="card-title">Nossa galeria</div>
          <div class="card-tools">            
            {{-- FILTRO POR STATUS (enviado pela URL) --}}
            <div class="btn-group btn-group-sm" role="group" aria-label="Filtrar por status" id="gallery-filters">
              @foreach(['all' => 'TODAS', 'ativo' => 'ATIVO', 'inativo' => 'INATIVO'] as $valor => $texto)
              <a href="{{ route('admin.galeria.index', $valor === 'all' ? [] : ['status' => $valor]) }}"
                class="btn {{ $status === $valor ? 'btn-primary' : 'btn-outline-primary btn-categoria' }}"
                aria-pressed="{{ $status === $valor ? 'true' : 'false' }}">
                {{ $texto }}
              </a>
              @endforeach
            </div>
          </div>
        </div>
        <!--end::Card Header-->
        <!--begin::Card Body-->
        <div class="card-body">
          <!--begin::Gallery Grid-->
          <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xxl-4 g-3" id="gallery-grid">
            @forelse($listaGaleria as $galeria)
              <div class="col" data-gallery-item="places">
                <figure class="card h-100 mb-0">
                  <div class="ratio ratio-4x3">
                    <img src="{{ asset('barista/img/' . $galeria->imagem_galeria) }}" alt="Old town at dusk" class="card-img-top object-fit-cover" loading="lazy">
                  </div>
                  <figcaption class="card-body d-flex align-items-start gap-2 py-2">
                    <div class="flex-grow-1 overflow-hidden">
                      <p class="fw-semibold mb-0 text-truncate">{{ $galeria->nome_galeria }}</p>
                      <p class="fs-7 text-secondary mb-0">
                        @if($galeria->status_galeria === 'ATIVO')
                          <span class="badge text-bg-success">
                            ATIVO
                          </span>
                        @else
                          <span class="badge text-bg-warning">
                            INATIVO
                          </span>
                        @endif</p>
                    </div>
                    <div class="dropdown flex-shrink-0">
                      <button class="btn btn-tool" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Actions for {{ $galeria->nome_galeria}}">
                        <i class="bi bi-three-dots-vertical" aria-hidden="true"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                          <a class="dropdown-item" href="#">Download</a>
                        </li>
                        <li>
                          {{-- EDITAR --}}
                          <a class="dropdown-item" href="#"
                            data-bs-toggle="modal" data-bs-target="#modal-edit-galeria"
                            data-id="{{ $galeria->id_galeria }}"
                            data-nome="{{ $galeria->nome_galeria }}"
                            data-status="{{ $galeria->status_galeria }}"
                            data-image="{{ asset('barista/img/' . $galeria->imagem_galeria) }}"
                            data-url="{{ route('admin.galeria.update', $galeria->id_galeria) }}">Renomear</a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                          {{-- ATIVAR / DESATIVAR --}}
                          <a class="dropdown-item text-danger" href="#"
                            data-bs-toggle="modal" data-bs-target="#modal-status-galeria"
                            data-url="{{ route('admin.galeria.status', $galeria->id_galeria) }}"
                            data-nome="{{ $galeria->nome_galeria }}"
                            data-status="{{ $galeria->status_galeria }}"> Deletar </a>
                        </li>
                      </ul>
                    </div>
                  </figcaption>
                </figure>
              </div>
            @empty
            <div class="col" data-gallery-item="places">
              <p>Nenhum cadastro encontrado.</p>
            </div>
            @endforelse            
          </div>
          <!--end::Gallery Grid-->
          <!--begin::Empty State-->
          <p class="text-secondary text-center my-5" id="gallery-empty" role="status" hidden="">
            Nothing in this category yet.
          </p>
          <!--end::Empty State-->
        </div>
        <!--end::Card Body-->
        <!--begin::Card Footer-->
        <div class="card-footer d-flex flex-wrap justify-content-between align-items-center gap-2">
          <span class="fs-7 text-body-secondary" id="gallery-count" aria-live="polite">
            Carregando {{ $listaGaleria -> count() }} de {{ $totalGaleria }} items
          </span>
          <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
            data-bs-target="#modal-add-galeria">
            <i class="bi bi-upload me-1" aria-hidden="true"></i> Nova Imagem
          </button>
        </div>
        <!--end::Card Footer-->
      </div>
      <!--end::Card-->

      {{-- INICIO - MODAL CADASTRO GALERIA  --}}
      <div class="modal fade" id="modal-add-galeria" tabindex="-1" aria-labelledby="modal-add-galeria-label"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            {{-- FORM DE CADASTRO --}}
            <form action="{{ route('admin.galeria.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="modal-header">
                <h5 class="modal-title" id="modal-add-galeria-label">Cadastrar nova imagem</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body">

                <div class="mb-3">
                  <label for="new-galeria-nome" class="form-label"> Nome da imagem </label>
                  <input type="text" class="form-control" id="new-galeria-nome"
                    placeholder="Área externa" required name="nome_galeria" />
                </div>

                <div class="mb-3">

                  <label for="img-galeria" class="form-label"> Selecione uma imagem </label>
                  <input type="file" class="form-control input-banner" id="img-galeria"
                    name="imagem_galeria" accept="image/*" required />

                  <label for="img-galeria" class="banner-upload">

                    <img id="ver-galeria" src="{{ asset('admin/assets/img/sem-banner.svg') }}"
                      alt="Selecione uma imagem para a galeria">

                    <div class="banner-upload">
                      <i class="bi bi-image"></i>
                      <span>Clique para selecionar a imagem</span>
                    </div>

                  </label>

                </div>

                <div class="mb-3">
                  <label for="new-galeria-status" class="form-label"> Status </label>
                  <select id="new-galeria-status" class="form-select" name="status_galeria">
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
      {{-- FIM - MODAL CADASTRO GALERIA  --}}


      {{-- INICIO - MODAL EDITAR GALERIA  --}}
      <div class="modal fade" id="modal-edit-galeria" tabindex="-1" aria-labelledby="modal-edit-galeria-label"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            {{-- FORM DE EDITAR --}}
            <form id="form-edit-galeria" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="modal-header">
                <h5 class="modal-title" id="modal-edit-galeria-label">Editar imagem</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body">

                <div class="mb-3">
                  <label for="edit-galeria-nome" class="form-label"> Nome da imagem </label>
                  <input type="text" class="form-control" id="edit-galeria-nome" required
                    name="nome_galeria" />
                </div>

                <div class="mb-3">

                  <label for="edit-galeria-imagem" class="form-label"> Selecione uma imagem </label>

                  <input type="file" class="form-control input-banner" id="edit-galeria-imagem"
                    name="imagem_galeria" accept="image/*" />

                  <label for="edit-galeria-imagem" class="banner-upload">

                    <img id="edit-galeria-mostrar" src="" alt="galeria">

                    <div class="banner-upload">
                      <i class="bi bi-image"></i>
                      <span>Deixe vazio para manter a imagem atual</span>
                    </div>

                  </label>

                </div>

                <div class="mb-3">
                  <label for="edit-galeria-status" class="form-label"> Status </label>
                  <select id="edit-galeria-status" class="form-select" name="status_galeria">
                    <option value="ATIVO">Ativo</option>
                    <option value="INATIVO">Inativo</option>
                  </select>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                  Cancelar
                </button>
                <button type="submit" class="btn btn-primary">Atualizar imagem</button>
              </div>

            </form>
            {{-- FIM FORM DE EDITAR --}}
          </div>
        </div>
      </div>
      {{-- FIM - MODAL EDITAR GALERIA  --}}


      {{-- INICIO - MODAL ATIVAR/DESATIVAR GALERIA  --}}
      <div class="modal fade" id="modal-status-galeria" tabindex="-1"
        aria-labelledby="modal-status-galeria-titulo" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <form id="form-status-galeria" method="POST">
              @csrf
              @method('PATCH')

              <div class="modal-header">
                <h5 class="modal-title" id="modal-status-galeria-titulo">Alterar status da imagem</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body">
                <p class="mb-0" id="modal-status-galeria-txt">

                </p>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                  Cancelar
                </button>

                <button type="submit" class="btn btn-danger" id="btn-status-galeria">
                  Confirmar
                </button>
              </div>

            </form>
          </div>
        </div>
      </div>
      {{-- FIM - MODAL ATIVAR/DESATIVAR GALERIA  --}}

    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content-->
</main>


{{-- Carregando a foto do modal cadastrar --}}
<script>
    const inputGaleria = document.getElementById('img-galeria');
    const previewGaleria = document.getElementById('ver-galeria');

    inputGaleria.addEventListener('change', function() {

        const arquivo = this.files[0];

        if (arquivo) {

            previewGaleria.src = URL.createObjectURL(arquivo);

        }

    });
</script>


{{-- Editar galeria --}}
<script>
    const modalEditarGaleria = document.getElementById('modal-edit-galeria');
    const formEditGaleria = document.getElementById('form-edit-galeria');
    const editNome = document.getElementById('edit-galeria-nome');
    const editStatus = document.getElementById('edit-galeria-status');
    const editImagem = document.getElementById('edit-galeria-imagem');
    const editMostrar = document.getElementById('edit-galeria-mostrar');

    // Carregar as informações no modal
    modalEditarGaleria.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        const nome = botao.getAttribute('data-nome');
        const status = botao.getAttribute('data-status');
        const image = botao.getAttribute('data-image');
        const url = botao.getAttribute('data-url');

        // Form Action
        formEditGaleria.action = url;

        // Preencher
        editNome.value = nome;
        editStatus.value = status;
        editMostrar.src = image;

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


{{-- Ativar e Desativar Galeria --}}
<script>
    const modalStatusGaleria = document.getElementById('modal-status-galeria');
    const formStatusGaleria = document.getElementById('form-status-galeria');
    const tituloStatusGaleria = document.getElementById('modal-status-galeria-titulo');
    const txtStatusGaleria = document.getElementById('modal-status-galeria-txt');
    const btnStatusGaleria = document.getElementById('btn-status-galeria');


    modalStatusGaleria.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        const url = botao.getAttribute('data-url');
        const nome = botao.getAttribute('data-nome');
        const status = botao.getAttribute('data-status');

        formStatusGaleria.action = url;

        if (status === 'ATIVO') {

            tituloStatusGaleria.textContent = 'Desativar imagem';
            txtStatusGaleria.textContent = 'Tem certeza de que deseja desativar a imagem "' + nome + '"?';
            btnStatusGaleria.textContent = 'Desativar';

            btnStatusGaleria.className = 'btn btn-danger'

        } else {

            tituloStatusGaleria.textContent = 'Ativar imagem';
            txtStatusGaleria.textContent = 'Tem certeza de que deseja ativar a imagem "' + nome + '"?';
            btnStatusGaleria.textContent = 'Ativar';

            btnStatusGaleria.className = 'btn btn-success'

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