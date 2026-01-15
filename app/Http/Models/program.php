<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        "title",
        "duration"
    ];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
