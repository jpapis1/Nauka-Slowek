<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Podkategoria extends Model 
{

    protected $table = 'podkategoria';
    public $timestamps = false;
    public function zestaw() {
    	return $this->belongsTo('App\Zestaw','id');
    }
    public function kategoria() {
    	return $this->hasMany('App\Kategoria','id','kategoria_id');
    }

}