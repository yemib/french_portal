<?php

namespace App\Http\Models;

use App\App\Http\Models\Voucher;
use App\Http\Models\Student;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        "student_id",
        "session",
        "voucher_id",
        "amount",
        "reason",
        "verified",
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function getReferenceAttribute()
    {
        return $this->voucher->code;
    }
}
