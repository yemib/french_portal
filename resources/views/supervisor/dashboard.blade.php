@extends('layouts.app')

@section("page_title", "Dashboard")

@section('page_content')


 

    <div class="row pt-3">
        <div class="col-12 col-sm-4 col-md-3">
            <div class="card-box">
                <div class="student-profile-box text-center p-2">
                   
                    <div class="avatar mb-1">
                        <img src="{{ asset(($user->avatar) ? $user->avatar : "_dashboard/assets/images/users/avatar-1.jpg") }}" class="img-fluid img-rounded img-thumbnail">
                    </div>
                    
                    <div class="mt-1">
                        <i class="mdi mdi-account-outline"></i> <b>{{ $user->full_name }}</b>
                    </div>
                    
                    
                   
                
                    
                    
                </div>
            </div>
        </div>
        
       
     
       </div>

@endsection

@section("page_scripts")

   
@endsection