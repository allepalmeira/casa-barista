<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ClienteController extends Controller
{
    // Listar todos os clientes cadastrados: R
    public function index()
    {
        $listaClientes = Cliente::orderBy('nome_cliente')->get();

        return view('admin.cliente.index', compact('listaClientes'));
    }

    // CADASTRAR CLIENTE: C
    public function store(Request $request)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'nome_cliente' => 'required|max:50',
            'email_cliente' => 'required|email|max:80|unique:tbl_cliente,email_cliente',
            'senha_cliente' => 'required|min:6',
            'foto_cliente' => 'required|image|mimes:jpg,png,webp,jpeg|max:4096',
            'status_cliente' => 'required|in:ATIVO,INATIVO'
        ]);

        $caminhoArquivo = null;

        try {

            DB::beginTransaction();


            // 2 - Cadastrar no banco de dados
            $cliente = Cliente::create([
                'nome_cliente' => $dados['nome_cliente'],
                'email_cliente' => $dados['email_cliente'],

                // Senha criptografada
                'senha_cliente' => Hash::make($dados['senha_cliente']),

                // Valor temporario
                'foto_cliente' => 'cliente/sem-foto.png',
                'status_cliente' => $dados['status_cliente'],
            ]);

            // 3 - Receber a foto enviada
            $imagem = $request->file('foto_cliente');

            // 4 - Criar um nome para a foto - Lucas Martins mudar para: lucas-martins_7.png
            $nomeSlug = Str::slug($dados['nome_cliente']);

            // 5 - Pegar a extensao do arquivo
            $extensao = strtolower($imagem->getClientOriginalExtension());

            // 6- Criar nome FINAL
            $nomeImg = $nomeSlug . '_' . $cliente->id_cliente . '.' . $extensao;

            // 7 - Salvar a foto
            $pasta = public_path('barista/img/cliente');

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
            $cliente->foto_cliente = 'cliente/' . $nomeImg;
            $cliente->save();

            DB::commit();

            // 11 - Voltar para a listagem
            return redirect()
                ->route('admin.cliente.index')
                ->with('sucesso', 'Cliente: ' . $cliente->nome_cliente . ' foi cadastrado com sucesso!');
        } catch (\Throwable $erro) {

            DB::rollBack();

            if ($caminhoArquivo && file_exists($caminhoArquivo)) {
                unlink($caminhoArquivo);
            }

            report($erro);

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível cadastrar o cliente. Tente mais tarde!');
        }
    }

    // ATUALIZAR CLIENTE: U
    public function update(Request $request, int $id)
    {

        // 1 - Validar os dados (senha vazia = mantém a atual)
        $dados = $request->validate([
            'nome_cliente' => 'required|max:50',
            'email_cliente' => 'required|email|max:80|unique:tbl_cliente,email_cliente,' . $id . ',id_cliente',
            'senha_cliente' => 'nullable|min:6',
            'foto_cliente' => 'nullable|image|mimes:jpg,png,webp,jpeg|max:4096',
            'status_cliente' => 'required|in:ATIVO,INATIVO'
        ]);

        // 2 - Buscar o cliente
        $cliente = Cliente::findOrFail($id);

        try {

            // Nome atual
            $nomeSlug = Str::slug($dados['nome_cliente']);

            // O nome da pasta
            $pasta = public_path('barista/img/cliente');

            // O caminho salvo no banco
            $caminhoArquivo = $cliente->foto_cliente;

            // Caminho físico da foto atual
            $imgAntiga = public_path('barista/img/' . $cliente->foto_cliente);

            // CASO 1: NOVA FOTO
            if ($request->hasFile('foto_cliente')) {

                $imagem = $request->file('foto_cliente');

                $extensao = strtolower($imagem->getClientOriginalExtension());

                $nomeImg = $nomeSlug . '_' . $cliente->id_cliente . '.' . $extensao;

                // Excluir a foto anterior
                if (file_exists($imgAntiga)) {
                    unlink($imgAntiga);
                }

                // Salva a nova foto
                $imagem->move($pasta, $nomeImg);

                $caminhoArquivo = 'cliente/' . $nomeImg;
            } elseif ($cliente->nome_cliente !== $request->nome_cliente) {

                // CASO 2 - MUDOU SOMENTE O NOME
                $extensao = pathinfo($cliente->foto_cliente, PATHINFO_EXTENSION);

                $nomeImg = $nomeSlug . '_' . $cliente->id_cliente . '.' . $extensao;

                $novaImagem = public_path('barista/img/cliente/' . $nomeImg);

                if (file_exists($imgAntiga)) {

                    rename(
                        $imgAntiga,
                        $novaImagem
                    );

                    $caminhoArquivo = 'cliente/' . $nomeImg;
                }
            }

            $atualizar = [
                'nome_cliente' => $dados['nome_cliente'],
                'email_cliente' => $dados['email_cliente'],
                'foto_cliente' => $caminhoArquivo,
                'status_cliente' => $dados['status_cliente'],
            ];

            // Só troca a senha se uma nova foi informada
            if (!empty($dados['senha_cliente'])) {
                $atualizar['senha_cliente'] = Hash::make($dados['senha_cliente']);
            }

            // ATUALIZA NO BANCO
            $cliente->update($atualizar);

            // Voltar para a listagem
            return redirect()
                ->route('admin.cliente.index')
                ->with('sucesso', 'Cliente: ' . $cliente->nome_cliente . ' foi atualizado com sucesso!');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível atualizar o cliente. Tente mais tarde!');
        }
    } // FIM DA METODO UPDATE

    // ATIVAR e DESATIVAR o CLIENTE - D (U)
    public function status(Request $request, int $id)
    {

        try {

            $cliente = Cliente::findOrFail($id);

            $novoStatus = $cliente->status_cliente === 'ATIVO' ? 'INATIVO' : 'ATIVO';

            // ATUALIZA NO BANCO
            $cliente->update([
                'status_cliente' => $novoStatus,
            ]);

            $mensagem = $novoStatus === 'ATIVO' ? 'Cliente ativado com sucesso' : 'Cliente desativado com sucesso';

            // Voltar para a listagem
            return redirect()
                ->route('admin.cliente.index')
                ->with('sucesso', $mensagem);


        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível alterar o status do cliente. Tente mais tarde!');
        }
    }


}
