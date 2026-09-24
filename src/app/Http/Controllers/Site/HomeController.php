<?php


namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class HomeController extends Controller{


    // Metodo HOME - Carregar a INDEX (HOME)
    // Os dados de cada seção (banner, linha do tempo, destaques, cardápio, galeria e depoimentos)
    // são carregados no AppServiceProvider (View::composer), porque as mesmas seções
    // também aparecem nas páginas Sobre, Eventos e Contato.
    public function home(){

        return view('site.home.home');

    }

} // FIM DA CLASS
