<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zestaw extends Model 
{

    protected $table = 'zestaw';
    public $timestamps = false;

public function konto() {
    	return $this->hasMany('App\User','id','konto_id');
    }
    public function jezyk1() {
    	return $this->hasMany('App\Jezyk','id','jezyk1_id');
    }
    public function jezyk2() {
    	return $this->hasMany('App\Jezyk','id','jezyk2_id');
    }
    public function podkategoria() {
    	return $this->hasMany('App\Podkategoria','id','podkategoria_id');
    }
    public function wynik() {
    	return $this->belongsTo('App\Wynik','id');
    }
}