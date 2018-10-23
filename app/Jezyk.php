<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jezyk extends Model 
{

    protected $table = 'jezyk';
    public $timestamps = false;
    public function zestaw() {
    	return $this->belongsTo('App\Zestaw','id');
    }

}