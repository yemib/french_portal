<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class RemitaPayment extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
