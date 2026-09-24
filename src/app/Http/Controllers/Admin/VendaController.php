<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\ItemVenda;
use App\Models\Local;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| VENDA = COMANDA
|--------------------------------------------------------------------------
|
| 1 - Abre a comanda para um local (mesa, balcão...)   -> EM ANDAMENTO
| 2 - Adiciona / remove itens enquanto o cliente consome
| 3 - Fecha escolhendo a forma de pagamento             -> FINALIZADA
|
| origem_venda: DASHBOARD (funcionário) ou APP (cliente pelo QR Code - futuro)
|
*/
class VendaController extends Controller
{
    // Formas de pagamento aceitas
    const FORMAS_PAGAMENTO = ['PIX', 'DINHEIRO', 'CRÉDITO', 'DÉBITO'];

    // Listar todas as vendas: R
    public function index()
    {
        $listaVendas = Venda::with(['cliente', 'local'])
            ->orderByDesc('data_hora_venda')
            ->get();

        // Para os modais: editar mostra todos (a venda pode ser de um local/cliente já desativado);
        // nova venda usa só os ATIVOS (filtrado na view)
        $listaLocais = Local::orderBy('tipo_local')->orderBy('nome_local')->get();
        $listaClientes = Cliente::orderBy('nome_cliente')->get();

        return view('admin.venda.index', compact('listaVendas', 'listaLocais', 'listaClientes'));
    }

