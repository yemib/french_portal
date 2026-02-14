@extends('layouts.app')

@section("page_title", "Lecturers")

@section('page_content')

<div class="pt-1">
    <div class="row mt-1">
        <div class="col-12">
            <div class="card-box">
                <div class="dropdown float-right"><a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" data-toggle="modal" data-target="#addNewLecturerModal" class="dropdown-item">Add a new Result Uploader</a>
                    </div>
                </div>

                <h4 class="m-t-0 header-title">Result Uploaders</h4>
                <table class="table mb-0" id="lecturers-table">
                    <thead>
                        <tr>
                            <th>#</th>
                           <!--  <th>Staff ID</th> -->
                            <th>Full Name</th>
                            <th>Email</th>
                            <!---   <th>Department</th>   --->
                            <!---  <th>Status</th>  --->
                            <th>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach($lecturers as $lecturer)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <!-- <td>{{ $lecturer->staff_id }}</td> -->
                            <td>{{ isset($lecturer->user->full_name) ? ucwords($lecturer->user->full_name) : '' }}</td>
                            <td> @if(isset( $lecturer->user->email)) {{ $lecturer->user->email }} @endif</td>

                            <?php

                            /*        <!--- <td>{{ ucfirst($lecturer->department->title) }}</td>  --->
                            <!---   <td>
                                    @if($lecturer->user->account_type == "lecturer")
                                        Lecturer
                                    @else
                                        Senior Lecturer
                                    @endif
                                </td>  --->
                                    */

                            ?>
                            <td>
                                <form method="post" action="{{ route("admin.lecturer.destroy", ["id" => $lecturer->id]) }}">
                                    @csrf
                                    {{ method_field("DELETE") }}
                                    <button type="button" data-toggle="modal" data-target="#editLecturer{{ $lecturer->id }}Modal" class="btn btn-info btn-sm"><i class="mdi mdi-square-edit-outline"></i> Edit</button>
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="mdi mdi-delete"></i> Delete
                                    </button>
                                   

                                </form>
                            </td>
                        </tr>



                        <?php 
                             /* 
                             
                                             <div style="display: none !important">
                                       
                                        @if(isset($lecturer->user->id))
                                        @if($lecturer->user->account_type == "lecturer")
                                            <a href="{{ route("admin.lecturer.change-status", ["id" => $lecturer->id, "status" => "senior"]) }}" class="btn btn-success btn-sm"><i class="mdi mdi-check-circle"></i> Make Senior Lecturer</button>
                                                @else
                                            <a href="{{ route("admin.lecturer.change-status", ["id" => $lecturer->id, "status" => "normal"]) }}" class="btn btn-outline-success btn-sm">
                                                <i class="mdi mdi-cancel"></i> Make Lecturer</button>
                                        @endif
                                        @endif

                                    </div>

                             */
                        
                        
                        ?>

                        <div class="modal fade" id="editLecturer{{ $lecturer->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="editLecturer{{ $lecturer->id }}ModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editLecturer{{ $lecturer->id }}ModalLabel">Update lecturer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="{{ route("admin.lecturer.update", ["id" => $lecturer->id]) }}">
                                        @csrf
                                        {{ method_field("PUT") }}

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="form-group col-12 col-sm-6">
                                                    <label>Surname</label>
                                                    <input class="form-control" type="text" 
                                                    id="surname" required name="surname"
                                                     placeholder="Surname" value="{{ isset($lecturer->user->surname) ? $lecturer->user->surname : '' }}">
                                                </div>

                                                <div class="form-group col-12 col-sm-6">
                                                    <lable>Other Names</lable>
                                                    <input class="form-control" type="text" id="other_names" required name="other_names" placeholder="Other Names" value="{{ isset($lecturer->user->other_names) ? $lecturer->user->other_names : '' }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12 col-sm-6">
                                                    <lable>Email Address</lable>
                                                    <input class="form-control" type="email" id="email" name="email" placeholder="Email Address (optional)" value="{{ isset($lecturer->user->email) ? $lecturer->user->email : '' }}">
                                                </div>
                                                <div class="form-group col-12 col-sm-6">
                                                    <label>Gender</label>
                                                    <select class="form-control" id="gender" required name="gender">
                                                        <option value="">Gender</option>
                                                        <option value="male" @if(isset($lecturer->user->gender) && $lecturer->user->gender == "male") selected @endif>Male</option>
                                                        <option value="female" @if(isset($lecturer->user->gender) && $lecturer->user->gender == "female") selected @endif>Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row"  style="display: none  !important;">
                                                <div class="form-group col-12 col-sm-6">
                                                    <input class="form-control" type="text" id="staff_id" name="staff_id" placeholder="Staff ID" value="{{ $lecturer->staff_id }}">
                                                </div>
                                                <div style="display: none" class="form-group col-12 col-sm-6">
                                                    <select class="form-control" id="department" required name="department">
                                                        <option value="">Select a department</option>
                                                        @foreach($departments as $department)
                                                        <option value="{{ $department->id }}" @if($lecturer->department_id == $department->id) selected @endif>{{ ucfirst($department->title) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @php $i++ @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addNewLecturerModal" tabindex="-1" role="dialog" aria-labelledby="addNewLecturerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewLecturerModalLabel">Add new lecturer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route("admin.lecturer.store") }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12 col-sm-6">
                            <label>Surname</label>
                            <input class="form-control" type="text" id="surname" required name="surname" placeholder="Surname">
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <label>Other Names</label>
                            <input class="form-control" type="text" id="other_names" required name="other_names" placeholder="Other Names">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-sm-6">
                            <label>Email</label>
                            <input class="form-control" type="email" id="email" name="email" placeholder="Email Address (optional)">
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <label>Gender</label>
                            <select class="form-control" id="gender" required name="gender">
                                <option value="">Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div  style="display: none;" class="row">
                        <div class="form-group col-12 col-sm-6">
                            <input class="form-control" type="text" id="staff_id" name="staff_id" placeholder="Staff ID">
                        </div>
                        <div style="display: none" class="form-group col-12 col-sm-6">
                            <select class="form-control" id="department" name="department">
                                <option value="">Select a department</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ ucfirst($department->title) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
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
        // Default Datatable
        $('#lecturers-table').DataTable({
            searching: false,
            lengthChange: false
        });
    });
</script>
@endsection