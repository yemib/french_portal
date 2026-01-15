<?php

namespace App;

use App\Http\Models\Lecturer;
use App\Http\Models\Setting;
use App\Http\Models\Student;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "surname",
        "other_names",
        "email",
        "email_verified_at",
        "password",
        "gender",
        "account_type",
        "school_id"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setFullNameAttribute($full_name)
    {
        if(strpos($full_name, " "))
        {
            $full_name = explode(" ", $full_name);
            $this->surname = $full_name[0];
            $this->other_names = "";
            for ($i=1; $i < count($full_name); $i++)
            {
                $this->other_names .= (($i == 1) ? "" : " ").$full_name[$i];
            }
        } else {
            $this->surname = $full_name;
        }
    }

    public function getFullNameAttribute()
    {
        return ucwords($this->surname." ".$this->other_names);
    }

    public function getRoleAttribute()
    {
        return ucwords(preg_replace("#[^a-zA-Z]#", " ", $this->account_type));
    }

    public function lecturer()
    {
        return $this->hasOne(Lecturer::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function school()
    {
        //return $this->id;
        return $this->belongsTo(Setting::class, "school_id");
    }
}
