<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Code - {{ $listaLocais->count() === 1 ? $listaLocais->first()->nome_local : 'Todos os locais' }}</title>

    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

    <style>
        body {
            margin: 0;
            padding: 24px;
            background: var(--cor-fundo-1);
            font-family: var(--fonte-texto);
        }

        /* Barra com o botão de imprimir (não sai na impressão) */
        .barra {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .barra button {
            padding: 10px 24px;
            border: 0;
            border-radius: 6px;
            background: var(--cor-destaque);
            color: var(--cor-fundo-1);
            font-family: var(--fonte-texto);
            font-size: 20px;
            cursor: pointer;
        }

        /* Placas lado a lado */
        .placas {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 24px;
        }

        .placa {
            width: 300px;
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
            border: 2px solid var(--cor-primaria);
            text-align: center;
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .placa-topo {
            background: var(--cor-primaria);
            padding: 14px;
        }

        .placa-topo img {
            width: 150px;
        }

        .placa-nome {
            margin: 16px 0 4px;
            font-family: var(--fonte-titulo);
            font-size: 30px;
            color: var(--cor-primaria);
        }

        .placa-qr {
            display: flex;
            justify-content: center;
            padding: 12px;
        }

        .placa-texto {
            margin: 0 16px 6px;
            font-size: 22px;
            color: var(--cor-primaria);
        }

        .placa-codigo {
            margin: 0 0 16px;
            font-size: 14px;
            color: var(--cor-secundaria-1);
            letter-spacing: 1px;
        }

        /* Na impressão: sem fundo, sem botão e com as cores da placa */
        @media print {
            body {
                padding: 0;
                background: #ffffff;
            }

            .barra {
                display: none;
            }

            .placa {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    <div class="barra">
        <button type="button" onclick="window.print()">Imprimir</button>
    </div>

    <div class="placas">
        @forelse ($listaLocais as $local)
            <div class="placa">
                <div class="placa-topo">
                    <img src="{{ asset('barista/img/logo-casa-do-barista.svg') }}" alt="Casa do Barista">
                </div>

                <p class="placa-nome">{{ $local->nome_local }}</p>

                {{-- O QR Code é desenhado aqui pelo JavaScript --}}
                <div class="placa-qr" data-qrcode="{{ $local->urlPedido() }}"></div>

                <p class="placa-texto">Escaneie para fazer seu pedido</p>
                <p class="placa-codigo">{{ strtoupper($local->codigo_local) }}</p>
            </div>
        @empty
            <p>Nenhum local ativo para imprimir.</p>
        @endforelse
    </div>


    {{-- Biblioteca de QR Code (via CDN, igual Bootstrap/ApexCharts) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    {{-- Desenha um QR Code em cada placa --}}
    <script>
        document.querySelectorAll('[data-qrcode]').forEach(function(elemento) {

            new QRCode(elemento, {
                text: elemento.getAttribute('data-qrcode'),
                width: 220,
                height: 220,
                colorDark: '#000000',
                colorLight: '#ffffff',
                correctLevel: QRCode.CorrectLevel.M
            });

        });
    </script>

</body>
</html>
