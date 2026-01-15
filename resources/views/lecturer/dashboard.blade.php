@extends('layouts.app')

@section("page_title", "Dashboard")

@section('page_content')

    <div class="page-title-box d-none">
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Greeva</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Pages</a>
            </li>
            <li class="breadcrumb-item active">Starter</li>
        </ol>
        <h4 class="page-title">Starter</h4>
    </div>

    <div class="row pt-3 d-none">
        <div class="col-sm-3">

            <div class="card-box widget-chart-one gradient-info bx-shadow-lg">
                <div class="float-left">
                    <i class="mdi mdi-account-group text-white"></i>
                </div>
                <div class="widget-chart-one-content text-right">
                    <p class="text-white mb-0 mt-2">Students</p>
                    <h3 class="text-white">1</h3>
                </div>
            </div>

        </div>
    </div>

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
                        <i class="mdi mdi-tab"></i> {{ $user->lecturer->staff_id }}
                    </div>
                    <!---
                    <div class="mt-1">
                        <i class="mdi mdi-book-open-variant"></i> {{ $user->lecturer->department->title }}
                    </div>   --->
                    
                    
                </div>
            </div>
        </div>
        
        <!---

        <div class="col-12 col-sm-8 col-md-9 table-responsive">
            <div class="card-header bg-dark text-white">
                Department Courses
            </div>
            <table class="table table-bordered card-box">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Code</th>
                    <th>Students</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->lecturer->department_courses as $department_course)
                    <tr>
                        <td>
                            {{ ucfirst($department_course->title) }}
                            <small class="text-muted">
                                -
                                Level {{ $department_course->level }}
                            </small>
                        </td>
                        <td>{{ $department_course->code }}</td>
                        <td>
                            {{ $department_course->students->count() }}
                        </td>
                        <td>
                            <a href="{{ route("course.show", ["id" => $department_course->id]) }}" class="btn btn-outline-success btn-sm"><i class="mdi mdi-eye"></i> View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
   
   
   ---->
    
     
       </div>

@endsection

@section("page_scripts")

    <script>
        /*$(document).ready(function() {
            $("#users-table").DataTable({
                searching: false,
                lengthChange: false,
                pageLength: 5
            });
        });*/
    </script>
@endsection