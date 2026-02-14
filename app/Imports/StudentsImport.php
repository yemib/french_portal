<?php

namespace App\Imports;

use App\Http\Models\Student;
use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    protected $extra_array;

    public function __construct($extra_array)
    {
        $this->extra_array = $extra_array;
    }

    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        if (Student::where("registration_number", $row[0])->count() < 1) {
            //check if the student was upploaded before  
            $check  =  User::where('email', $row[1])->first();

            if (!$check) {

                $user = new User();
                $user->email  =  $row[1];
                $password = strtolower($row[2]);
                $user->surname = $row[2];
                $user->other_names = $row[3];
                $user->password = bcrypt($password);
                $user->account_type = "student";
                $user->school_id = $this->extra_array["school"];
                $user->save();

                $student = new Student();
                $student->user_id = $user->id;
                $student->program_id = $this->extra_array["program"];
                $student->department_id = $this->extra_array["department"];
                $student->current_session = $this->extra_array["current_session"];
                $student->registration_number = $row[0];
                $student->save();

                return $user;
            }

            return  null;
        }

        return null;
    }
}
