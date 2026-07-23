<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class EventoController extends Controller
{

    public function evento(){

        return view('site.evento.evento');

    }

}