    // ABRIR COMANDA: C
    public function store(Request $request)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'id_local' => 'required|exists:tbl_local,id_local',
            'id_cliente' => 'nullable|exists:tbl_cliente,id_cliente',
            'observacao_venda' => 'nullable|max:100'
        ]);

        $local = Local::findOrFail($dados['id_local']);

        if ($local->status_local !== 'ATIVO') {
            return redirect()
                ->back()
                ->with('erro', 'O local ' . $local->nome_local . ' está inativo.');
        }

        // 2 - Mesa só pode ter uma comanda aberta: se já tiver, abre a que existe
        if ($local->tipo_local === 'MESA') {

            $comandaAberta = Venda::where('id_local', $local->id_local)
                ->where('status_venda', 'EM ANDAMENTO')
                ->first();

            if ($comandaAberta) {
                return redirect()
                    ->route('admin.venda.show', $comandaAberta->id_venda)
                    ->with('erro', $local->nome_local . ' já tem uma comanda aberta.');
            }
        }

        try {

            DB::beginTransaction();

            // 3 - Cadastrar a comanda (sem itens e sem pagamento ainda)
            $venda = Venda::create([
                'data_hora_venda' => now(),
                'valor_total_venda' => 0,
                'id_cliente' => $dados['id_cliente'] ?? null,
                'id_local' => $local->id_local,
                'origem_venda' => 'DASHBOARD',
                'status_venda' => 'EM ANDAMENTO',
                'observacao_venda' => $dados['observacao_venda'] ?? null,
            ]);

            // 4 - Registrar o funcionário que abriu (tbl_usuarios_venda)
            $venda->usuarios()->attach(Auth::id());

            DB::commit();

            // 5 - Ir para a comanda para lançar os itens
            return redirect()
                ->route('admin.venda.show', $venda->id_venda)
                ->with('sucesso', 'Comanda #' . $venda->id_venda . ' aberta em ' . $local->nome_local . '!');
        } catch (\Throwable $erro) {

            DB::rollBack();

            report($erro);

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível abrir a comanda. Tente mais tarde!');
        }
    }

    // VER COMANDA (itens, adicionar, fechar): R
    public function show(int $id)
    {
        $venda = Venda::with(['itens.produto', 'local', 'cliente', 'usuarios'])->findOrFail($id);

        // Produtos que podem ser lançados
        $listaProdutos = Produto::with('categoria')
            ->where('status_produto', 'ATIVO')
            ->orderBy('nome_produto')
            ->get();

        $formasPagamento = self::FORMAS_PAGAMENTO;

        return view('admin.venda.comanda', compact('venda', 'listaProdutos', 'formasPagamento'));
    }

    // ATUALIZAR VENDA (local, cliente e observação): U
    public function update(Request $request, int $id)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'id_local' => 'nullable|exists:tbl_local,id_local',
            'id_cliente' => 'nullable|exists:tbl_cliente,id_cliente',
            'observacao_venda' => 'nullable|max:100'
        ]);

        // 2 - Buscar a venda
        $venda = Venda::findOrFail($id);

        try {

            // ATUALIZA NO BANCO
            $venda->update([
                'id_local' => $dados['id_local'] ?? null,
                'id_cliente' => $dados['id_cliente'] ?? null,
                'observacao_venda' => $dados['observacao_venda'] ?? null,
            ]);

            // Voltar para a tela de onde veio (listagem ou comanda)
            return redirect()
                ->back()
                ->with('sucesso', 'Venda: #' . $venda->id_venda . ' foi atualizada com sucesso!');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível atualizar a venda. Tente mais tarde!');
        }
    } // FIM DA METODO UPDATE

    // CANCELAR e REABRIR a VENDA - D (U)
    public function status(Request $request, int $id)
    {

        try {

            $venda = Venda::findOrFail($id);

            $novoStatus = $venda->status_venda === 'CANCELADA' ? 'EM ANDAMENTO' : 'CANCELADA';

            // ATUALIZA NO BANCO
            $venda->update([
                'status_venda' => $novoStatus,
            ]);

            $mensagem = $novoStatus === 'CANCELADA' ? 'Venda cancelada com sucesso' : 'Venda reaberta com sucesso';

            // Voltar para a tela de onde veio (listagem ou comanda)
            return redirect()
                ->back()
                ->with('sucesso', $mensagem);


        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível alterar o status da venda. Tente mais tarde!');
        }
    }

    // ADICIONAR ITEM NA COMANDA
    public function adicionarItem(Request $request, int $id)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'id_produto' => 'required|exists:tbl_produto,id_produto',
            'qtde_itens_venda' => 'required|integer|min:1|max:99'
        ]);

        $venda = Venda::findOrFail($id);

        if ($venda->status_venda !== 'EM ANDAMENTO') {
            return redirect()
                ->back()
                ->with('erro', 'Só é possível lançar itens em uma comanda EM ANDAMENTO.');
        }

        $produto = Produto::findOrFail($dados['id_produto']);

        if ($produto->status_produto !== 'ATIVO') {
            return redirect()
                ->back()
                ->with('erro', 'O produto ' . $produto->nome_produto . ' está inativo.');
        }

        try {

            DB::beginTransaction();

            // 2 - Se o produto já está na comanda, soma a quantidade
            $item = ItemVenda::where('id_venda', $venda->id_venda)
                ->where('id_produto', $produto->id_produto)
                ->first();

            if ($item) {

                $item->qtde_itens_venda = $item->qtde_itens_venda + $dados['qtde_itens_venda'];
                $item->subtotal_itens_venda = $item->qtde_itens_venda * $item->valor_unit_itens_venda;
                $item->save();

            } else {

                // 3 - Senão, lança um item novo com o preço atual do produto
                ItemVenda::create([
                    'id_venda' => $venda->id_venda,
                    'id_produto' => $produto->id_produto,
                    'qtde_itens_venda' => $dados['qtde_itens_venda'],
                    'valor_unit_itens_venda' => $produto->valor_produto,
                    'subtotal_itens_venda' => $dados['qtde_itens_venda'] * $produto->valor_produto,
                    'status_itens_venda' => 'CONFIRMADO',
                ]);
            }

            // 4 - Atualiza o total da venda
            $this->recalcularTotal($venda);

            DB::commit();

            return redirect()
                ->route('admin.venda.show', $venda->id_venda)
                ->with('sucesso', $dados['qtde_itens_venda'] . 'x ' . $produto->nome_produto . ' adicionado!');
        } catch (\Throwable $erro) {

            DB::rollBack();

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível adicionar o item. Tente mais tarde!');
        }
    }

    // REMOVER ITEM DA COMANDA
    public function removerItem(int $id, int $idItem)
    {
        $venda = Venda::findOrFail($id);

        if ($venda->status_venda !== 'EM ANDAMENTO') {
            return redirect()
                ->back()
                ->with('erro', 'Só é possível remover itens de uma comanda EM ANDAMENTO.');
        }

        // O item precisa ser desta venda
        $item = ItemVenda::with('produto')
            ->where('id_venda', $venda->id_venda)
            ->findOrFail($idItem);

        try {

            DB::beginTransaction();

            $item->delete();

            $this->recalcularTotal($venda);

            DB::commit();

            return redirect()
                ->route('admin.venda.show', $venda->id_venda)
                ->with('sucesso', $item->produto?->nome_produto . ' removido da comanda.');
        } catch (\Throwable $erro) {

            DB::rollBack();

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível remover o item. Tente mais tarde!');
        }
    }

    // FECHAR COMANDA (pagamento) -> FINALIZADA
    public function fechar(Request $request, int $id)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'forma_pagamento_venda' => 'required|in:' . implode(',', self::FORMAS_PAGAMENTO)
        ]);

        $venda = Venda::withCount('itens')->findOrFail($id);

        if ($venda->status_venda !== 'EM ANDAMENTO') {
            return redirect()
                ->back()
                ->with('erro', 'Esta comanda não está EM ANDAMENTO.');
        }

        if ($venda->itens_count === 0) {
            return redirect()
                ->back()
                ->with('erro', 'Adicione pelo menos um item antes de fechar a comanda.');
        }

        try {

            // 2 - Fecha a venda com a forma de pagamento
            $venda->update([
                'forma_pagamento_venda' => $dados['forma_pagamento_venda'],
                'status_venda' => 'FINALIZADA',
            ]);

            return redirect()
                ->route('admin.venda.index')
                ->with('sucesso', 'Comanda #' . $venda->id_venda . ' fechada: R$ ' . number_format($venda->valor_total_venda, 2, ',', '.') . ' no ' . $venda->forma_pagamento_venda . '.');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível fechar a comanda. Tente mais tarde!');
        }
    }

    // Soma os subtotais dos itens e grava no total da venda
    private function recalcularTotal(Venda $venda): void
    {
        $venda->valor_total_venda = ItemVenda::where('id_venda', $venda->id_venda)->sum('subtotal_itens_venda');
        $venda->save();
    }


}
