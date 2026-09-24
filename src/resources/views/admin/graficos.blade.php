{{-- LINHA 1 - FATURAMENTO MENSAL + RESUMO --}}
<div class="row">

  {{-- Faturamento dos últimos 12 meses --}}
  <div class="col-lg-8">
    <div class="card card-grafico mb-4">
      <div class="card-header">
        <h3 class="card-title">Faturamento dos últimos 12 meses</h3>
      </div>
      <div class="card-body">
        <div id="grafico-meses" role="img" aria-label="Faturamento por mês, vendas finalizadas, nos últimos 12 meses"></div>
      </div>
    </div>
  </div>

  {{-- Resumo em números --}}
  <div class="col-lg-4">
    <div class="card card-grafico mb-4">
      <div class="card-header">
        <h3 class="card-title">Resumo</h3>
      </div>
      <div class="card-body p-0">
        <table class="table align-middle m-0">
          <tbody>
            <tr>
              <td>Vendas finalizadas</td>
              <td class="text-end fw-bold">{{ $qtdeVendas }}</td>
            </tr>
            <tr>
              <td>Ticket médio</td>
              <td class="text-end fw-bold">R$ {{ number_format($ticketMedio, 2, ',', '.') }}</td>
            </tr>
            <tr>
              <td>
                <a href="{{ route('admin.depoimento.index') }}">Depoimentos pendentes</a>
              </td>
              <td class="text-end fw-bold">{{ $qtdeDepoimentosPendentes }}</td>
            </tr>
            <tr>
              <td>Nota média dos depoimentos</td>
              <td class="text-end fw-bold">
                {{ number_format($notaMediaDepoimentos, 1, ',', '.') }}
                <i class="bi bi-star-fill" aria-hidden="true"></i>
              </td>
            </tr>
            <tr>
              <td>
                <a href="{{ route('admin.newsletter.index') }}">Inscritos na newsletter</a>
              </td>
              <td class="text-end fw-bold">{{ $qtdeInscritos }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>


{{-- LINHA 2 - PAGAMENTO / MAIS VENDIDOS / CATEGORIAS --}}
<div class="row">

  {{-- Faturamento por forma de pagamento --}}
  <div class="col-lg-4">
    <div class="card card-grafico mb-4">
      <div class="card-header">
        <h3 class="card-title">Faturamento por forma de pagamento</h3>
      </div>
      <div class="card-body">
        <div id="grafico-pagamento" role="img" aria-label="Faturamento por forma de pagamento"></div>
      </div>
    </div>
  </div>

  {{-- Top 5 produtos mais vendidos --}}
  <div class="col-lg-4">
    <div class="card card-grafico mb-4">
      <div class="card-header">
        <h3 class="card-title">Produtos mais vendidos</h3>
      </div>
      <div class="card-body">
        <div id="grafico-mais-vendidos" role="img" aria-label="Cinco produtos mais vendidos, em quantidade"></div>
      </div>
    </div>
  </div>

  {{-- Produtos por categoria --}}
  <div class="col-lg-4">
    <div class="card card-grafico mb-4">
      <div class="card-header">
        <h3 class="card-title">Produtos ativos por categoria</h3>
      </div>
      <div class="card-body">
        <div id="grafico-categorias" role="img" aria-label="Quantidade de produtos ativos em cada categoria"></div>
      </div>
    </div>
  </div>

</div>


{{-- LINHA 3 - ÚLTIMAS VENDAS --}}
<div class="row">
  <div class="col-12">
    <div class="card card-grafico mb-4">
      <div class="card-header d-flex align-items-center">
        <h3 class="card-title">Últimas vendas</h3>
        <a href="{{ route('admin.venda.index') }}" class="ms-auto">Ver todas</a>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle m-0">
            <thead>
              <tr>
                <th>Código</th>
                <th>Data</th>
                <th>Cliente</th>
                <th>Pagamento</th>
                <th>Status</th>
                <th class="text-end">Valor</th>
              </tr>
            </thead>
            <tbody>
              @forelse($ultimasVendas as $venda)
                <tr>
                  <td>{{ $venda->id_venda }}</td>
                  <td class="text-nowrap">{{ date('d/m/Y H:i', strtotime($venda->data_hora_venda)) }}</td>
                  <td>{{ $venda->cliente?->nome_cliente ?? 'Não identificado' }}</td>
                  <td>{{ $venda->forma_pagamento_venda ?? '—' }}</td>
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
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center py-4 text-muted">Nenhuma venda registrada.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


{{-- ApexCharts (o CSS já é carregado no head) --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.54.1/dist/apexcharts.min.js"></script>

{{-- Gráficos do dashboard --}}
<script>
    // Cores do tema (a laranja um pouco mais clara que --cor-secundaria-2 para ter contraste com o card marrom)
    const corBarra = '#c9773c';
    const corTexto = '#F3E8DC';
    const corGrade = 'rgba(243, 232, 220, 0.12)';

    // Formata número como dinheiro: R$ 1.234,50
    function formatarReal(valor) {
        return Number(valor).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }

    // Arredonda o fim do eixo para um número "redondo" (ex.: 108 -> 150 com marcas de 50; 6,5 -> 7 com marcas de 1)
    function eixoRedondo(valor) {

        let passo = Math.pow(10, Math.floor(Math.log10(valor))) / 2;

        // Quantidades nunca têm marca quebrada
        passo = Math.max(passo, 1);

        // No máximo 8 divisões no eixo
        while (Math.ceil(valor / passo) > 8) {
            passo = passo * 2;
        }

        const max = Math.ceil(valor / passo) * passo;

        return { max: max, divisoes: Math.round(max / passo) };
    }

    // Configuração comum a todos os gráficos
    function configuracaoBase(altura) {
        return {
            chart: {
                type: 'bar',
                height: altura,
                toolbar: { show: false },
                foreColor: corTexto,
                fontFamily: '"Bebas Neue", sans-serif',
                background: 'transparent'
            },
            colors: [corBarra],
            grid: { borderColor: corGrade },
            tooltip: { theme: 'dark' },
            noData: { text: 'Ainda não há dados', style: { color: corTexto } }
        };
    }

    // Gráfico de barras deitadas (usado em 3 gráficos)
    function graficoBarrasDeitadas(elemento, nomeSerie, dados, formatador) {

        const opcoes = configuracaoBase(260);
        const valores = Object.values(dados).map(Number);
        const eixo = eixoRedondo(Math.max(...valores, 1) * 1.3);

        opcoes.series = [{ name: nomeSerie, data: valores }];
        opcoes.xaxis = {
            categories: Object.keys(dados),
            labels: { formatter: formatador },

            // Folga de 30% depois da maior barra para o valor caber ao lado dela
            min: 0,
            max: eixo.max,
            tickAmount: eixo.divisoes
        };
        opcoes.plotOptions = {
            bar: {
                horizontal: true,
                barHeight: '55%',
                borderRadius: 4,
                borderRadiusApplication: 'end',
                dataLabels: { position: 'top' }
            }
        };
        opcoes.dataLabels = {
            enabled: true,
            formatter: formatador,
            offsetX: 36,
            style: { colors: [corTexto] }
        };
        opcoes.tooltip.y = { formatter: formatador };

        new ApexCharts(document.querySelector(elemento), opcoes).render();
    }


    // 1 - Faturamento mensal (colunas)
    const meses = @json($graficoMeses);
    const opcoesMeses = configuracaoBase(280);

    opcoesMeses.series = [{ name: 'Faturamento', data: meses.valores }];
    opcoesMeses.xaxis = { categories: meses.rotulos };
    opcoesMeses.yaxis = { labels: { formatter: formatarReal } };
    opcoesMeses.plotOptions = { bar: { columnWidth: '45%', borderRadius: 4, borderRadiusApplication: 'end' } };
    opcoesMeses.dataLabels = { enabled: false };
    opcoesMeses.tooltip.y = { formatter: formatarReal };

    new ApexCharts(document.querySelector('#grafico-meses'), opcoesMeses).render();


    // 2 - Faturamento por forma de pagamento
    graficoBarrasDeitadas('#grafico-pagamento', 'Faturamento', @json($graficoPagamento), formatarReal);

    // 3 - Produtos mais vendidos (quantidade)
    graficoBarrasDeitadas('#grafico-mais-vendidos', 'Quantidade vendida', @json($graficoMaisVendidos), function(valor) {
        return Number(valor).toLocaleString('pt-BR');
    });

    // 4 - Produtos ativos por categoria
    graficoBarrasDeitadas('#grafico-categorias', 'Produtos', @json($graficoCategorias), function(valor) {
        return Math.round(valor);
    });
</script>
