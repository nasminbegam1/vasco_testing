<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    public function states(){
        return $this->belongsTo('App\States','state_id');
    }
    
    public function patients(){
        return $this->belongsTo('App\Patients','city_id');
    }
}
