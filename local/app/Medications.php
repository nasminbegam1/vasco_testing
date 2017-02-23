<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\EncryptableTrait;

class Medications extends Model
{
    use EncryptableTrait;
    protected $encryptable = [
            'title', 'dosage','time_frame'
        ];
    
    //
}
