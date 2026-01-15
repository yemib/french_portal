@extends('layouts.app')

@section("page_title", "Dashboard")

@section('page_content')





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
                        <img src="{{ asset(($user->avatar) ? "storage/images/avatar/".$user->id."/".$user->avatar : "_dashboard/assets/images/users/avatar-1.jpg") }}" class="img-fluid img-rounded img-thumbnail img-responsive">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-8 col-md-9 table-responsive">
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
                        {{ $user->full_name }}
                    </td>
                </tr>
					
					
                <tr>
                    <th>Registration Number</th>
                    <td>
                        {{ $user->student->registration_number }}
                    </td>
                </tr>
					
					
                <tr>
                    <th>Program</th>
                    <td>
                        {{ $user->student->program->title }}
                    </td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td>
                        {{ $user->student->department->title }}
                    </td>
                </tr>
                <tr>
                    <th>Level</th>
                    <td>
                        {{ $user->student->current_session }}
                    </td>
                </tr>
				
				<?php	
					/*
                <tr>
                    <th>Hostel</th>
                    <td>
                        @if($user->student->current_accommodation)
                            {{ ucfirst($user->student->current_accommodation->hostel->title) }}
                        @else
                            <i>None</i>
                        @endif
                    </td>
                </tr>
					

                <tr>
                    <th>Room Number</th>
                    <td>
                        @if($user->student->current_accommodation)
                            {{ $user->student->current_accommodation->room_number }}
                        @else
                            <i>None</i>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Bed Space Number</th>
                    <td>
                        @if($user->student->current_accommodation)
                            {{ $user->student->current_accommodation->space_id }}
                        @else
                            <i>None</i>
                        @endif
                    </td>
                </tr>
							
						*/	
							?>
							
                </tbody>
            </table>
<!----
            <div class="text-right">
                <a href="{{ route("student.download-hostel-allocation-form") }}" class="btn btn-outline-success">
                    <i class="mdi mdi-download"></i> Download Hostel Clearance
                </a>
            </div>
            
            
            ----->
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