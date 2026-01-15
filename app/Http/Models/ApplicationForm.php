<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationForm extends Model
{
    protected function getFullNameAttribute()
    {
        return ucwords($this->surname." ".$this->first_name." ".$this->other_names);
    }

    protected $dates = [
        "dob"
    ];
}
