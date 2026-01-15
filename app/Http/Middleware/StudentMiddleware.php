<?php

namespace App\Http\Middleware;

use Closure;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->check() && auth()->user()->account_type == 'student')
        {
            // Check if Student has made payment for the current session
            $student = auth()->user()->student;
            if($student->remita_payments/*->where("session", $student->current_session)*/->where("reason", "tuition")->where("paid", true)->count() > 0 /*&& $student->remita_payments->where("reason", "access")->where("paid", true)->count() > 0 */)
            {
                if($student->biodata)
                {
                    return $next($request);
                }

                return redirect()->route("student.bio")->with("danger", "Please fill your biodata form");
				
				
				
            }

            return redirect()->route("student.make-payment")->with("danger", "Please make your payment before you proceed");
        }

        return redirect()->route('login')->with('danger', 'Please sign in to continue');
    }
}
