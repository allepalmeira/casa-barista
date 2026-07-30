<?php

namespace App\Models;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Model;


class Categoria extends Model
{
    protected $table = 'tbl_categoria';

    protected $primaryKey = 'id_categoria';

    const CREATED_AT = 'data_criacao_categoria';
    const UPDATED_AT = 'data_atualizacao_categoria';

    protected $fillable = [
        'nome_categoria',
        'status_categoria',
    ];

    // Uma categoria pertence a muitos produtos
    public function produtos()    {
        return $this->hasMany(Produto::class, 'id_categoria', 'id_categoria' );
    }
}