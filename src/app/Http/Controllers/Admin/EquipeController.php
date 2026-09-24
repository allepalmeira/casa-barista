<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipe;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class EquipeController extends Controller
{
    // Listar a equipe cadastrada: R
    public function index(Request $request)
    {
        // Valores da pesquisa e do filtro (vindos da URL)
        $busca = $request->input('busca');
        $status = $request->input('status', 'all');

        $consulta = Equipe::orderBy('ordem_equipe')->orderBy('nome_equipe');

        // Pesquisar pelo nome ou cargo
        if ($busca) {
            $consulta->where(function ($filtro) use ($busca) {
                $filtro->where('nome_equipe', 'like', '%' . $busca . '%')
                    ->orWhere('cargo_equipe', 'like', '%' . $busca . '%');
            });
        }

        // Filtrar pelo status (ativo / inativo)
        if (in_array($status, ['ativo', 'inativo'])) {
            $consulta->where('status_equipe', strtoupper($status));
        }

        // 5 por página, mantendo a pesquisa e o filtro nos links das páginas
        $listaEquipe = $consulta->paginate(5)->withQueryString();

        return view('admin.equipe.index', compact('listaEquipe', 'busca', 'status'));
    }

    // CADASTRAR PESSOA DA EQUIPE: C
    public function store(Request $request)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'nome_equipe' => 'required|max:50',
            'cargo_equipe' => 'required|max:50',
            'foto_equipe' => 'required|image|mimes:jpg,png,webp,jpeg|max:4096',
            'ordem_equipe' => 'required|integer|min:0|max:999',
            'status_equipe' => 'required|in:ATIVO,INATIVO'
        ]);

        $caminhoArquivo = null;

        try {

            DB::beginTransaction();


            // 2 - Cadastrar no banco de dados
            $equipe = Equipe::create([
                'nome_equipe' => $dados['nome_equipe'],
                'cargo_equipe' => $dados['cargo_equipe'],

                // Valor temporario
                'foto_equipe' => 'equipe/sem-foto.png',
                'ordem_equipe' => $dados['ordem_equipe'],
                'status_equipe' => $dados['status_equipe'],
            ]);

            // 3 - Receber a foto enviada
            $imagem = $request->file('foto_equipe');

            // 4 - Criar um nome para a foto - Lucas Ribeiro mudar para: lucas-ribeiro_7.png
            $nomeSlug = Str::slug($dados['nome_equipe']);

            // 5 - Pegar a extensao do arquivo
            $extensao = strtolower($imagem->getClientOriginalExtension());

            // 6- Criar nome FINAL
            $nomeImg = $nomeSlug . '_' . $equipe->id_equipe . '.' . $extensao;

            // 7 - Salvar a foto
            $pasta = public_path('barista/img/equipe');

            // 8 - Se a pasta não existir... faça:
            if (!is_dir($pasta)) {
                mkdir($pasta, 0775, true);
            }

            // 9 - Mover e salvar a foto na pasta
            $imagem->move(
                $pasta,
                $nomeImg
            );

            $caminhoArquivo = $pasta . DIRECTORY_SEPARATOR . $nomeImg;

            // 10 - Atualizar o registro
            $equipe->foto_equipe = 'equipe/' . $nomeImg;
            $equipe->save();

            DB::commit();

            // 11 - Voltar para a listagem
            return redirect()
                ->route('admin.equipe.index')
                ->with('sucesso', $equipe->nome_equipe . ' foi cadastrado(a) na equipe com sucesso!');
        } catch (\Throwable $erro) {

            DB::rollBack();

            if ($caminhoArquivo && file_exists($caminhoArquivo)) {
                unlink($caminhoArquivo);
            }

            report($erro);

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível cadastrar na equipe. Tente mais tarde!');
        }
    }

    // ATUALIZAR PESSOA DA EQUIPE: U
    public function update(Request $request, int $id)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'nome_equipe' => 'required|max:50',
            'cargo_equipe' => 'required|max:50',
            'foto_equipe' => 'nullable|image|mimes:jpg,png,webp,jpeg|max:4096',
            'ordem_equipe' => 'required|integer|min:0|max:999',
            'status_equipe' => 'required|in:ATIVO,INATIVO'
        ]);

        // 2 - Buscar a pessoa
        $equipe = Equipe::findOrFail($id);

        try {

            // Nome atual
            $nomeSlug = Str::slug($dados['nome_equipe']);

            // O nome da pasta
            $pasta = public_path('barista/img/equipe');

            // O caminho salvo no banco
            $caminhoArquivo = $equipe->foto_equipe;

            // Caminho físico da foto atual
            $imgAntiga = public_path('barista/img/' . $equipe->foto_equipe);

            // CASO 1: NOVA FOTO
            if ($request->hasFile('foto_equipe')) {

                $imagem = $request->file('foto_equipe');

                $extensao = strtolower($imagem->getClientOriginalExtension());

                $nomeImg = $nomeSlug . '_' . $equipe->id_equipe . '.' . $extensao;

                // Excluir a foto anterior
                if (file_exists($imgAntiga)) {
                    unlink($imgAntiga);
                }

                // Salva a nova foto
                $imagem->move($pasta, $nomeImg);

                $caminhoArquivo = 'equipe/' . $nomeImg;
            } elseif ($equipe->nome_equipe !== $request->nome_equipe) {

                // CASO 2 - MUDOU SOMENTE O NOME
                $extensao = pathinfo($equipe->foto_equipe, PATHINFO_EXTENSION);

                $nomeImg = $nomeSlug . '_' . $equipe->id_equipe . '.' . $extensao;

                $novaImagem = public_path('barista/img/equipe/' . $nomeImg);

                if (file_exists($imgAntiga)) {

                    rename(
                        $imgAntiga,
                        $novaImagem
                    );

                    $caminhoArquivo = 'equipe/' . $nomeImg;
                }
            }

            // ATUALIZA NO BANCO
            $equipe->update([
                'nome_equipe' => $dados['nome_equipe'],
                'cargo_equipe' => $dados['cargo_equipe'],
                'foto_equipe' => $caminhoArquivo,
                'ordem_equipe' => $dados['ordem_equipe'],
                'status_equipe' => $dados['status_equipe'],
            ]);

            // Voltar para a listagem
            return redirect()
                ->route('admin.equipe.index')
                ->with('sucesso', $equipe->nome_equipe . ' foi atualizado(a) com sucesso!');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível atualizar a equipe. Tente mais tarde!');
        }
    } // FIM DA METODO UPDATE

    // ATIVAR e DESATIVAR (mostrar ou não no site) - D (U)
    public function status(Request $request, int $id)
    {

        try {

            $equipe = Equipe::findOrFail($id);

            $novoStatus = $equipe->status_equipe === 'ATIVO' ? 'INATIVO' : 'ATIVO';

            // ATUALIZA NO BANCO
            $equipe->update([
                'status_equipe' => $novoStatus,
            ]);

            $mensagem = $novoStatus === 'ATIVO' ? $equipe->nome_equipe . ' voltou a aparecer no site' : $equipe->nome_equipe . ' não aparece mais no site';

            // Voltar para a listagem
            return redirect()
                ->route('admin.equipe.index')
                ->with('sucesso', $mensagem);


        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível alterar o status. Tente mais tarde!');
        }
    }


}
