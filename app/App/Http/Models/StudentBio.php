<?php

namespace App\App\Http\Models;

use App\Http\Models\State;
use App\Http\Models\Student;
use Illuminate\Database\Eloquent\Model;

class StudentBio extends Model
{
    protected $table = "student_bio";

    protected $fillable = [
        "student_id",
        "phone",
        "dob",
        "school_of_origin",
        "state_of_origin",
        "next_of_kin_name",
        "next_of_kin_phone",
        "next_of_kin_address",
    ];

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
