<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Casa do Barista</title>

    {{-- Mesmos estilos do dashboard (AdminLTE + identidade da Casa do Barista) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/estilo-admin.css') }}">

    <style>
        body {
            background: var(--cor-fundo-1);
        }

        .api-topo {
            background: #0b0b0b;
            padding: 20px 0;
        }

        .api-topo img {
            width: 150px;
        }

        /* Títulos e textos sobre o card marrom */
        .card .card-title,
        .card .card-footer {
            color: var(--cor-fundo-1);
        }

        th {
            color: var(--cor-fundo-1) !important;
        }

        td code {
            color: var(--cor-primaria);
            word-break: break-word;
        }

        .metodo {
            min-width: 62px;
            font-family: var(--fonte-texto);
            letter-spacing: .5px;
        }

        .badge-implementado {
            background: var(--cor-destaque);
            color: var(--cor-fundo-1);
        }

        .badge-previsto {
            background: #cdbba8;
            color: var(--cor-texto);
        }

        pre.exemplo {
            background: var(--cor-fundo-2);
            color: var(--cor-fundo-1);
            border-radius: 6px;
            padding: 16px;
            margin: 0;
        }

        .aviso-api {
            border-left: 4px solid var(--cor-secundaria-2);
            background: #fff8;
            padding: 12px 16px;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    {{-- TOPO --}}
    <header class="api-topo">
        <div class="container text-center">
            <img src="{{ asset('barista/img/logo-casa-do-barista.svg') }}" alt="Casa do Barista">
        </div>
    </header>

    <main class="py-4">
        <div class="container">

            {{-- TITULO --}}
            <div class="row mb-3">
                <div class="col-sm-8">
                    <h1 class="mb-0 fs-3">Documentação da API</h1>
                    <p class="mb-0">Casa do Barista - API REST v1</p>
                </div>
                <div class="col-sm-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Site</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Documentação da API</li>
                        </ol>
                    </nav>
                </div>
            </div>

            {{-- INFORMAÇÕES --}}
            <div class="aviso-api mb-4">
                <p class="mb-2">
                    Documentação dos endpoints para integração com o aplicativo do cliente. O aplicativo atende
                    clientes sentados em uma mesa, identificada exclusivamente por um QR Code. Diferentes clientes
                    autenticados podem participar do mesmo atendimento; cada item registra quem o solicitou. O
                    pagamento é presencial e o encerramento é confirmado pela equipe.
                </p>
                <p class="mb-2">
                    <strong>URL base:</strong> <code>{{ url('/api/v1') }}</code>
                </p>
                <p class="mb-0">
                    <span class="badge badge-implementado">Implementado</span> endpoint disponível.
                    <span class="badge badge-previsto">Previsto</span> endpoint planejado; a resposta indicada é a
                    sugerida.
                </p>
            </div>

            @php
                // Formato padrão: success (bool), message (string) e data (objeto/lista).
                // Último item = true quando o endpoint já existe em routes/api.php
                $secoes = [
                    '1. Sistema e leitura da mesa' => [
                        ['GET', '/status', 'Monitorar saúde da API', '200: { success, data: { aplicacao, api, status } }', true],
                        ['POST', '/mesas/validar-qr', 'Validar token da mesa, disponibilidade e contexto', '200: { success, data: { id_mesa, numero, disponivel } } | 404 mesa inválida', false],
                    ],
                    '2. Conta e autenticação do cliente' => [
                        ['POST', '/auth/cadastro', 'Criar conta; e-mail único; senha hash', '201: { success, data: { cliente, token } } | 422 validação', false],
                        ['POST', '/auth/login', 'Autenticar e emitir token', '200: { success, data: { cliente, token } } | 401 credenciais inválidas', false],
                        ['POST', '/auth/logout', 'Revogar token atual', '200: { success, message }', false],
                        ['GET', '/auth/me', 'Obter identidade autenticada', '200: { success, data: { cliente } }', false],
                        ['POST', '/auth/esqueci-senha', 'Solicitar recuperação de acesso', '200: { success, message } (sempre genérica)', false],
                        ['POST', '/auth/redefinir-senha', 'Validar token e atualizar senha', '200: { success, message } | 422 token inválido', false],
                    ],
                    '3. Home e cardápio' => [
                        ['GET', '/categorias', 'Listar categorias ativas', '200: { success, total, data: [categoria] }', false],
                        ['GET', '/produto', 'Listar produtos ativos em ordem alfabética (rota atual; no catálogo: /produtos, com busca, categoria e destaque)', '200: { success, message, total, data: [produto] }', true],
                        ['GET', '/produtos/{id}', 'Detalhes de produto disponível', '200: { success, data: produto } | 404', false],
                        ['GET', '/produtos/{id}/opcoes', 'Personalizações configuradas, se houver', '200: { success, data: [opcao] }', false],
                    ],
                    '4. Atendimento e pedidos compartilhados' => [
                        ['POST', '/atendimentos/participar', 'Ingressar/associar cliente a uma mesa validada', '200: { success, data: { id_atendimento, mesa } }', false],
                        ['GET', '/atendimentos/atual', 'Consultar atendimento corrente do cliente', '200: { success, data: atendimento } | 404 sem atendimento', false],
                        ['GET', '/atendimentos/{id}', 'Consultar resumo, itens, totais e status', '200: { success, data: { itens, total, status } }', false],
                        ['POST', '/atendimentos/{id}/itens', 'Registrar quantidade, observação, autor e preço', '201: { success, data: item } | 422', false],
                        ['GET', '/atendimentos/{id}/status', 'Consultar status para atualização periódica', '200: { success, data: { status, atualizado_em } }', false],
                        ['POST', '/atendimentos/{id}/chamados', 'Pedir auxílio/alteração/cancelamento', '201: { success, data: chamado }', false],
                        ['POST', '/atendimentos/{id}/fechamento', 'Solicitar fechamento e informar participantes', '200: { success, message }', false],
                        ['POST', '/atendimentos/{id}/avaliacao', 'Avaliar visita concluída', '201: { success, message } | 422', false],
                    ],
                    '5. Perfil e histórico' => [
                        ['GET', '/perfil', 'Consultar dados cadastrais', '200: { success, data: cliente }', false],
                        ['PATCH', '/perfil', 'Atualizar nome, telefone e foto autorizados', '200: { success, data: cliente } | 422', false],
                        ['GET', '/perfil/visitas', 'Listar somente visitas do usuário', '200: { success, total, data: [visita] }', false],
                        ['GET', '/perfil/visitas/{id}', 'Detalhes de visita autorizada', '200: { success, data: visita } | 403/404', false],
                    ],
                ];

                $cores = ['GET' => 'success', 'POST' => 'warning', 'PATCH' => 'danger', 'PUT' => 'danger', 'DELETE' => 'danger'];
            @endphp

            {{-- ENDPOINTS --}}
            @foreach ($secoes as $titulo => $endpoints)
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">{{ $titulo }}</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle m-0">
                                <thead>
                                    <tr>
                                        <th>Método</th>
                                        <th>Rota (relativa a /api/v1)</th>
                                        <th>Finalidade</th>
                                        <th>Situação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($endpoints as [$metodo, $rota, $finalidade, $resposta, $ok])
                                        <tr>
                                            <td>
                                                <span class="badge metodo text-bg-{{ $cores[$metodo] ?? 'success' }}">{{ $metodo }}</span>
                                            </td>
                                            <td><code>{{ $rota }}</code></td>
                                            <td>{{ $finalidade }}</td>
                                            <td>
                                                <button type="button"
                                                    class="badge border-0 {{ $ok ? 'badge-implementado' : 'badge-previsto' }}"
                                                    data-bs-toggle="modal" data-bs-target="#modal-resposta"
                                                    data-metodo="{{ $metodo }}"
                                                    data-url="{{ url('/api/v1' . $rota) }}"
                                                    data-rota="{{ $rota }}"
                                                    data-resposta="{{ $resposta }}"
                                                    data-implementado="{{ $ok ? '1' : '0' }}"
                                                    title="Ver resposta">
                                                    <i class="bi {{ $ok ? 'bi-play-fill' : 'bi-eye' }}"></i>
                                                    {{ $ok ? 'Implementado' : 'Previsto' }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small>{{ count($endpoints) }} endpoint(s)</small>
                    </div>
                </div>
            @endforeach

        </div>
    </main>

    <footer class="app-footer">
        <div class="container">
            <strong>
                Criado e desenvolvido por TIPI06 - &copy; 2026&nbsp;
                <a href="https://casadobarista.com.br" class="text-decoration-none">CASA DO BARISTA</a>.
            </strong>
            Todos os direitos reservados.
        </div>
    </footer>

    {{-- MODAL: RESPOSTA DINÂMICA DO ENDPOINT --}}
    <div class="modal fade" id="modal-resposta" tabindex="-1" aria-labelledby="modal-resposta-titulo"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-resposta-titulo">Resposta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-1"><strong>Resposta documentada</strong>
                        <span class="badge badge-previsto" id="resp-situacao"></span>
                    </p>
                    <pre class="exemplo mb-3"><code id="resp-doc"></code></pre>

                    <div id="resp-dinamica">
                        <p class="mb-2"><strong>Resposta em tempo real</strong>
                            <span class="badge text-bg-success" id="resp-status">-</span>
                            <code id="resp-url"></code>
                            <small class="ms-2" id="resp-tempo"></small>
                        </p>
                        <pre class="exemplo" id="resp-corpo">Carregando...</pre>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="resp-recarregar">
                        <i class="bi bi-arrow-clockwise"></i> Executar novamente
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" crossorigin="anonymous">
    </script>
    <script>
        const modalResposta = document.getElementById('modal-resposta');
        const respTitulo = document.getElementById('modal-resposta-titulo');
        const respStatus = document.getElementById('resp-status');
        const respUrl = document.getElementById('resp-url');
        const respTempo = document.getElementById('resp-tempo');
        const respCorpo = document.getElementById('resp-corpo');
        let requisicao = {};

        // Chama o endpoint de verdade e mostra o retorno
        async function executar() {
            respStatus.textContent = '...';
            respStatus.className = 'badge text-bg-warning';
            respTempo.textContent = '';
            respCorpo.textContent = 'Carregando...';

            const inicio = performance.now();

            try {
                const resposta = await fetch(requisicao.url, {
                    method: requisicao.metodo,
                    headers: { 'Accept': 'application/json' }
                });
                const texto = await resposta.text();

                let corpo = texto;
                try {
                    corpo = JSON.stringify(JSON.parse(texto), null, 4);
                } catch (e) {}

                respStatus.textContent = resposta.status + ' ' + resposta.statusText;
                respStatus.className = 'badge ' + (resposta.ok ? 'text-bg-success' : 'text-bg-danger');
                respCorpo.textContent = corpo;
            } catch (erro) {
                respStatus.textContent = 'Erro';
                respStatus.className = 'badge text-bg-danger';
                respCorpo.textContent = 'Não foi possível chamar o endpoint: ' + erro.message;
            }

            respTempo.textContent = Math.round(performance.now() - inicio) + ' ms';
        }

        modalResposta.addEventListener('show.bs.modal', function(event) {
            const botao = event.relatedTarget;

            const implementado = botao.getAttribute('data-implementado') === '1';

            requisicao = {
                metodo: botao.getAttribute('data-metodo'),
                url: botao.getAttribute('data-url')
            };

            respTitulo.textContent = requisicao.metodo + ' /api/v1' + botao.getAttribute('data-rota');
            respUrl.textContent = requisicao.url;
            document.getElementById('resp-doc').textContent = botao.getAttribute('data-resposta');

            const situacao = document.getElementById('resp-situacao');
            situacao.textContent = implementado ? 'Implementado' : 'Previsto';
            situacao.className = 'badge ' + (implementado ? 'badge-implementado' : 'badge-previsto');

            // Resposta em tempo real só existe para endpoints implementados
            document.getElementById('resp-dinamica').hidden = !implementado;
            document.getElementById('resp-recarregar').hidden = !implementado;

            if (implementado) {
                executar();
            }
        });

        document.getElementById('resp-recarregar').addEventListener('click', executar);
    </script>

</body>

</html>
