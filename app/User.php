<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'konto';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'imie','nazwisko','login', 'email', 'haslo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
        public function rola() {
        return $this->hasMany('App\Rola','id','rola_id');
    }
    public function zestaw() {
        return $this->belongsTo('App\Zestaw','zestaw_id','id');
    }
}
