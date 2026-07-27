<?php


namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Banner;

class HomeController extends Controller{


    // Metodo HOME - Carregar a INDEX (HOME)
    public function home(){


        //Busque a lista de banner para exibir na Home (Views)
        $listaBanner = Banner::where('status_banner', 'ATIVO')->inRandomOrder()->get();

        //dd($listaBanner);
        //var_dump($listaBanner);

        return view('site.home.home', compact('listaBanner'));

    }



} // FIM DA CLASS