<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


Class Galeria extends Model{

    protected $table = 'tbl_galeria';
    protected $primaryKey = 'id_galeria';

    public $timestamps = false;

    protected $fillable = [
        'nome_galeria',
        'imagem_galeria',
        'status_galeria',
    ];

}

