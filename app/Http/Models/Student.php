<?php

namespace App\Http\Models;

use App\App\Http\Models\StudentBio;
use App\Exports\AllStudentsSheetExport;
use App\Http\Models\Payment;
use App\Models\ResultRemark;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Student extends Model
{
    protected $fillable = [
        "user_id",
        "program_id",
        "department_id",
        "registration_number",
        "current_session",
        "active"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function course_results()
    {
        return $this->hasMany(CourseResult::class);
    }

    public function result_remark()
    {
        return $this->hasOne(ResultRemark::class);
    }

    // public function getResultRemarkAttribute()
    // {
    //     return ResultRemark::where('student_id', $this->id)->first();
    // }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function remita_payments()
    {
        return $this->hasMany(RemitaPayment::class);
    }

    public function biodata()
    {
        return $this->hasOne(StudentBio::class);
    }

    public function getCurrentSessionCoursesAttribute()
    {
        $current_session_courses = [];

        if($current_session_courses = Course::where("department_id", $this->department_id)->where("level", $this->current_session)->get())
        {
            return $current_session_courses;
        } else {
            return [];
        }
    }

    public function get_session_courses($session)
    {
        $session_courses = [];

        if($session_courses = Course::where("department_id", $this->department_id)->where("level", $session)->get())
        {
            return $session_courses;
        } else {
            return [];
        }
    }

    public function assignHostel()
    {
        $current_session = Session::orderBy("start", "desc")->first();

        // Check if this student has no hostel allocated for the session, then assign hostel if not
        if(HostelAllocation::where("student_id", $this->id)->where("session_id", $current_session->id)->count() < 1)
        {
            // Check if there's any hostel with an empty space for the current session
            foreach(Hostel::orderByRaw('RAND()')->get() as $hostel)
            {
                for($room_count = 1; $room_count <= $hostel->rooms; $room_count++)
                {
                    for($space = 1; $space <= $hostel->room_capacity; $space++)
                    {
                        if($hostel->hostel_allocations
                            ->where("session_id", $current_session->id)
                            ->where("room_number", $room_count)
                            ->where("space_id", $space)
                            ->count() < 1)
                        {
                            // There's still available space in this hostel so assign student there
                            $hostel_allocation = new HostelAllocation();
                            $hostel_allocation->student_id = $this->id;
                            $hostel_allocation->hostel_id = $hostel->id;
                            $hostel_allocation->session_id = $current_session->id;
                            $hostel_allocation->room_number = $room_count;
                            $hostel_allocation->space_id = $space;
                            $hostel_allocation->save();
                            return $hostel_allocation;
                        }
                    }
                }
            }
        }

        return null;
    }

    public function getCurrentAccommodationAttribute()
    {
        $current_session = Session::orderBy("start", "desc")->first();

        return HostelAllocation::where("student_id", $this->id)->where("session_id", $current_session->id)->first();
    }

    public function downloadResult($format, $student, $session)
    {
        switch($format)
        {
            case "pdf":

                $pdf = App::make('dompdf.wrapper');
                $pdf->loadView("pdf.student.result", compact("student", "session"));
                return $pdf->download("Student Result Transcript.pdf");

                break;
            case "excel":
                return "Chill, Excel download is coming soon!!!";
                break;
        }
    }

    public static function downloadStudentSheet($format)
    {
        switch($format)
        {
            case "pdf":
                return "Chill, PDF download is coming soon!!!";
                break;
            case "excel":
                $students = Student::get();

                $studentArray = [];
                $student_array = [];
                foreach ($students as $student) {
                    $student_array['registration_number'] = $student->registration_number;
                    $student_array['full_name'] = $student->user->full_name;
                    $student_array["program"] = $student->program->title;
                    $student_array["department"] = $student->department->title;
                    $studentArray[] = $student_array;
                }

                return Excel::download(new AllStudentsSheetExport($studentArray), "Student Sheet for all students ". date('dmYhim').".xlsx");

                break;
            default:
                return null;
                break;
        }
    }
}
