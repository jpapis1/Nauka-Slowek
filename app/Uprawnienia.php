<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uprawnienia extends Model 
{

    protected $table = 'uprawnienia';
    public $timestamps = false;
    public function konto() {
    	return $this->hasMany('App\User','id','konto_id');
    }
    public function podkategoria() {
    	return $this->hasMany('App\Podkategoria','id','podkategoria_id');
    }

}