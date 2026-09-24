<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    // Assuntos do formulário (a coluna assunto_contato tem 7 caracteres)
    const ASSUNTOS = ['Dúvida', 'Pedido', 'Reserva', 'Evento', 'Elogio'];

    public function contato(){

        $assuntos = self::ASSUNTOS;

        return view('site.contato.contato', compact('assuntos'));

    }

    // ENVIAR MENSAGEM - chega no dashboard em "Mensagens" como NOVO
    public function store(Request $request){

        // 1 - Validar os dados
        $dados = $request->validate([
            'nome' => 'required|max:50',
            'email' => 'required|email|max:80',
            'fone' => 'nullable|max:14',
            'assunto' => 'required|in:' . implode(',', self::ASSUNTOS),
            'mens' => 'required|max:2000',
        ], [
            'nome.required' => 'Informe seu nome.',
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'assunto.required' => 'Selecione o assunto.',
            'mens.required' => 'Digite sua mensagem.',
        ]);

        try {

            // 2 - Gravar a mensagem
            Contato::create([
                'nome_contato' => $dados['nome'],
                'email_contato' => $dados['email'],
                'telefone_contato' => $dados['fone'] ?? '',
                'assunto_contato' => $dados['assunto'],
                'mensagem_contato' => $dados['mens'],
                'status_contato' => 'NOVO',
            ]);

            return redirect()
                ->to(route('contato') . '#formulario')
                ->with('sucesso', 'Mensagem enviada! Em breve entraremos em contato.');
        } catch (\Throwable $erro) {

            report($erro);

            return redirect()
                ->to(route('contato') . '#formulario')
                ->withInput()
                ->with('erro', 'Não foi possível enviar sua mensagem. Tente mais tarde!');
        }

    }

}
