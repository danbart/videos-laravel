<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    //crearemos el modelo de comentario
    protected $table= 'comments';
    //relacion de Many to one (muchos a uno)
    public function user(){
      return $this->belongsTo('App\User', 'user_id');
    }

}
