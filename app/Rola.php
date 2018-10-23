<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rola extends Model 
{

    protected $table = 'rola';
    public $timestamps = false;
    public function konto() {
    	return $this->belongsTo('App\User','id');
    }
}