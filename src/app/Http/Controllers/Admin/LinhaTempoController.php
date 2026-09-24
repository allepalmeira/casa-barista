<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LinhaTempo;
use Illuminate\Http\Request;


class LinhaTempoController extends Controller
{
    // Listar todos os marcos da linha do tempo: R
    public function index()
    {
        $listaLinhaTempo = LinhaTempo::orderBy('ano_linha_tempo')->get();

        return view('admin.linha-tempo.index', compact('listaLinhaTempo'));
    }

    // CADASTRAR MARCO NA LINHA DO TEMPO: C
    public function store(Request $request)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'titulo_linha_tempo' => 'required|max:30',
            'ano_linha_tempo' => 'required|integer|min:1900|max:2100',
            'descricao_linha_tempo' => 'required|max:255',
            'status_linha_tempo' => 'required|in:ATIVO,INATIVO'
        ]);

        try {

            // 2 - Cadastrar no banco de dados (a coluna é DATE, salva como 01/01 do ano)
            $linhaTempo = LinhaTempo::create([
                'titulo_linha_tempo' => $dados['titulo_linha_tempo'],
                'ano_linha_tempo' => $dados['ano_linha_tempo'] . '-01-01',
                'descricao_linha_tempo' => $dados['descricao_linha_tempo'],
                'status_linha_tempo' => $dados['status_linha_tempo'],
            ]);

            // 3 - Voltar para a listagem
            return redirect()
                ->route('admin.linha-tempo.index')
                ->with('sucesso', 'Linha do tempo: ' . $linhaTempo->titulo_linha_tempo . ' foi cadastrada com sucesso!');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível cadastrar a linha do tempo. Tente mais tarde!');
        }
    }

    // ATUALIZAR MARCO DA LINHA DO TEMPO: U
    public function update(Request $request, int $id)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'titulo_linha_tempo' => 'required|max:30',
            'ano_linha_tempo' => 'required|integer|min:1900|max:2100',
            'descricao_linha_tempo' => 'required|max:255',
            'status_linha_tempo' => 'required|in:ATIVO,INATIVO'
        ]);

        // 2 - Buscar o marco
        $linhaTempo = LinhaTempo::findOrFail($id);

        try {

            // ATUALIZA NO BANCO
            $linhaTempo->update([
                'titulo_linha_tempo' => $dados['titulo_linha_tempo'],
                'ano_linha_tempo' => $dados['ano_linha_tempo'] . '-01-01',
                'descricao_linha_tempo' => $dados['descricao_linha_tempo'],
                'status_linha_tempo' => $dados['status_linha_tempo'],
            ]);

            // Voltar para a listagem
            return redirect()
                ->route('admin.linha-tempo.index')
                ->with('sucesso', 'Linha do tempo: ' . $linhaTempo->titulo_linha_tempo . ' foi atualizada com sucesso!');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível atualizar a linha do tempo. Tente mais tarde!');
        }
    } // FIM DA METODO UPDATE

    // ATIVAR e DESATIVAR o MARCO - D (U)
    public function status(Request $request, int $id)
    {

        try {

            $linhaTempo = LinhaTempo::findOrFail($id);

            $novoStatus = $linhaTempo->status_linha_tempo === 'ATIVO' ? 'INATIVO' : 'ATIVO';

            // ATUALIZA NO BANCO
            $linhaTempo->update([
                'status_linha_tempo' => $novoStatus,
            ]);

            $mensagem = $novoStatus === 'ATIVO' ? 'Linha do tempo ativada com sucesso' : 'Linha do tempo desativada com sucesso';

            // Voltar para a listagem
            return redirect()
                ->route('admin.linha-tempo.index')
                ->with('sucesso', $mensagem);


        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível alterar o status da linha do tempo. Tente mais tarde!');
        }
    }


}
