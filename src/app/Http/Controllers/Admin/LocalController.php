<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Local;
use Illuminate\Http\Request;

use Illuminate\Support\Str;


class LocalController extends Controller
{
    // Tipos de local de atendimento
    const TIPOS = ['MESA', 'BALCÃO', 'OUTRO'];

    // Listar todos os locais cadastrados: R
    public function index(Request $request)
    {
        // Valores da pesquisa e do filtro (vindos da URL)
        $busca = $request->input('busca');
        $status = $request->input('status', 'all');

        $consulta = Local::orderBy('tipo_local')->orderBy('nome_local');

        // Pesquisar pelo nome
        if ($busca) {
            $consulta->where('nome_local', 'like', '%' . $busca . '%');
        }

        // Filtrar pelo status (ativo / inativo)
        if (in_array($status, ['ativo', 'inativo'])) {
            $consulta->where('status_local', strtoupper($status));
        }

        // 10 por página, mantendo a pesquisa e o filtro nos links das páginas
        $listaLocais = $consulta->paginate(10)->withQueryString();

        $tipos = self::TIPOS;

        return view('admin.local.index', compact('listaLocais', 'busca', 'status', 'tipos'));
    }

    // CADASTRAR LOCAL: C
    public function store(Request $request)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'nome_local' => 'required|max:30',
            'tipo_local' => 'required|in:' . implode(',', self::TIPOS),
            'status_local' => 'required|in:ATIVO,INATIVO'
        ]);

        try {

            // 2 - Cadastrar no banco de dados (com um código novo para o QR Code)
            $local = Local::create([
                'nome_local' => $dados['nome_local'],
                'tipo_local' => $dados['tipo_local'],
                'codigo_local' => $this->gerarCodigo(),
                'status_local' => $dados['status_local'],
            ]);

            // 3 - Voltar para a listagem
            return redirect()
                ->route('admin.local.index')
                ->with('sucesso', 'Local: ' . $local->nome_local . ' foi cadastrado com sucesso!');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível cadastrar o local. Tente mais tarde!');
        }
    }

    // ATUALIZAR LOCAL: U
    public function update(Request $request, int $id)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'nome_local' => 'required|max:30',
            'tipo_local' => 'required|in:' . implode(',', self::TIPOS),
            'status_local' => 'required|in:ATIVO,INATIVO'
        ]);

        // 2 - Buscar o local
        $local = Local::findOrFail($id);

        try {

            // ATUALIZA NO BANCO (o código do QR Code não muda - a placa impressa continua valendo)
            $local->update([
                'nome_local' => $dados['nome_local'],
                'tipo_local' => $dados['tipo_local'],
                'status_local' => $dados['status_local'],
            ]);

            // Voltar para a listagem
            return redirect()
                ->route('admin.local.index')
                ->with('sucesso', 'Local: ' . $local->nome_local . ' foi atualizado com sucesso!');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível atualizar o local. Tente mais tarde!');
        }
    } // FIM DA METODO UPDATE

    // ATIVAR e DESATIVAR o LOCAL - D (U)
    public function status(Request $request, int $id)
    {

        try {

            $local = Local::findOrFail($id);

            $novoStatus = $local->status_local === 'ATIVO' ? 'INATIVO' : 'ATIVO';

            // ATUALIZA NO BANCO
            $local->update([
                'status_local' => $novoStatus,
            ]);

            $mensagem = $novoStatus === 'ATIVO' ? 'Local ativado com sucesso' : 'Local desativado com sucesso';

            // Voltar para a listagem
            return redirect()
                ->route('admin.local.index')
                ->with('sucesso', $mensagem);


        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível alterar o status do local. Tente mais tarde!');
        }
    }

    // PÁGINA DE IMPRESSÃO DO QR CODE (um local ou todos os ativos)
    public function qrcode(?int $id = null)
    {
        if ($id !== null) {
            $listaLocais = collect([Local::findOrFail($id)]);
        } else {
            $listaLocais = Local::where('status_local', 'ATIVO')
                ->orderBy('tipo_local')
                ->orderBy('nome_local')
                ->get();
        }

        return view('admin.local.qrcode', compact('listaLocais'));
    }

    // Gera um código aleatório que ainda não existe (ex.: k3f9x2m7qa)
    private function gerarCodigo(): string
    {
        do {
            $codigo = Str::lower(Str::random(10));
        } while (Local::where('codigo_local', $codigo)->exists());

        return $codigo;
    }


}
