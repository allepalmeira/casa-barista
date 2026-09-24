<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeria;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class GaleriaController extends Controller
{
    // Listar todas as imagens da galeria cadastradas: R
    public function index(Request $request)
    {
        // Filtro vindo da URL: all / ativo / inativo
        $status = $request->input('status', 'all');

        $consulta = Galeria::orderByDesc('id_galeria');

        // Filtrar pelo status (ativo / inativo)
        if (in_array($status, ['ativo', 'inativo'])) {
            $consulta->where('status_galeria', strtoupper($status));
        }

        $listaGaleria = $consulta->get();

        // Total geral de imagens (sem filtro) para o rodapé
        $totalGaleria = Galeria::count();

        return view('admin.galeria.index', compact('listaGaleria', 'status', 'totalGaleria'));
    }

    // CADASTRAR IMAGEM NA GALERIA: C
    public function store(Request $request)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'nome_galeria' => 'required|max:50',
            'imagem_galeria' => 'required|image|mimes:jpg,png,webp,jpeg|max:4096',
            'status_galeria' => 'required|in:ATIVO,INATIVO'
        ]);

        $caminhoArquivo = null;

        try {

            DB::beginTransaction();


            // 2 - Cadastrar no banco de dados
            $galeria = Galeria::create([
                'nome_galeria' => $dados['nome_galeria'],

                // Valor temporario
                'imagem_galeria' => 'galeria/sem-foto.png',
                'status_galeria' => $dados['status_galeria'],
            ]);

            // 3 - Receber a imagem enviada
            $imagem = $request->file('imagem_galeria');

            // 4 - Criar um nome para a imagem - Área Externa mudar para: area-externa_7.png
            $nomeSlug = Str::slug($dados['nome_galeria']);

            // 5 - Pegar a extensao do arquivo
            $extensao = strtolower($imagem->getClientOriginalExtension());

            // 6- Criar nome FINAL
            $nomeImg = $nomeSlug . '_' . $galeria->id_galeria . '.' . $extensao;

            // 7 - Salvar a imagem
            $pasta = public_path('barista/img/galeria');

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
            $galeria->imagem_galeria = 'galeria/' . $nomeImg;
            $galeria->save();

            DB::commit();

            // 11 - Voltar para a listagem
            return redirect()
                ->route('admin.galeria.index')
                ->with('sucesso', 'Imagem: ' . $galeria->nome_galeria . ' foi cadastrada com sucesso!');
        } catch (\Throwable $erro) {

            DB::rollBack();

            if ($caminhoArquivo && file_exists($caminhoArquivo)) {
                unlink($caminhoArquivo);
            }

            report($erro);

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível cadastrar a imagem. Tente mais tarde!');
        }
    }

    // ATUALIZAR IMAGEM DA GALERIA: U
    public function update(Request $request, int $id)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'nome_galeria' => 'required|max:50',
            'imagem_galeria' => 'nullable|image|mimes:jpg,png,webp,jpeg|max:4096',
            'status_galeria' => 'required|in:ATIVO,INATIVO'
        ]);

        // 2 - Buscar a imagem da galeria
        $galeria = Galeria::findOrFail($id);

        try {

            // Nome atual
            $nomeSlug = Str::slug($dados['nome_galeria']);

            // O nome da pasta
            $pasta = public_path('barista/img/galeria');

            // O caminho salvo no banco
            $caminhoArquivo = $galeria->imagem_galeria;

            // Caminho físico da imagem atual
            $imgAntiga = public_path('barista/img/' . $galeria->imagem_galeria);

            // CASO 1: NOVA IMAGEM
            if ($request->hasFile('imagem_galeria')) {

                $imagem = $request->file('imagem_galeria');

                $extensao = strtolower($imagem->getClientOriginalExtension());

                $nomeImg = $nomeSlug . '_' . $galeria->id_galeria . '.' . $extensao;

                // Excluir a imagem anterior
                if (file_exists($imgAntiga)) {
                    unlink($imgAntiga);
                }

                // Salva a nova imagem
                $imagem->move($pasta, $nomeImg);

                $caminhoArquivo = 'galeria/' . $nomeImg;
            } elseif ($galeria->nome_galeria !== $request->nome_galeria) {

                // CASO 2 - MUDOU SOMENTE O NOME
                $extensao = pathinfo($galeria->imagem_galeria, PATHINFO_EXTENSION);

                $nomeImg = $nomeSlug . '_' . $galeria->id_galeria . '.' . $extensao;

                $novaImagem = public_path('barista/img/galeria/' . $nomeImg);

                if (file_exists($imgAntiga)) {

                    rename(
                        $imgAntiga,
                        $novaImagem
                    );

                    $caminhoArquivo = 'galeria/' . $nomeImg;
                }
            }

            // ATUALIZA NO BANCO
            $galeria->update([
                'nome_galeria' => $dados['nome_galeria'],
                'imagem_galeria' => $caminhoArquivo,
                'status_galeria' => $dados['status_galeria'],
            ]);

            // Voltar para a listagem
            return redirect()
                ->route('admin.galeria.index')
                ->with('sucesso', 'Imagem: ' . $galeria->nome_galeria . ' foi atualizada com sucesso!');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível atualizar a imagem. Tente mais tarde!');
        }
    } // FIM DA METODO UPDATE

    // ATIVAR e DESATIVAR a IMAGEM DA GALERIA - D (U)
    public function status(Request $request, int $id)
    {

        try {

            $galeria = Galeria::findOrFail($id);

            $novoStatus = $galeria->status_galeria === 'ATIVO' ? 'INATIVO' : 'ATIVO';

            // ATUALIZA NO BANCO
            $galeria->update([
                'status_galeria' => $novoStatus,
            ]);

            $mensagem = $novoStatus === 'ATIVO' ? 'Imagem ativada com sucesso' : 'Imagem desativada com sucesso';

            // Voltar para a listagem
            return redirect()
                ->route('admin.galeria.index')
                ->with('sucesso', $mensagem);


        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível alterar o status da imagem. Tente mais tarde!');
        }
    }


}
