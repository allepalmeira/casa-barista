<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


Class Banner extends Model{

    protected $table = 'tbl_banner';
    protected $primaryKey = 'id_banner';

    public $timestamps = false;

    protected $fillable = [
        'titulo_banner',
        'imagem_banner',
        'status_banner',
    ];

}

