<?php

namespace App\Http\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $fillable = [
        "user_id",
        "staff_id",
        "department_id",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function getDepartmentCoursesAttribute()
    {
        return Course::where("department_id", $this->department_id)->orderBy("level", "asc")->get();
    }
}
