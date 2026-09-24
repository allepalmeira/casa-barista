<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{

    // INSCREVER NA NEWSLETTER (formulário do rodapé) - aparece no dashboard em "Newsletter"
    public function store(Request $request){

        // Volta para a mesma página, direto no formulário do rodapé
        $voltar = url()->previous() . '#newsletter';

        // 1 - Validar (erro com nome próprio para não misturar com outros formulários da página)
        $validador = validator($request->all(), [
            'email' => 'required|email|max:80',
        ], [
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um e-mail válido.',
        ]);

        if ($validador->fails()) {
            return redirect()->to($voltar)->with('newsletter_erro', $validador->errors()->first('email'));
        }

        try {

            $email = strtolower($request->input('email'));

            $inscricao = Newsletter::where('email_news', $email)->first();

            // 2 - Já inscrito / reativar / nova inscrição
            if ($inscricao && $inscricao->aceite_news == 1) {
                $mensagem = 'Este e-mail já está inscrito. Obrigado!';
            } elseif ($inscricao) {
                $inscricao->update(['aceite_news' => 1]);
                $mensagem = 'Inscrição reativada! Você voltará a receber nossas novidades.';
            } else {
                Newsletter::create(['email_news' => $email, 'aceite_news' => 1]);
                $mensagem = 'Inscrição feita! Você receberá nossas novidades e promoções.';
            }

            return redirect()->to($voltar)->with('newsletter_sucesso', $mensagem);
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()->to($voltar)->with('newsletter_erro', 'Não foi possível fazer a inscrição. Tente mais tarde!');
        }

    }

}
