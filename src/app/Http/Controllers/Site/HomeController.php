<?php


namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class HomeController extends Controller{


    // Metodo HOME - Carregar a INDEX (HOME)
    public function home(){

        return view('site.home.home');

    }



} // FIM DA CLASS