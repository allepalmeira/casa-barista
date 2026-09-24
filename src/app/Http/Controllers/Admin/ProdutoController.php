<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use App\Models\Produto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProdutoController extends Controller
{

    // Listar todos os produtos cadastrados: R
    public function index(Request $request){

        // Categorias para o select do cadastro/edição
        $listaCategorias = Categoria::orderBy('nome_categoria')
        ->get();

        // Valores da pesquisa e do filtro (vindos da URL)
        $busca = $request->input('busca');
        $status = $request->input('status', 'all');

        $consulta = Produto::with('categoria')
        ->orderBy('nome_produto');

        // Pesquisar pelo nome
        if ($busca) {
            $consulta->where('nome_produto', 'like', '%' . $busca . '%');
        }

        // Filtrar pelo status (ativo / inativo)
        if (in_array($status, ['ativo', 'inativo'])) {
            $consulta->where('status_produto', strtoupper($status));
        }

        // 5 por página, mantendo a pesquisa e o filtro nos links das páginas
        $listaProdutos = $consulta->paginate(5)->withQueryString();

        return view('admin.produto.index', compact('listaCategorias', 'listaProdutos', 'busca', 'status'));

    }

    // CADASTRAR PRODUTO: C
    public function store(Request $request)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'nome_produto' => 'required|max:30',
            'id_categoria' => 'required|exists:tbl_categoria,id_categoria',
            'descricao_curta_produto' => 'required|max:100',
            'descricao_longa_produto' => 'nullable',
            'valor_produto' => 'required|numeric|min:0',
            'imagem_produto' => 'required|image|mimes:jpg,png,webp,jpeg|max:4096',
            'destaque_produto' => 'required|in:0,1',
            'status_produto' => 'required|in:ATIVO,INATIVO'
        ]);

        $caminhoArquivo = null;

        try {

            DB::beginTransaction();


            // 2 - Cadastrar no banco de dados
            $produto = Produto::create([
                'nome_produto' => $dados['nome_produto'],
                'id_categoria' => $dados['id_categoria'],
                'descricao_curta_produto' => $dados['descricao_curta_produto'],
                'descricao_longa_produto' => $dados['descricao_longa_produto'],
                'valor_produto' => $dados['valor_produto'],

                // Valor temporario
                'imagem_produto' => 'produto/sem-foto.png',
                'destaque_produto' => $dados['destaque_produto'],
                'status_produto' => $dados['status_produto'],
            ]);

            // 3 - Receber a imagem enviada
            $imagem = $request->file('imagem_produto');

            // 4 - Criar um nome para a imagem - Café Longo mudar para: cafe-longo_7.png
            // (limitado a 25 caracteres porque a coluna imagem_produto tem 45)
            $nomeSlug = Str::limit(Str::slug($dados['nome_produto']), 25, '');

            // 5 - Pegar a extensao do arquivo
            $extensao = strtolower($imagem->getClientOriginalExtension());

            // 6- Criar nome FINAL
            $nomeImg = $nomeSlug . '_' . $produto->id_produto . '.' . $extensao;

            // 7 - Salvar a imagem
            $pasta = public_path('barista/img/produto');

            // 8 - Se a pasta não existir... faça:
            if (!is_dir($pasta)) {
                mkdir($pasta, 0775, true);
            }

            // 9 - Mover e salvar a img na pasta
            $imagem->move(
                $pasta,
                $nomeImg
            );

            $caminhoArquivo = $pasta . DIRECTORY_SEPARATOR . $nomeImg;

            // 10 - Atualizar o registro
            $produto->imagem_produto = 'produto/' . $nomeImg;
            $produto->save();

            DB::commit();

            // 11 - Voltar para a listagem
            return redirect()
                ->route('admin.produto.index')
                ->with('sucesso', 'Produto: ' . $produto->nome_produto . ' foi cadastrado com sucesso!');
        } catch (\Throwable $erro) {

            DB::rollBack();

            if ($caminhoArquivo && file_exists($caminhoArquivo)) {
                unlink($caminhoArquivo);
            }

            report($erro);

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível cadastrar o produto. Tente mais tarde!');
        }
    }

    // ATUALIZAR PRODUTO: U
    public function update(Request $request, int $id)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'nome_produto' => 'required|max:30',
            'id_categoria' => 'required|exists:tbl_categoria,id_categoria',
            'descricao_curta_produto' => 'required|max:100',
            'descricao_longa_produto' => 'nullable',
            'valor_produto' => 'required|numeric|min:0',
            'imagem_produto' => 'nullable|image|mimes:jpg,png,webp,jpeg|max:4096',
            'destaque_produto' => 'required|in:0,1',
            'status_produto' => 'required|in:ATIVO,INATIVO'
        ]);

        // 2 - Buscar o produto
        $produto = Produto::findOrFail($id);

        try {

            // Nome atual
            $nomeSlug = Str::limit(Str::slug($dados['nome_produto']), 25, '');

            // O nome da pasta
            $pasta = public_path('barista/img/produto');

            // O caminho salvo no banco
            $caminhoArquivo = $produto->imagem_produto;

            // Caminho físico da imagem atual
            $imgAntiga = public_path('barista/img/' . $produto->imagem_produto);

            // CASO 1: NOVA IMAGEM
            if ($request->hasFile('imagem_produto')) {

                $imagem = $request->file('imagem_produto');

                $extensao = strtolower($imagem->getClientOriginalExtension());

                $nomeImg = $nomeSlug . '_' . $produto->id_produto . '.' . $extensao;

                // Excluir a imagem anterior
                if (file_exists($imgAntiga)) {
                    unlink($imgAntiga);
                }

                // Salva a nova imagem
                $imagem->move($pasta, $nomeImg);

                $caminhoArquivo = 'produto/' . $nomeImg;
            } elseif ($produto->nome_produto !== $request->nome_produto) {

                // CASO 2 - MUDOU SOMENTE O NOME
                $extensao = pathinfo($produto->imagem_produto, PATHINFO_EXTENSION);

                $nomeImg = $nomeSlug . '_' . $produto->id_produto . '.' . $extensao;

                $novaImagem = public_path('barista/img/produto/' . $nomeImg);

                if (file_exists($imgAntiga)) {

                    rename(
                        $imgAntiga,
                        $novaImagem
                    );

                    $caminhoArquivo = 'produto/' . $nomeImg;
                }
            }

            // ATUALIZA NO BANCO
            $produto->update([
                'nome_produto' => $dados['nome_produto'],
                'id_categoria' => $dados['id_categoria'],
                'descricao_curta_produto' => $dados['descricao_curta_produto'],
                'descricao_longa_produto' => $dados['descricao_longa_produto'],
                'valor_produto' => $dados['valor_produto'],
                'imagem_produto' => $caminhoArquivo,
                'destaque_produto' => $dados['destaque_produto'],
                'status_produto' => $dados['status_produto'],
            ]);

            // Voltar para a listagem
            return redirect()
                ->route('admin.produto.index')
                ->with('sucesso', 'Produto: ' . $produto->nome_produto . ' foi atualizado com sucesso!');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível atualizar o produto. Tente mais tarde!');
        }
    } // FIM DA METODO UPDATE

    // ATIVAR e DESATIVAR o PRODUTO - D (U)
    public function status(Request $request, int $id)
    {

        try {

            $produto = Produto::findOrFail($id);

            $novoStatus = $produto->status_produto === 'ATIVO' ? 'INATIVO' : 'ATIVO';

            // ATUALIZA NO BANCO
            $produto->update([
                'status_produto' => $novoStatus,
            ]);

            $mensagem = $novoStatus === 'ATIVO' ? 'Produto ativado com sucesso' : 'Produto desativado com sucesso';

            // Voltar para a listagem
            return redirect()
                ->route('admin.produto.index')
                ->with('sucesso', $mensagem);


        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível alterar o status do produto. Tente mais tarde!');
        }
    }

}
