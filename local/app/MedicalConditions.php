<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\EncryptableTrait;

class MedicalConditions extends Model
{
    use EncryptableTrait;
    protected $encryptable = [
            'title'
        ];
}
