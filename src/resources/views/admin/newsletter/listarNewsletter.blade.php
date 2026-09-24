<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Newsletter</h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Newsletter</li>
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
                                    <h3 class="card-title">E-mails inscritos</h3>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="d-flex flex-wrap justify-content-md-end gap-2">
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modal-add-newsletter">
                                            <i class="bi bi-envelope-plus me-1" aria-hidden="true"> </i>
                                            Novo e-mail
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

                                            <th>E-mail</th>

                                            <th>Inscrito em</th>

                                            <th>Aceite</th>

                                            <th class="text-end">
                                                Ações
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($listaNewsletter as $newsletter)
                                            <tr>
                                                {{-- ID --}}
                                                <td>
                                                    {{ $newsletter->id_news }}
                                                </td>
                                                {{-- E-mail --}}
                                                <td>
                                                    {{ $newsletter->email_news }}
                                                </td>
                                                {{-- Data --}}
                                                <td>
                                                    {{ date('d/m/Y', strtotime($newsletter->data_criacao_news)) }}
                                                </td>
                                                {{-- Aceite --}}
                                                <td>
                                                    @if ($newsletter->aceite_news == 1)
                                                        <span class="badge text-bg-success">
                                                            Inscrito
                                                        </span>
                                                    @else
                                                        <span class="badge text-bg-warning">
                                                            Cancelado
                                                        </span>
                                                    @endif
                                                </td>
                                                {{-- Ações --}}
                                                <td class="text-end">
                                                    <div class="btn-group btn-group-sm">

                                                        {{-- EDITAR --}}
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-edit-newsletter"
                                                            data-email="{{ $newsletter->email_news }}"
                                                            data-aceite="{{ $newsletter->aceite_news }}"
                                                            data-url="{{ route('admin.newsletter.update', $newsletter->id_news) }}"
                                                            aria-label="Editar">

                                                            <i class="bi bi-pencil" aria-hidden="true"> </i>
                                                        </button>

                                                        {{-- ATIVAR / DESATIVAR --}}
                                                        @if ($newsletter->aceite_news == 1)
                                                            <button type="button" class="btn btn-outline-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-status-newsletter"
                                                                title="Cancelar inscrição"
                                                                data-url="{{ route('admin.newsletter.status', $newsletter->id_news) }}"
                                                                data-email="{{ $newsletter->email_news }}"
                                                                data-aceite="1" aria-label="Cancelar inscrição">

                                                                <i class="bi bi-eye-fill" aria-hidden="true"> </i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-outline-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-status-newsletter"
                                                                title="Reativar inscrição"
                                                                data-url="{{ route('admin.newsletter.status', $newsletter->id_news) }}"
                                                                data-email="{{ $newsletter->email_news }}"
                                                                data-aceite="0" aria-label="Reativar inscrição">

                                                                <i class="bi bi-eye-slash" aria-hidden="true"> </i>
                                                            </button>
                                                        @endif

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4 text-muted">
                                                    Nenhum e-mail cadastrado.
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
                                Total de inscritos:
                                <strong>
                                    {{ $listaNewsletter->where('aceite_news', 1)->count() }}
                                </strong>
                                de {{ $listaNewsletter->count() }}
                            </div>
                        </div>
                        <!--end::Card Footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->

            {{-- INICIO - MODAL CADASTRO NEWSLETTER  --}}
            <div class="modal fade" id="modal-add-newsletter" tabindex="-1"
                aria-labelledby="modal-add-newsletter-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        {{-- FORM DE CADASTRO --}}
                        <form action="{{ route('admin.newsletter.store') }}" method="POST">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-add-newsletter-label">Cadastrar novo e-mail</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="new-newsletter-email" class="form-label"> E-mail </label>
                                    <input type="email" class="form-control" id="new-newsletter-email"
                                        maxlength="80" placeholder="cliente@email.com" required name="email_news"
                                        value="{{ old('email_news') }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="new-newsletter-aceite" class="form-label"> Aceite </label>
                                    <select id="new-newsletter-aceite" class="form-select" name="aceite_news">
                                        <option value="1">Inscrito</option>
                                        <option value="0">Cancelado</option>
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
            {{-- FIM - MODAL CADASTRO NEWSLETTER  --}}


            {{-- INICIO - MODAL EDITAR NEWSLETTER  --}}
            <div class="modal fade" id="modal-edit-newsletter" tabindex="-1"
                aria-labelledby="modal-edit-newsletter-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        {{-- FORM DE EDITAR --}}
                        <form id="form-edit-newsletter" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-edit-newsletter-label">Editar e-mail</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="edit-newsletter-email" class="form-label"> E-mail </label>
                                    <input type="email" class="form-control" id="edit-newsletter-email"
                                        maxlength="80" required name="email_news" />
                                </div>

                                <div class="mb-3">
                                    <label for="edit-newsletter-aceite" class="form-label"> Aceite </label>
                                    <select id="edit-newsletter-aceite" class="form-select" name="aceite_news">
                                        <option value="1">Inscrito</option>
                                        <option value="0">Cancelado</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Atualizar e-mail</button>
                            </div>

                        </form>
                        {{-- FIM FORM DE EDITAR --}}
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL EDITAR NEWSLETTER  --}}


            {{-- INICIO - MODAL ATIVAR/DESATIVAR NEWSLETTER  --}}
            <div class="modal fade" id="modal-status-newsletter" tabindex="-1"
                aria-labelledby="modal-status-newsletter-titulo" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form id="form-status-newsletter" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-status-newsletter-titulo">Alterar inscrição</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <p class="mb-0" id="modal-status-newsletter-txt">

                                </p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>

                                <button type="submit" class="btn btn-danger" id="btn-status-newsletter">
                                    Confirmar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL ATIVAR/DESATIVAR NEWSLETTER  --}}

        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->

