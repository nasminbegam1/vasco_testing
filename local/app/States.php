<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    public function cities(){
        return $this->hasMany('App\Cities','state_id');
    }
}
