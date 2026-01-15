<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        "start",
        "end"
    ];

    protected $dates = [
        "start",
        "end"
    ];
}
