<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use Illuminate\Http\Request;


// Mensagens do formulário de contato do site (tbl_contato): NOVO / LIDO
class MensagemController extends Controller
{
    // Listar mensagens: R
    public function index(Request $request)
    {
        // Valores da pesquisa e do filtro (vindos da URL)
        $busca = $request->input('busca');
        $status = $request->input('status', 'all');

        $consulta = Contato::orderByDesc('data_criacao_contato');

        // Pesquisar por nome, e-mail ou assunto
        if ($busca) {
            $consulta->where(function ($filtro) use ($busca) {
                $filtro->where('nome_contato', 'like', '%' . $busca . '%')
                    ->orWhere('email_contato', 'like', '%' . $busca . '%')
                    ->orWhere('assunto_contato', 'like', '%' . $busca . '%');
            });
        }

        // Filtrar pelo status (novo / lido)
        if (in_array($status, ['novo', 'lido'])) {
            $consulta->where('status_contato', strtoupper($status));
        }

        // 10 por página, mantendo a pesquisa e o filtro nos links das páginas
        $listaMensagens = $consulta->paginate(10)->withQueryString();

        return view('admin.mensagem.index', compact('listaMensagens', 'busca', 'status'));
    }

    // MARCAR COMO LIDA / NÃO LIDA - (U)
    public function status(Request $request, int $id)
    {

        try {

            $mensagem = Contato::findOrFail($id);

            $novoStatus = $mensagem->status_contato === 'NOVO' ? 'LIDO' : 'NOVO';

            // ATUALIZA NO BANCO
            $mensagem->update([
                'status_contato' => $novoStatus,
            ]);

            $texto = $novoStatus === 'LIDO' ? 'Mensagem marcada como lida' : 'Mensagem marcada como não lida';

            // Voltar para a listagem (mantendo filtros)
            return redirect()
                ->back()
                ->with('sucesso', $texto);


        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível alterar a mensagem. Tente mais tarde!');
        }
    }


}
