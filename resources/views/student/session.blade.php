@extends('layouts.app')

@section("page_title", "Level ".$session_count)

@section('page_content')
    
    <?php  

use App\Http\Models\result;
use App\Http\Models\results_format;

?>
    

    <div class="row pt-3">
        <div class="col-12 col-sm-4 col-md-3">
            <div class="card-box">
                <div class="student-profile-box text-center p-2">
                   
                   
                    <div class="avatar mb-1">
                        <img src="{{ asset(($user->avatar) ? "storage/images/avatar/".$user->id."/".$user->avatar : "_dashboard/assets/images/users/avatar-1.jpg") }}" class="img-fluid img-rounded img-thumbnail">
                    </div>
                    
                    
                    <div class="mt-1">
                        <i class="mdi mdi-account-outline"></i> <b>{{ $user->full_name }}</b>
                    </div>
                    <div class="mt-1">
                        <i class="mdi mdi-tab"></i> {{ $user->student->registration_number }}
                    </div>
                    <div class="mt-1">
                        <i class="mdi mdi-book-open"></i> {{ $user->student->program->title }}
                    </div>
                    <div class="mt-1">
                        <i class="mdi mdi-book-open-variant"></i> {{ $user->student->department->title }}
                    </div>
                    <div class="mt-1">
                        Level: <b>{{ $user->student->current_session }}</b>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-8 col-md-9">
            <div class="card-header bg-dark text-white">
                Level: <b>{{ $session_count }}</b> Courses
            </div>
            <div class="table-responsive card-box">
                <div class="text-right mb-2">
                    <a href="{{ route("student.download-result", ["format" => "pdf", "student_id" => $user->student->id, "session" => $session_count]) }}" class="btn btn-outline-success">
                        <i class="mdi mdi-download"></i> Download
                    </a>
                </div>
                
                    
                    <?php
						$result_format = results_format::where('program_id' , $user->student->program->id  )->where('session'  ,  $session_count )->get();
						
						$result = result::where('program_id' , $user->student->program->id  )->where('session'  ,  $session_count)->where('matric',$user->student->registration_number )->get();
						
						$grade = result::where('program_id' , $user->student->program->id  )->where('session'  ,  $session_count)->where('matric',$user->student->registration_number )->first();
						
						?>
                   
                
                @include('student_result')
                
                
                
            </div>
        </div>
    </div>

@endsection

@section("page_scripts")
@endsection