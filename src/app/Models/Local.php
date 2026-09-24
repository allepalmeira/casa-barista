<?php


namespace App\Models;

use App\Models\Venda;
use Illuminate\Database\Eloquent\Model;


Class Local extends Model{

    protected $table = 'tbl_local';
    protected $primaryKey = 'id_local';

    public $timestamps = false;

    protected $fillable = [
        'nome_local',
        'tipo_local',
        'codigo_local',
        'status_local',
    ];

    // Um local tem muitas vendas
    public function vendas(){
        return $this->hasMany(Venda::class, 'id_local', 'id_local');
    }

    // Endereço gravado no QR Code - o aplicativo do cliente (futuro) vai abrir por aqui
    public function urlPedido(){
        return rtrim(config('app.pedido_url'), '/') . '/' . $this->codigo_local;
    }

}
