<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


Class LinhaTempo extends Model{

    protected $table = 'tbl_linha_tempo';
    protected $primaryKey = 'id_linha_tempo';

    public $timestamps = false;

    protected $fillable = [
        'titulo_linha_tempo',
        'ano_linha_tempo',
        'descricao_linha_tempo',
        'status_linha_tempo',
    ];

}
