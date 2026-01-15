@extends('layouts.app')

@section("page_title", "Dashboard")

@section('page_content')
    
    
    <?php

use App\Http\Models\registration_fee;


$registration = registration_fee::first(); 
?>

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

    <div class="row pt-3">
        <div class="col-sm-3">

            <div class="card-box widget-chart-one gradient-info bx-shadow-lg">
                <div class="float-left">
                    <i class="mdi mdi-account-group text-white"></i>
                </div>
                <div class="widget-chart-one-content text-right">
                    <p class="text-white mb-0 mt-2">Students</p>
                    <h3 class="text-white">{{ $students->count() }}</h3>
                </div>
            </div>

        </div>
        <div class="col-sm-3">

            <div class="card-box widget-chart-one gradient-warning bx-shadow-lg">
                <div class="float-left">
                    <i class="mdi mdi-account-switch text-white"></i>
                </div>
                <div class="widget-chart-one-content text-right">
                    <p class="text-white mb-0 mt-2">Lecturers</p>
                    <h3 class="text-white">{{ $lecturers->count() }}</h3>
                </div>
            </div>

        </div>
        <div class="col-sm-3">

            <div class="card-box widget-chart-one gradient-success bx-shadow-lg">
                <div class="float-left">
                    <i class="mdi mdi-home text-white"></i>
                </div>
                
             <!---   
                <div class="widget-chart-one-content text-right">
                    <p class="text-white mb-0 mt-2">Hostels</p>
                    <h3 class="text-white">{{ $hostels->count() }}</h3>
                </div>
                
                --->
            </div>

        </div>
        <div class="col-sm-3">

            <div class="card-box widget-chart-one gradient-dark bx-shadow-lg">
                <div class="float-left">
                    <i class="mdi mdi-office-building text-white"></i>
                </div>
                
                <!---
                <div class="widget-chart-one-content text-right">
                    <p class="text-white mb-0 mt-2">Hostel Spaces</p>
                    <h3 class="text-white">{{ $hostel_capacity }}</h3>
                </div>
                
                --->
                
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 col-md-3">
            <div class="card-header">
                <i class="mdi mdi-settings"></i>
               Registration Fee
            </div>
            
            <?php 
            /*
            <div class="card-box">
                <form method="POST" action="{{ route("admin.settings.update") }}">
                    @csrf
                    {{ method_field("PUT") }}
                    <div class="form-group">
                        <label>Default program duration (years)</label>
                        <input class="form-control" type="number" name="program_duration" placeholder="3" value="{{ $settings->default_program_duration }}">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-sm">Save</button>
                    </div>
                </form>
            </div> */
						
						
             ?>
            
            <br/>
                  
                 <div class="card-box">
                <form method="POST" action="{{ route("admin.settings.registration") }}">
                    @csrf
                    {{ method_field("PUT") }}
                    <div class="form-group">
                        <label>Registration Fee</label>
                        <input class="form-control" type="number" name="fee"  value="{{ $registration->fee }}">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-sm">Save</button>
                    </div>
                </form>
            </div>
            
        </div>

        <div class="col-sm-8 col-md-9">
            <div class="card mb-3">
                <div class="card-header bg-dark text-white">
                    <div class="dropdown float-right">
                        <button href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#addSessionModal">
                            <i class="mdi mdi-plus"></i> Add session
                        </button>
                    </div>
                    <span class="mdi mdi-calendar-blank"></span> Sessions
                </div>
                <div class="bg-white table-responsive">
                    <table class="table table-hover" id="sessions-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Start</th>
                            <th>End</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=1; @endphp
                        @foreach($sessions as $session)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $session->start->year }}</td>
                                <td>{{ $session->end->year }}</td>
                                <td></td>
                            </tr>
                            @php $i++ @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-dark text-white">
                    <span class="mdi mdi-account-group"></span> Users
                </div>
                <div class="bg-white table-responsive">
                    <table class="table table-hover" id="users-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Account Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=1; @endphp
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $user->full_name }}</td>
                                <td>
                                    @switch($user->account_type)
                                        @case("super_admin")
                                        <span class="badge badge-danger">{{ $user->role }}</span>
                                        @break
                                        @case("supervisor")
                                        <span class="badge badge-warning">{{ $user->role }}</span>
                                        @break
                                        @case("senior_lecturer")
                                        <span class="badge badge-primary">{{ $user->role }}</span>
                                        @break
                                        @case("lecturer")
                                        <span class="badge badge-info">{{ $user->role }}</span>
                                        @break
                                        @case("student")
                                        <span class="badge badge-success">{{ $user->role }}</span>
                                        @break
                                        @default
                                        <span class="badge badge-info">{{ $user->role }}</span>
                                        @break
                                    @endswitch
                                </td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addSessionModal" tabindex="-1" role="dialog" aria-labelledby="addSessionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSessionModalLabel">Add new session</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route("admin.session.store") }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="form-group col">
                                <label>Start</label>
                                <input class="form-control" type="date" id="start_year" required name="start_year" placeholder="Start Year">
                            </div>
                            <div class="form-group col">
                                <label>End</label>
                                <input class="form-control" type="date" id="end_year" required name="end_year" placeholder="End Year">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("page_scripts")

    <script>
        $(document).ready(function() {
            $("#users-table").DataTable({
                searching: false,
                lengthChange: false,
                pageLength: 5
            });

            $("#sessions-table").DataTable({
                searching: false,
                lengthChange: false,
                pageLength: 5
            });
        });
    </script>
@endsection
