<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    //
   public function anunciante(){
        return $this->hasOne('App\User','email','email');
   }
}
