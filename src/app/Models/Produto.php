<?php

namespace App\Models;
use App\Models\Categoria;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model{

    protected $table = 'tbl_produto';
    protected $primaryKey = 'id_produto';

    public $timestamps = false;

    protected $fillable = [
        'nome_produto',
        'id_categoria',
        'descricao_curta_produto',
        'descricao_longa_produto',
        'valor_produto',
        'imagem_produto',
        'destaque_produto',
        'status_produto',
    ];


    // Um produto pertence a uma categoria
    public function categoria() { 
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria' );
    }

}



