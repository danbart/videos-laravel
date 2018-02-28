<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    //crearemos nuestro modelo de vidio

    protected $table = 'videos';

    //relacion one to many (uno a muchos)
    public function comments(){
      return $this->hasMany('App\comment')->orderBy('id','desc');
      //hasOne --- es de uno a uno
    }

    //relacion de Many to one (muchos a uno)
    public function user(){
      return $this->belongsTo('App\User', 'user_id');
    }
}
