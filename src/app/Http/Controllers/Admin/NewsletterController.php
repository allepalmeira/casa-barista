<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;


class NewsletterController extends Controller
{
    // Listar todos os e-mails da newsletter: R
    public function index()
    {
        $listaNewsletter = Newsletter::orderByDesc('id_news')->get();

        return view('admin.newsletter.index', compact('listaNewsletter'));
    }

    // CADASTRAR E-MAIL NA NEWSLETTER: C
    public function store(Request $request)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'email_news' => 'required|email|max:80|unique:tbl_news,email_news',
            'aceite_news' => 'required|in:0,1'
        ]);

        try {

            // 2 - Cadastrar no banco de dados
            $newsletter = Newsletter::create([
                'email_news' => $dados['email_news'],
                'aceite_news' => $dados['aceite_news'],
            ]);

            // 3 - Voltar para a listagem
            return redirect()
                ->route('admin.newsletter.index')
                ->with('sucesso', 'E-mail: ' . $newsletter->email_news . ' foi cadastrado com sucesso!');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->withInput()
                ->with('erro', 'Não foi possível cadastrar o e-mail. Tente mais tarde!');
        }
    }

    // ATUALIZAR E-MAIL DA NEWSLETTER: U
    public function update(Request $request, int $id)
    {

        // 1 - Validar os dados
        $dados = $request->validate([
            'email_news' => 'required|email|max:80|unique:tbl_news,email_news,' . $id . ',id_news',
            'aceite_news' => 'required|in:0,1'
        ]);

        // 2 - Buscar o e-mail
        $newsletter = Newsletter::findOrFail($id);

        try {

            // ATUALIZA NO BANCO
            $newsletter->update([
                'email_news' => $dados['email_news'],
                'aceite_news' => $dados['aceite_news'],
            ]);

            // Voltar para a listagem
            return redirect()
                ->route('admin.newsletter.index')
                ->with('sucesso', 'E-mail: ' . $newsletter->email_news . ' foi atualizado com sucesso!');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível atualizar o e-mail. Tente mais tarde!');
        }
    } // FIM DA METODO UPDATE

    // ATIVAR e DESATIVAR o ACEITE da NEWSLETTER - D (U)
    public function status(Request $request, int $id)
    {

        try {

            $newsletter = Newsletter::findOrFail($id);

            $novoAceite = $newsletter->aceite_news == 1 ? 0 : 1;

            // ATUALIZA NO BANCO
            $newsletter->update([
                'aceite_news' => $novoAceite,
            ]);

            $mensagem = $novoAceite === 1 ? 'Inscrição ativada com sucesso' : 'Inscrição cancelada com sucesso';

            // Voltar para a listagem
            return redirect()
                ->route('admin.newsletter.index')
                ->with('sucesso', $mensagem);


        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->back()
                ->with('erro', 'Não foi possível alterar a inscrição. Tente mais tarde!');
        }
    }


}