</main>


{{-- Editar newsletter --}}
<script>
    const modalEditarNewsletter = document.getElementById('modal-edit-newsletter');
    const formEditNewsletter = document.getElementById('form-edit-newsletter');
    const editEmail = document.getElementById('edit-newsletter-email');
    const editAceite = document.getElementById('edit-newsletter-aceite');

    // Carregar as informações no modal
    modalEditarNewsletter.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        // Form Action
        formEditNewsletter.action = botao.getAttribute('data-url');

        // Preencher
        editEmail.value = botao.getAttribute('data-email');
        editAceite.value = botao.getAttribute('data-aceite');

    });
</script>


{{-- Ativar e Desativar Newsletter --}}
<script>
    const modalStatusNewsletter = document.getElementById('modal-status-newsletter');
    const formStatusNewsletter = document.getElementById('form-status-newsletter');
    const tituloStatusNewsletter = document.getElementById('modal-status-newsletter-titulo');
    const txtStatusNewsletter = document.getElementById('modal-status-newsletter-txt');
    const btnStatusNewsletter = document.getElementById('btn-status-newsletter');


    modalStatusNewsletter.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        const url = botao.getAttribute('data-url');
        const email = botao.getAttribute('data-email');
        const aceite = botao.getAttribute('data-aceite');

        formStatusNewsletter.action = url;

        if (aceite === '1') {

            tituloStatusNewsletter.textContent = 'Cancelar inscrição';
            txtStatusNewsletter.textContent = 'Tem certeza de que deseja cancelar a inscrição de "' + email + '"?';
            btnStatusNewsletter.textContent = 'Cancelar inscrição';

            btnStatusNewsletter.className = 'btn btn-danger'

        } else {

            tituloStatusNewsletter.textContent = 'Reativar inscrição';
            txtStatusNewsletter.textContent = 'Tem certeza de que deseja reativar a inscrição de "' + email + '"?';
            btnStatusNewsletter.textContent = 'Reativar';

            btnStatusNewsletter.className = 'btn btn-success'

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
