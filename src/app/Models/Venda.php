<?php


namespace App\Models;

use App\Models\Cliente;
use App\Models\ItemVenda;
use App\Models\Local;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;


Class Venda extends Model{

    protected $table = 'tbl_venda';
    protected $primaryKey = 'id_venda';

    public $timestamps = false;

    protected $fillable = [
        'data_hora_venda',
        'valor_total_venda',
        'forma_pagamento_venda',
        'id_cliente',
        'id_local',
        'origem_venda',
        'status_venda',
        'observacao_venda',
    ];

    // Uma venda pertence a um cliente (opcional no balcão)
    public function cliente(){
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    // Uma venda acontece em um local (mesa, balcão...)
    public function local(){
        return $this->belongsTo(Local::class, 'id_local', 'id_local');
    }

    // Uma venda tem muitos itens
    public function itens(){
        return $this->hasMany(ItemVenda::class, 'id_venda', 'id_venda');
    }

    // Funcionários que atenderam a venda (tbl_usuarios_venda)
    public function usuarios(){
        return $this->belongsToMany(User::class, 'tbl_usuarios_venda', 'id_venda', 'id_usuario', 'id_venda', 'id_usuarios');
    }

}
