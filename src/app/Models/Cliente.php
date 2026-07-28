<?php


namespace App\Models;


use illuminate\Database\Eloquent\Model;


Class Cliente extends Model{

    protected $table = 'tbl_cliente';
    protected $primaryKey = 'id_cliente';
    public $timestamps = true;

    const CREATED_AT = 'data_criacao_cliente';
    const UPDATED_AT = 'data_atualizacao_cliente';

    protected $fillable = [
        'nome_cliente',
        'email_cliente',
        'senha_cliente',
        'foto_cliente',
        'status_cliente',
    ];

    // Relacionameto um CLIENTE pertence a muitos DEPOIMENTOS
    // hasMany = muitos
    public function ClienteDepoimento(){
        return $this->hasMany(Depoimento::class, 'id_cliente', 'id_cliente');
    }
      	



}