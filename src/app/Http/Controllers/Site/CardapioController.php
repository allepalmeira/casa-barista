<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class CardapioController extends Controller
{

    public function cardapio(){

        return view('site.cardapio.cardapio');

    }

}