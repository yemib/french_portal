@extends('layouts.app')

@section("page_title", "Dashboard")

@section('page_content')

   
   <?php


//use the application form straight period 

use App\Http\Models\ApplicationForm;


?>
   
    <div class="page-title-box">
        <h4 class="page-title">Student: #{{ $student->registration_number }}</h4>
    </div>

    <div class="row pt-3">
        <div class="col-12 col-sm-4 col-md-3">
            <div class="card-box">
                <div class="student-profile-box text-center p-2">
                    <div class="avatar mb-1">
                        <img src="{{ asset(($student->user->avatar) ? "storage/images/avatar/".$student->user->id."/".$student->user->avatar : "_dashboard/assets/images/users/avatar-1.jpg") }}" class="img-fluid img-rounded img-thumbnail">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-8 col-md-9 table-responsive">
            <div class="card-header bg-dark text-white">
                Student Biodata
            </div>
            <table id="datatable-buttons" class="card-box table table-bordered table-striped">
                <thead style="display: none">
                <tr style="display: none">
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>Full Name</th>
                    <td>
                        {{ $student->user->full_name }}
                    </td>
                </tr>
                <tr>
                    <th>Registration Number</th>
                    <td>
                        {{ $student->registration_number }}
                    </td>
                </tr>
                <tr>
                    <th>Program</th>
                    <td>
                        {{ $student->program->title }}
                    </td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td>
                        {{ $student->department->title }}
                    </td>
                </tr>
                <tr>
                    <th>Level</th>
                    <td>
                        {{ $student->current_session }}
                    </td>
                </tr>
                
                <?php
					$application = ApplicationForm::where('user_id'  , $student->user_id )->first();
					
					?>
                
                <tr>
                    <th>State of Origin</th>
                    <td>
                        {{ ($student->biodata) ? $student->biodata->state : "" }}
                    </td>
                </tr>
                <tr>
                    <th>School of Origin</th>
                    <td>
                        {{ ($student->biodata) ? $student->biodata->school_of_origin : "" }}
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        {{ ($student->email) ? $student->email : "" }}
                    </td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>
                        {{ ($student->biodata) ? $student->biodata->phone : "" }}
                    </td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td>
                        {{ ($student->biodata) ? $student->biodata->dob : "" }}
                    </td>
                </tr>
                <tr>
                    <th>Next of kin</th>
                    <td>
                        {{ ($student->biodata) ? $student->biodata->next_of_kin_name : "" }}
                    </td>
                </tr>
                <tr>
                    <th>Next of kin phone</th>
                    <td>
                        {{ ($student->biodata) ? $student->biodata->next_of_kin_phone : "" }}
                    </td>
                </tr>
                <tr>
                    <th>Next of kin address</th>
                    <td>
                        {{ ($student->biodata) ? $student->biodata->next_of_kin_address : "" }}
                    </td>
                </tr>
                
                
                <?php 
                
                /*
                
                <tr>
                    <th>Hostel</th>
                    <td>
                        if($student->current_accommodation)
                            {{ ucfirst($student->current_accommodation->hostel->title) }}
                        else
                            <i>None</i>
                        endif
                    </td>
                </tr>
                <tr>
                    <th>Room Number</th>
                    <td>
                        if($student->current_accommodation)
                            {{ $student->current_accommodation->room_number }}
                        else
                            <i>None</i>
                        endif
                    </td>
                </tr>
                <tr>
                    <th>Bed Space Number</th>
                    <td>
                        if($student->current_accommodation)
                            {{ $student->current_accommodation->space_id }}
                        else
                            <i>None</i>
                        endif
                    </td>
                </tr>
                
                */
                ?>
                </tbody>
            </table>

            @for($session_count = 1; $session_count <= $student->current_session; $session_count++)
                <div>
                    <div class="card-header bg-dark text-white">
                        Level: <b>{{ $session_count }}</b> Courses
                    </div>
                    <div class="table-responsdive card-box">
                       
                      
                        <div class="text-right">
                            <div class="btn-group">
                                <a href="{{ route("student.download-result", ["format" => "excel", "student_id" => $student->id, "session" => $session_count]) }}" class="btn btn-outline-info d-none">
                                    <i class="mdi mdi-download"></i> Download as Excel
                                </a>
                                <a href="{{ route("student.download-result", ["format" => "pdf", "student_id" => $student->id, "session" => $session_count]) }}" class="btn btn-outline-success">
                                    <i class="mdi mdi-download"></i> Download as PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

@endsection

@section("page_scripts")
    <!-- Buttons examples -->
    <script src="{{ asset("_dashboard/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("_dashboard/assets/libs/datatables.net-buttons/js/buttons.html5.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("_dashboard/assets/libs/datatables.net-buttons/js/buttons.flash.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("_dashboard/assets/libs/datatables.net-buttons/js/buttons.print.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("_dashboard/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("_dashboard/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js") }}" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            //Buttons examples
            /*var old_table = $('#datatable-buttons').DataTable({
                lengthChange: false,
                searching: false,
                ordering: false,
                buttons: ['print'],
                bInfo: false,
                bPaginate: false
            });*/

            /*old_table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');*/
        });
    </script>
@endsection