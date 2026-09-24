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
                    <h1 class="mb-0 fs-3">Comanda #{{ $venda->id_venda }}</h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.venda.index') }}">Vendas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Comanda #{{ $venda->id_venda }}</li>
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

    @php
        $aberta = $venda->status_venda === 'EM ANDAMENTO';
    @endphp

    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">

                {{-- ITENS DA COMANDA --}}
                <div class="col-lg-8">
                    <div class="card card-comanda mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Itens</h3>
                        </div>

                        {{-- ADICIONAR ITEM (só com a comanda aberta) --}}
                        @if ($aberta)
                            <div class="card-body border-bottom">
                                <form action="{{ route('admin.venda.item.store', $venda->id_venda) }}" method="POST"
                                    class="row g-2 align-items-center">
                                    @csrf

                                    <div class="col-12 col-md-7">
                                        <label for="item-produto" class="visually-hidden">Produto</label>
                                        <select id="item-produto" class="form-select" name="id_produto" required>
                                            <option value="">Escolha o produto...</option>
                                            @foreach ($listaProdutos->groupBy(fn($produto) => $produto->categoria?->nome_categoria ?? 'Sem categoria') as $categoria => $produtos)
                                                <optgroup label="{{ $categoria }}">
                                                    @foreach ($produtos as $produto)
                                                        <option value="{{ $produto->id_produto }}">
                                                            {{ $produto->nome_produto }} - R$ {{ number_format($produto->valor_produto, 2, ',', '.') }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-5 col-md-2">
                                        <label for="item-qtde" class="visually-hidden">Quantidade</label>
                                        <input type="number" id="item-qtde" class="form-control" name="qtde_itens_venda"
                                            value="1" min="1" max="99" required>
                                    </div>

                                    <div class="col-7 col-md-3 d-grid">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-plus-lg me-1" aria-hidden="true"></i>
                                            Adicionar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table align-middle m-0">
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th class="text-center">Qtde</th>
                                            <th class="text-end">Unitário</th>
                                            <th class="text-end">Subtotal</th>
                                            @if ($aberta)
                                                <th class="text-end">Remover</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($venda->itens as $item)
                                            <tr>
                                                <td>{{ $item->produto?->nome_produto }}</td>
                                                <td class="text-center">{{ (int) $item->qtde_itens_venda }}</td>
                                                <td class="text-end text-nowrap">R$ {{ number_format($item->valor_unit_itens_venda, 2, ',', '.') }}</td>
                                                <td class="text-end text-nowrap">R$ {{ number_format($item->subtotal_itens_venda, 2, ',', '.') }}</td>
                                                @if ($aberta)
                                                    <td class="text-end">
                                                        <form action="{{ route('admin.venda.item.destroy', [$venda->id_venda, $item->id_itens_venda]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                title="Remover {{ $item->produto?->nome_produto }}"
                                                                aria-label="Remover {{ $item->produto?->nome_produto }}">
                                                                <i class="bi bi-trash" aria-hidden="true"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4 text-muted">
                                                    Nenhum item lançado ainda.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            <div class="float-end fs-5">
                                Total:
                                <strong>R$ {{ number_format($venda->valor_total_venda, 2, ',', '.') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">

                    {{-- DADOS DA COMANDA --}}
                    <div class="card card-comanda mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Dados da comanda</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table align-middle m-0">
                                <tbody>
                                    <tr>
                                        <td>Local</td>
                                        <td class="text-end fw-bold">{{ $venda->local?->nome_local ?? '—' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Cliente</td>
                                        <td class="text-end">{{ $venda->cliente?->nome_cliente ?? 'Não identificado' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Aberta em</td>
                                        <td class="text-end">{{ date('d/m/Y H:i', strtotime($venda->data_hora_venda)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Atendente</td>
                                        <td class="text-end">{{ $venda->usuarios->pluck('nome_usuarios')->join(', ') ?: '—' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Origem</td>
                                        <td class="text-end">{{ $venda->origem_venda === 'APP' ? 'App (QR Code)' : 'Dashboard' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pagamento</td>
                                        <td class="text-end">{{ $venda->forma_pagamento_venda ?? '—' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td class="text-end">
                                            @if ($venda->status_venda === 'FINALIZADA')
                                                <span class="badge text-bg-success">Finalizada</span>
                                            @elseif ($venda->status_venda === 'CANCELADA')
                                                <span class="badge text-bg-danger">Cancelada</span>
                                            @else
                                                <span class="badge text-bg-warning">Em andamento</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($venda->observacao_venda)
                                        <tr>
                                            <td>Observação</td>
                                            <td class="text-end">{{ $venda->observacao_venda }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- FECHAR COMANDA --}}
                    @if ($aberta)
                        <div class="card card-comanda mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Fechar comanda</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.venda.fechar', $venda->id_venda) }}" method="POST"
                                    class="d-grid gap-2">
                                    @csrf
                                    @method('PATCH')

                                    <label for="fechar-pagamento" class="visually-hidden">Forma de pagamento</label>
                                    <select id="fechar-pagamento" class="form-select" name="forma_pagamento_venda" required>
                                        <option value="">Forma de pagamento...</option>
                                        @foreach ($formasPagamento as $forma)
                                            <option value="{{ $forma }}">{{ $forma }}</option>
                                        @endforeach
                                    </select>

                                    <button type="submit" class="btn btn-primary" @disabled($venda->itens->isEmpty())>
                                        <i class="bi bi-check2-circle me-1" aria-hidden="true"></i>
                                        Receber R$ {{ number_format($venda->valor_total_venda, 2, ',', '.') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                    {{-- VOLTAR / CANCELAR / REABRIR --}}
                    <div class="d-flex gap-2 mb-4">
                        <a href="{{ route('admin.venda.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1" aria-hidden="true"></i>
                            Voltar
                        </a>

                        @if ($venda->status_venda !== 'CANCELADA')
                            <button type="button" class="btn btn-outline-danger ms-auto" data-bs-toggle="modal"
                                data-bs-target="#modal-status-venda"
                                data-url="{{ route('admin.venda.status', $venda->id_venda) }}"
                                data-codigo="{{ $venda->id_venda }}"
                                data-status="{{ $venda->status_venda }}">
                                Cancelar venda
                            </button>
                        @else
                            <button type="button" class="btn btn-outline-success ms-auto" data-bs-toggle="modal"
                                data-bs-target="#modal-status-venda"
                                data-url="{{ route('admin.venda.status', $venda->id_venda) }}"
                                data-codigo="{{ $venda->id_venda }}"
                                data-status="CANCELADA">
                                Reabrir venda
                            </button>
                        @endif
                    </div>

                </div>
            </div>

            @include('admin.venda.modalStatus')

        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>


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
