<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venda;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


// Perfil do funcionário logado: dados, edição e histórico de atendimentos
class PerfilController extends Controller
{
    // VER PERFIL: R
    public function index()
    {
        $usuario = Auth::user();

        // Vendas que este funcionário atendeu (tbl_usuarios_venda)
        $idsVendas = DB::table('tbl_usuarios_venda')
            ->where('id_usuario', $usuario->id_usuarios)
            ->pluck('id_venda');

        $vendasFinalizadas = Venda::whereIn('id_venda', $idsVendas)->where('status_venda', 'FINALIZADA');

        $qtdeAtendimentos = $idsVendas->count();
        $qtdeFinalizadas = (clone $vendasFinalizadas)->count();
        $totalVendido = (clone $vendasFinalizadas)->sum('valor_total_venda');
        $ticketMedio = $qtdeFinalizadas > 0 ? $totalVendido / $qtdeFinalizadas : 0;
        $qtdeComandasAbertas = Venda::whereIn('id_venda', $idsVendas)->where('status_venda', 'EM ANDAMENTO')->count();

        // Produtos que ele mais vendeu (vendas finalizadas)
        $maisVendidos = DB::table('tbl_itens_venda as i')
            ->join('tbl_produto as p', 'p.id_produto', '=', 'i.id_produto')
            ->join('tbl_venda as v', 'v.id_venda', '=', 'i.id_venda')
            ->whereIn('v.id_venda', $idsVendas)
            ->where('v.status_venda', 'FINALIZADA')
            ->selectRaw('p.nome_produto as produto, SUM(i.qtde_itens_venda) as qtde')
            ->groupBy('p.nome_produto')
            ->orderByDesc('qtde')
            ->limit(3)
            ->get();

        // Histórico de atendimentos (10 por página)
        $historico = Venda::with(['local', 'cliente'])
            ->whereIn('id_venda', $idsVendas)
            ->orderByDesc('data_hora_venda')
            ->paginate(10);

        return view('admin.perfil.index', compact(
            'usuario', 'qtdeAtendimentos', 'qtdeFinalizadas', 'totalVendido', 'ticketMedio',
            'qtdeComandasAbertas', 'maisVendidos', 'historico'
        ));
    }

    // ATUALIZAR PERFIL: U
    // (nível e status só podem ser alterados por quem gerencia os usuários)
    public function update(Request $request)
    {
        $usuario = Auth::user();

        // 1 - Validar os dados (senha só muda se preencher a nova)
        $dados = $request->validate([
            'nome_usuarios' => 'required|max:50',
            'email_usuarios' => 'required|email|max:80|unique:tbl_usuarios,email_usuarios,' . $usuario->id_usuarios . ',id_usuarios',
            'foto_usuarios' => 'nullable|image|mimes:jpg,png,webp,jpeg|max:4096',
            'senha_atual' => 'nullable|required_with:nova_senha|current_password',
            'nova_senha' => 'nullable|min:6|confirmed',
        ], [
            'senha_atual.current_password' => 'A senha atual não confere.',
            'senha_atual.required_with' => 'Informe a senha atual para trocar a senha.',
            'nova_senha.confirmed' => 'A confirmação da nova senha não confere.',
        ]);

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
                if ($usuario->foto_usuarios && is_file($imgAntiga)) {
                    unlink($imgAntiga);
                }

                // Salva a nova foto
                $imagem->move($pasta, $nomeImg);

                $caminhoArquivo = 'usuario/' . $nomeImg;
            } elseif ($usuario->nome_usuarios !== $request->nome_usuarios && is_file($imgAntiga)) {

                // CASO 2 - MUDOU SOMENTE O NOME
                $extensao = pathinfo($usuario->foto_usuarios, PATHINFO_EXTENSION);

                $nomeImg = $nomeSlug . '_' . $usuario->id_usuarios . '.' . $extensao;

                rename($imgAntiga, $pasta . DIRECTORY_SEPARATOR . $nomeImg);

                $caminhoArquivo = 'usuario/' . $nomeImg;
            }

            $atualizar = [
                'nome_usuarios' => $dados['nome_usuarios'],
                'email_usuarios' => $dados['email_usuarios'],
                'foto_usuarios' => $caminhoArquivo,
            ];

            // Só troca a senha se uma nova foi informada (o model criptografa)
            if (!empty($dados['nova_senha'])) {
                $atualizar['senha_usuarios'] = $dados['nova_senha'];
            }

            // ATUALIZA NO BANCO
            $usuario->update($atualizar);

            return redirect()
                ->route('admin.perfil.index')
                ->with('sucesso', 'Perfil atualizado com sucesso!');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível atualizar o perfil. Tente mais tarde!');
        }
    }


}
