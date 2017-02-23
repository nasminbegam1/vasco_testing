<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\EncryptableTrait;

class Patients extends Model
{
    use EncryptableTrait;
    protected $encryptable = [
            'first_name', 'last_name','name','address','city_id','zip','phone_home','phone_mobile','contact_name','pet_type','emergency_contact_name','emergency_contact_number','relationship',
            'billing_address','billing_city_id','billing_zip','credit_card','cvv'
        ];
    
    public function setPasswordAttribute($password){   
        $this->attributes['password'] = bcrypt($password);
    }
    
    
    public function cities(){
        return $this->belongsTo('App\Cities','city_id');
    }
}
