<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class HostelAllocation extends Model
{
    protected $fillable = [
        "hostel_id",
        "student_id",
        "session_id",
        "space_id",
    ];

    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
