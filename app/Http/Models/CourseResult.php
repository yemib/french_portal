<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CourseResult extends Model
{
    protected $fillable = [
        "course_id",
        "student_id",
        "score",
        "added_by",
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
