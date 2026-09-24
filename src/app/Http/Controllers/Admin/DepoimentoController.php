<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depoimento;
use Illuminate\Http\Request;


class DepoimentoController extends Controller
{
    // Listar todos os depoimentos enviados pelos clientes: R
    public function index()
    {
        $listaDepoimentos = Depoimento::with('DepoimentoCliente')
            ->orderByDesc('id_depoimento')
            ->get();

        return view('admin.depoimento.index', compact('listaDepoimentos'));
    }

    // ATUALIZAR DEPOIMENTO: U
    // (o cadastro é feito pelo cliente no site)
    public function update(Request $request, int $id)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'titulo_depoimento' => 'required|max:50',
            'descricao_depoimento' => 'required',
            'nota_depoimento' => 'required|integer|min:1|max:5',
            'status_depoimento' => 'required|in:APROVADO,PENDENTE'
        ]);

        // 2 - Buscar o depoimento
        $depoimento = Depoimento::findOrFail($id);

        try {

            // ATUALIZA NO BANCO
            $depoimento->update([
                'titulo_depoimento' => $dados['titulo_depoimento'],
                'descricao_depoimento' => $dados['descricao_depoimento'],
                'nota_depoimento' => $dados['nota_depoimento'],
                'status_depoimento' => $dados['status_depoimento'],
            ]);

            // Voltar para a listagem
            return redirect()
                ->route('admin.depoimento.index')
                ->with('sucesso', 'Depoimento: ' . $depoimento->titulo_depoimento . ' foi atualizado com sucesso!');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível atualizar o depoimento. Tente mais tarde!');
        }
    } // FIM DA METODO UPDATE

    // APROVAR e VOLTAR PARA PENDENTE o DEPOIMENTO - D (U)
    public function status(Request $request, int $id)
    {

        try {

            $depoimento = Depoimento::findOrFail($id);

            $novoStatus = $depoimento->status_depoimento === 'APROVADO' ? 'PENDENTE' : 'APROVADO';

            // ATUALIZA NO BANCO
            $depoimento->update([
                'status_depoimento' => $novoStatus,
            ]);

            $mensagem = $novoStatus === 'APROVADO' ? 'Depoimento aprovado com sucesso' : 'Depoimento retirado do site com sucesso';

            // Voltar para a listagem
            return redirect()
                ->route('admin.depoimento.index')
                ->with('sucesso', $mensagem);


        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível alterar o status do depoimento. Tente mais tarde!');
        }
    }


}
