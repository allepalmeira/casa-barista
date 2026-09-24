<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


// Mensagens enviadas pelo formulário de contato do site
Class Contato extends Model{

    protected $table = 'tbl_contato';
    protected $primaryKey = 'id_contato';

    public $timestamps = false;

    protected $fillable = [
        'nome_contato',
        'email_contato',
        'telefone_contato',
        'assunto_contato',
        'mensagem_contato',
        'status_contato',
    ];

}
