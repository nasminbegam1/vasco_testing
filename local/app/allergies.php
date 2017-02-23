<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\EncryptableTrait;
class Allergies extends Model
{
    use EncryptableTrait;
    protected $encryptable = [
            'title', 'dosage','time_frame'
        ];
}
