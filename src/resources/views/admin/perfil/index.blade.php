@extends('layout.dashboard')

@section('content')

<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Meu perfil</h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Perfil</li>
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
            <div class="row">

                {{-- DADOS DO FUNCIONÁRIO --}}
                <div class="col-lg-4">
                    <div class="card card-comanda mb-4">
                        <div class="card-body text-center">
                            <img src="{{ $usuario->urlFoto() }}" alt="{{ $usuario->nome_usuarios }}"
                                class="rounded-circle shadow mb-3"
                                style="width: 120px; height: 120px; object-fit: cover;">

                            <h3 class="card-title float-none mb-1">{{ $usuario->nome_usuarios }}</h3>

                            <span class="badge text-bg-warning">
                                {{ ucfirst(strtolower($usuario->nivel_usuarios)) }}
                            </span>
                        </div>
                        <div class="card-body p-0">
                            <table class="table align-middle m-0">
                                <tbody>
                                    <tr>
                                        <td>E-mail</td>
                                        <td class="text-end">{{ $usuario->email_usuarios }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td class="text-end">
                                            @if ($usuario->status_usuarios === 'ATIVO')
                                                <span class="badge text-bg-success">Ativo</span>
                                            @else
                                                <span class="badge text-bg-danger">Inativo</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Na equipe desde</td>
                                        <td class="text-end">{{ date('d/m/Y', strtotime($usuario->data_criacao_usuarios)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#modal-edit-perfil">
                                <i class="bi bi-pencil me-1" aria-hidden="true"></i>
                                Editar perfil
                            </button>
                        </div>
                    </div>

                    {{-- PRODUTOS QUE MAIS VENDEU --}}
                    <div class="card card-comanda mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Seus mais vendidos</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table align-middle m-0">
                                <tbody>
                                    @forelse ($maisVendidos as $posicao => $item)
                                        <tr>
                                            <td>{{ $posicao + 1 }}º {{ $item->produto }}</td>
                                            <td class="text-end fw-bold">{{ (int) $item->qtde }} un.</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-muted">Nenhuma venda finalizada ainda.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">

                    {{-- NÚMEROS DO FUNCIONÁRIO --}}
                    <div class="row">
                        <div class="col-6 col-xl-3">
                            <div class="small-box text-bg-primary">
                                <div class="inner">
                                    <h3>{{ $qtdeAtendimentos }}</h3>
                                    <p>Atendimentos</p>
                                </div>
                                <i class="small-box-icon bi bi-people-fill" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <div class="small-box text-bg-warning">
                                <div class="inner">
                                    <h3>{{ $qtdeFinalizadas }}</h3>
                                    <p>Vendas finalizadas</p>
                                </div>
                                <i class="small-box-icon bi bi-check2-circle" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <div class="small-box text-bg-primary">
                                <div class="inner">
                                    <h3 class="text-nowrap">R$ {{ number_format($totalVendido, 2, ',', '.') }}</h3>
                                    <p>Total vendido</p>
                                </div>
                                <i class="small-box-icon bi bi-cash-coin" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <div class="small-box text-bg-warning">
                                <div class="inner">
                                    <h3 class="text-nowrap">R$ {{ number_format($ticketMedio, 2, ',', '.') }}</h3>
                                    <p>Ticket médio</p>
                                </div>
                                <i class="small-box-icon bi bi-receipt" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>

                    {{-- HISTÓRICO DE ATENDIMENTOS --}}
                    <div class="card card-comanda mb-4">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title">Histórico de atendimentos</h3>
                            @if ($qtdeComandasAbertas > 0)
                                <span class="badge text-bg-warning ms-auto">
                                    {{ $qtdeComandasAbertas }} {{ $qtdeComandasAbertas === 1 ? 'comanda aberta' : 'comandas abertas' }}
                                </span>
                            @endif
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Data</th>
                                            <th>Local</th>
                                            <th>Cliente</th>
                                            <th>Status</th>
                                            <th class="text-end">Valor</th>
                                            <th class="text-end">Ver</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($historico as $venda)
                                            <tr>
                                                <td>{{ $venda->id_venda }}</td>
                                                <td class="text-nowrap">{{ date('d/m/Y H:i', strtotime($venda->data_hora_venda)) }}</td>
                                                <td>{{ $venda->local?->nome_local ?? '—' }}</td>
                                                <td>{{ $venda->cliente?->nome_cliente ?? 'Não identificado' }}</td>
                                                <td>
                                                    @if ($venda->status_venda === 'FINALIZADA')
                                                        <span class="badge text-bg-success">Finalizada</span>
                                                    @elseif ($venda->status_venda === 'CANCELADA')
                                                        <span class="badge text-bg-danger">Cancelada</span>
                                                    @else
                                                        <span class="badge text-bg-warning">Em andamento</span>
                                                    @endif
                                                </td>
                                                <td class="text-end text-nowrap">R$ {{ number_format($venda->valor_total_venda, 2, ',', '.') }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('admin.venda.show', $venda->id_venda) }}"
                                                        class="btn btn-sm btn-outline-secondary" aria-label="Abrir comanda {{ $venda->id_venda }}">
                                                        <i class="bi bi-receipt" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4 text-muted">
                                                    Nenhum atendimento registrado ainda.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            @include('partials.admin.paginacao', ['paginacao' => $historico])
                        </div>
                    </div>

                </div>
            </div>


            {{-- INICIO - MODAL EDITAR PERFIL  --}}
            <div class="modal fade" id="modal-edit-perfil" tabindex="-1" aria-labelledby="modal-edit-perfil-label"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <form action="{{ route('admin.perfil.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-edit-perfil-label">Editar perfil</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="perfil-nome" class="form-label"> Nome </label>
                                    <input type="text" class="form-control" id="perfil-nome" maxlength="50" required
                                        name="nome_usuarios" value="{{ old('nome_usuarios', $usuario->nome_usuarios) }}" />
                                </div>

                                <div class="mb-3">
                                    <label for="perfil-email" class="form-label"> E-mail </label>
                                    <input type="email" class="form-control" id="perfil-email" maxlength="80" required
                                        name="email_usuarios" value="{{ old('email_usuarios', $usuario->email_usuarios) }}" />
                                </div>

                                <div class="mb-3">

                                    <label for="perfil-foto" class="form-label"> Foto </label>

                                    <input type="file" class="form-control input-banner" id="perfil-foto"
                                        name="foto_usuarios" accept="image/*" />

                                    <label for="perfil-foto" class="banner-upload">

                                        <img id="perfil-foto-mostrar" src="{{ $usuario->urlFoto() }}" alt="Sua foto">

                                        <div class="banner-upload">
                                            <i class="bi bi-image"></i>
                                            <span>Clique para trocar a foto</span>
                                        </div>

                                    </label>

                                </div>

                                <hr>
                                <p class="mb-2">Trocar senha (deixe em branco para manter a atual)</p>

                                <div class="mb-3">
                                    <label for="perfil-senha-atual" class="form-label"> Senha atual </label>
                                    <input type="password" class="form-control" id="perfil-senha-atual"
                                        name="senha_atual" autocomplete="current-password" />
                                </div>

                                <div class="mb-3">
                                    <label for="perfil-nova-senha" class="form-label"> Nova senha </label>
                                    <input type="password" class="form-control" id="perfil-nova-senha" minlength="6"
                                        name="nova_senha" autocomplete="new-password" />
                                </div>

                                <div class="mb-3">
                                    <label for="perfil-nova-senha-conf" class="form-label"> Confirmar nova senha </label>
                                    <input type="password" class="form-control" id="perfil-nova-senha-conf" minlength="6"
                                        name="nova_senha_confirmation" autocomplete="new-password" />
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Salvar perfil</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            {{-- FIM - MODAL EDITAR PERFIL  --}}

        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>


{{-- Ver a foto nova antes de salvar --}}
<script>
    document.getElementById('perfil-foto').addEventListener('change', function() {

        const arquivo = this.files[0];

        if (arquivo) {
            document.getElementById('perfil-foto-mostrar').src = URL.createObjectURL(arquivo);
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

@endsection
