<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategoria extends Model 
{

    protected $table = 'kategoria';
    public $timestamps = false;
    public function podkategoria() {
    	return $this->belongsTo('App\Podkategoria','id','id');
    }

}