<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


// Pessoas exibidas no site (seção "Quem Somos")
Class Equipe extends Model{

    protected $table = 'tbl_equipe';
    protected $primaryKey = 'id_equipe';

    public $timestamps = false;

    protected $fillable = [
        'nome_equipe',
        'cargo_equipe',
        'foto_equipe',
        'ordem_equipe',
        'status_equipe',
    ];

}
