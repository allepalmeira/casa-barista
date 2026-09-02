<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeria;


class GaleriaController extends Controller
{
    // Listar todas as imagens da galeria cadastradas
    public function index()
    {
        $listaGaleria = Galeria::orderByDesc('id_galeria')->get();
        
        $statusGaleria = Galeria::select('status_galeria')
        ->distinct()
        ->get();

        return view('admin.galeria.index', compact('listaGaleria', 'statusGaleria'));
    }
}