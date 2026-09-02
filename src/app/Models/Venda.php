<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


Class Venda extends Model{

    protected $table = 'tbl_venda';
    protected $primaryKey = 'id_venda';

    public $timestamps = false;

    protected $fillable = [
        'valor_total_venda',
        'forma_pagamento_venad',
        'status_venda',
    ];

}

