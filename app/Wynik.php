<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wynik extends Model 
{

    protected $table = 'wynik';
    public $timestamps = false;
     public function konto() {
        return $this->hasMany('App\User','id','konto_id');
    }
     public function zestaw() {
        return $this->hasMany('App\Zestaw','id','zestaw_id');
    }

}