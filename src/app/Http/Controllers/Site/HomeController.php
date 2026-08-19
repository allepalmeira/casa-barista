<?php


namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Depoimento;

class HomeController extends Controller{


    // Metodo HOME - Carregar a INDEX (HOME)
    public function home(){

        //Busque a lista de banner para exibir na Home (Views)
        $listaBanner = Banner::where('status_banner', 'ATIVO')->inRandomOrder()->get();

        //dd($listaBanner);
        //var_dump($listaBanner);

        //Buscar os depoimentos APROVADO junto com os dados dos clientes
        $listaDepo = Depoimento::with('DepoimentoCliente')
                                ->where('status_depoimento', 'APROVADO')
                                ->orderByDesc('id_depoimento')
                                ->get();
        //dd($listaDepo->toArray());

        return view('site.home.home', compact('listaBanner','listaDepo'));

    }

} // FIM DA CLASS