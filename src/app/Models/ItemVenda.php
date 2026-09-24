<?php


namespace App\Models;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Model;


Class ItemVenda extends Model{

    protected $table = 'tbl_itens_venda';
    protected $primaryKey = 'id_itens_venda';

    public $timestamps = false;

    protected $fillable = [
        'id_venda',
        'id_produto',
        'qtde_itens_venda',
        'valor_unit_itens_venda',
        'subtotal_itens_venda',
        'status_itens_venda',
    ];

    // Um item pertence a um produto
    public function produto(){
        return $this->belongsTo(Produto::class, 'id_produto', 'id_produto');
    }

}
