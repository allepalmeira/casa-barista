<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    // Listar todas as categorias cadastradas: R
    public function index(Request $request){

        // Valores da pesquisa e do filtro (vindos da URL)
        $busca = $request->input('busca');
        $status = $request->input('status', 'all');

        $consulta = Categoria::orderBy('nome_categoria');

        // Pesquisar pelo nome
        if ($busca) {
            $consulta->where('nome_categoria', 'like', '%' . $busca . '%');
        }

        // Filtrar pelo status (ativo / inativo)
        if (in_array($status, ['ativo', 'inativo'])) {
            $consulta->where('status_categoria', strtoupper($status));
        }

        // 5 por página, mantendo a pesquisa e o filtro nos links das páginas
        $listaCategorias = $consulta->paginate(5)->withQueryString();

        return view('admin.categoria.index', compact('listaCategorias', 'busca', 'status'));

    }

    // CADASTRAR CATEGORIA: C
    public function store(Request $request)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'nome_categoria' => 'required|max:30',
            'status_categoria' => 'required|in:ATIVO,INATIVO'
        ]);

        try {

            // 2 - Cadastrar no banco de dados
            $categoria = Categoria::create([
                'nome_categoria' => $dados['nome_categoria'],
                'status_categoria' => $dados['status_categoria'],
            ]);

            // 3 - Voltar para a listagem
            return redirect()
                ->route('admin.categoria.index')
                ->with('sucesso', 'Categoria: ' . $categoria->nome_categoria . ' foi cadastrada com sucesso!');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível cadastrar a categoria. Tente mais tarde!');
        }
    }

    // ATUALIZAR CATEGORIA: U
    public function update(Request $request, int $id)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'nome_categoria' => 'required|max:30',
            'status_categoria' => 'required|in:ATIVO,INATIVO'
        ]);

        // 2 - Buscar a categoria
        $categoria = Categoria::findOrFail($id);

        try {

            // ATUALIZA NO BANCO
            $categoria->update([
                'nome_categoria' => $dados['nome_categoria'],
                'status_categoria' => $dados['status_categoria'],
            ]);

            // Voltar para a listagem
            return redirect()
                ->route('admin.categoria.index')
                ->with('sucesso', 'Categoria: ' . $categoria->nome_categoria . ' foi atualizada com sucesso!');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível atualizar a categoria. Tente mais tarde!');
        }
    } // FIM DA METODO UPDATE

    // ATIVAR e DESATIVAR a CATEGORIA - D (U)
    public function status(Request $request, int $id)
    {

        try {

            $categoria = Categoria::findOrFail($id);

            $novoStatus = $categoria->status_categoria === 'ATIVO' ? 'INATIVO' : 'ATIVO';

            // ATUALIZA NO BANCO
            $categoria->update([
                'status_categoria' => $novoStatus,
            ]);

            $mensagem = $novoStatus === 'ATIVO' ? 'Categoria ativada com sucesso' : 'Categoria desativada com sucesso';

            // Voltar para a listagem
            return redirect()
                ->route('admin.categoria.index')
                ->with('sucesso', $mensagem);


        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível alterar o status da categoria. Tente mais tarde!');
        }
    }

}
