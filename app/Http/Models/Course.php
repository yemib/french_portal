<?php

namespace App\Http\Models;

use App\Exports\StudentSheetExport;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;

class Course extends Model
{
    protected $fillable = [
        "title",
        "department_id",
        "level"
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function getStudentsAttribute()
    {
        return Student::where("current_session", $this->level)->where("department_id", $this->department_id)->get();
    }

    public function downloadStudentSheet($format)
    {
        switch($format)
        {
            case "pdf":
                return "Chill, PDF download is coming soon!!!";
                break;
            case "excel":
                $students = Student::where("current_session", $this->level)->where("department_id", $this->department_id)->get();

                $studentArray = [];
                $student_array = [];
                foreach ($students as $student) {
                    $student_array['registration_number'] = $student->registration_number;
                    $student_array['full_name'] = $student->user->full_name;
                    $student_array["score"] = ($this->student_result($student->id)) ? $this->student_result($student->id)->score : "";
                    $studentArray[] = $student_array;
                }

                return Excel::download(new StudentSheetExport($studentArray), "Student Sheet for " . $this->title . " " . date('dmYhim').".xlsx");

                break;
            default:
                return null;
                break;
        }
    }

    public function student_result($student_id)
    {
        return CourseResult::where("student_id", $student_id)->where("course_id", $this->id)->first();
    }

    public function getCanUploadResultAttribute()
    {
        if(auth()->check())
        {
            switch (auth()->user()->account_type)
            {
                case "super_admin":
                    return true;
                    break;
                case "senior_lecturer":

                    if(auth()->user()->lecturer->department_id == $this->department_id)
                    {
                        return true;
                    }
                    break;
            }
        }

        return false;
    }
}
