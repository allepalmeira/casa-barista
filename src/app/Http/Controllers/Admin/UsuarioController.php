<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class UsuarioController extends Controller
{
    // Níveis de acesso usados no sistema
    const NIVEIS = ['ADMINISTRADOR', 'ADMIN', 'GERENTE', 'ATENDENTE', 'CAIXA', 'BARISTA'];

    // Listar todos os usuários cadastrados: R
    public function index()
    {
        $listaUsuarios = User::orderBy('nome_usuarios')->get();

        $niveis = self::NIVEIS;

        return view('admin.usuario.index', compact('listaUsuarios', 'niveis'));
    }

    // CADASTRAR USUÁRIO: C
    public function store(Request $request)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'nome_usuarios' => 'required|max:50',
            'email_usuarios' => 'required|email|max:80|unique:tbl_usuarios,email_usuarios',
            'senha_usuarios' => 'required|min:6',
            'foto_usuarios' => 'required|image|mimes:jpg,png,webp,jpeg|max:4096',
            'nivel_usuarios' => 'required|in:' . implode(',', self::NIVEIS),
            'status_usuarios' => 'required|in:ATIVO,INATIVO'
        ]);

        $caminhoArquivo = null;

        try {

            DB::beginTransaction();


            // 2 - Cadastrar no banco de dados
            $usuario = User::create([
                'nome_usuarios' => $dados['nome_usuarios'],
                'email_usuarios' => $dados['email_usuarios'],

                // O model User já criptografa a senha (cast 'hashed')
                'senha_usuarios' => $dados['senha_usuarios'],

                // Valor temporario
                'foto_usuarios' => 'usuario/sem-foto.png',
                'nivel_usuarios' => $dados['nivel_usuarios'],
                'status_usuarios' => $dados['status_usuarios'],
            ]);

            // 3 - Receber a foto enviada
            $imagem = $request->file('foto_usuarios');

            // 4 - Criar um nome para a foto - Carla Silva mudar para: carla-silva_7.png
            $nomeSlug = Str::slug($dados['nome_usuarios']);

            // 5 - Pegar a extensao do arquivo
            $extensao = strtolower($imagem->getClientOriginalExtension());

            // 6- Criar nome FINAL
            $nomeImg = $nomeSlug . '_' . $usuario->id_usuarios . '.' . $extensao;

            // 7 - Salvar a foto
            $pasta = public_path('barista/img/usuario');

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
            $usuario->foto_usuarios = 'usuario/' . $nomeImg;
            $usuario->save();

            DB::commit();

            // 11 - Voltar para a listagem
            return redirect()
                ->route('admin.usuario.index')
                ->with('sucesso', 'Usuário: ' . $usuario->nome_usuarios . ' foi cadastrado com sucesso!');
        } catch (\Throwable $erro) {

            DB::rollBack();

            if ($caminhoArquivo && file_exists($caminhoArquivo)) {
                unlink($caminhoArquivo);
            }

            report($erro);

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível cadastrar o usuário. Tente mais tarde!');
        }
    }

    // ATUALIZAR USUÁRIO: U
    public function update(Request $request, int $id)
    {

        // 1 - Validar os dados (senha vazia = mantém a atual)
        $dados = $request->validate([
            'nome_usuarios' => 'required|max:50',
            'email_usuarios' => 'required|email|max:80|unique:tbl_usuarios,email_usuarios,' . $id . ',id_usuarios',
            'senha_usuarios' => 'nullable|min:6',
            'foto_usuarios' => 'nullable|image|mimes:jpg,png,webp,jpeg|max:4096',
            'nivel_usuarios' => 'required|in:' . implode(',', self::NIVEIS),
            'status_usuarios' => 'required|in:ATIVO,INATIVO'
        ]);

        // 2 - Buscar o usuário
        $usuario = User::findOrFail($id);

        // Não deixar o usuário logado se desativar
        if ($usuario->id_usuarios === Auth::id() && $dados['status_usuarios'] === 'INATIVO') {
            return redirect()
                ->back()
                ->with('erro', 'Você não pode desativar o seu próprio usuário.');
        }

        try {

            // Nome atual
            $nomeSlug = Str::slug($dados['nome_usuarios']);

            // O nome da pasta
            $pasta = public_path('barista/img/usuario');

            // Se a pasta não existir... faça:
            if (!is_dir($pasta)) {
                mkdir($pasta, 0775, true);
            }

            // O caminho salvo no banco
            $caminhoArquivo = $usuario->foto_usuarios;

            // Caminho físico da foto atual
            $imgAntiga = public_path('barista/img/' . $usuario->foto_usuarios);

            // CASO 1: NOVA FOTO
            if ($request->hasFile('foto_usuarios')) {

                $imagem = $request->file('foto_usuarios');

                $extensao = strtolower($imagem->getClientOriginalExtension());

                $nomeImg = $nomeSlug . '_' . $usuario->id_usuarios . '.' . $extensao;

                // Excluir a foto anterior
                if (file_exists($imgAntiga)) {
                    unlink($imgAntiga);
                }

                // Salva a nova foto
                $imagem->move($pasta, $nomeImg);

                $caminhoArquivo = 'usuario/' . $nomeImg;
            } elseif ($usuario->nome_usuarios !== $request->nome_usuarios) {

                // CASO 2 - MUDOU SOMENTE O NOME
                $extensao = pathinfo($usuario->foto_usuarios, PATHINFO_EXTENSION);

                $nomeImg = $nomeSlug . '_' . $usuario->id_usuarios . '.' . $extensao;

                $novaImagem = public_path('barista/img/usuario/' . $nomeImg);

                if (file_exists($imgAntiga)) {

                    rename(
                        $imgAntiga,
                        $novaImagem
                    );

                    $caminhoArquivo = 'usuario/' . $nomeImg;
                }
            }

            $atualizar = [
                'nome_usuarios' => $dados['nome_usuarios'],
                'email_usuarios' => $dados['email_usuarios'],
                'foto_usuarios' => $caminhoArquivo,
                'nivel_usuarios' => $dados['nivel_usuarios'],
                'status_usuarios' => $dados['status_usuarios'],
            ];

            // Só troca a senha se uma nova foi informada
            if (!empty($dados['senha_usuarios'])) {
                $atualizar['senha_usuarios'] = $dados['senha_usuarios'];
            }

            // ATUALIZA NO BANCO
            $usuario->update($atualizar);

            // Voltar para a listagem
            return redirect()
                ->route('admin.usuario.index')
                ->with('sucesso', 'Usuário: ' . $usuario->nome_usuarios . ' foi atualizado com sucesso!');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível atualizar o usuário. Tente mais tarde!');
        }
    } // FIM DA METODO UPDATE

    // ATIVAR e DESATIVAR o USUÁRIO - D (U)
    public function status(Request $request, int $id)
    {

        try {

            $usuario = User::findOrFail($id);

            // Não deixar o usuário logado se desativar
            if ($usuario->id_usuarios === Auth::id()) {
                return redirect()
                    ->back()
                    ->with('erro', 'Você não pode desativar o seu próprio usuário.');
            }

            $novoStatus = $usuario->status_usuarios === 'ATIVO' ? 'INATIVO' : 'ATIVO';

            // ATUALIZA NO BANCO
            $usuario->update([
                'status_usuarios' => $novoStatus,
            ]);

            $mensagem = $novoStatus === 'ATIVO' ? 'Usuário ativado com sucesso' : 'Usuário desativado com sucesso';

            // Voltar para a listagem
            return redirect()
                ->route('admin.usuario.index')
                ->with('sucesso', $mensagem);


        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível alterar o status do usuário. Tente mais tarde!');
        }
    }


}
