<?php

namespace App\App\Http\Models;

use App\Http\Models\State;
use App\Http\Models\Student;
use Illuminate\Database\Eloquent\Model;

class StudentBio extends Model
{
    protected $table = "student_bio";

 

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /*public function setStateOfOriginAttribute()
    {
        return State::find($this->state_of_origin)->name;
    }*/

    public function getStateAttribute()
    {
        return State::find($this->state_of_origin)->name;
    }
}
