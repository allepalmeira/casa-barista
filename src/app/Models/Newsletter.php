<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


Class Newsletter extends Model{

    protected $table = 'tbl_news';
    protected $primaryKey = 'id_news';

    public $timestamps = false;

    protected $fillable = [
        'email_news',
        'aceite_news',
    ];

}
