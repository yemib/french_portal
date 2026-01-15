@extends('layouts.app')

@section("page_title", "Students")

@section('page_content')

    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box"   style="overflow: auto">
                    <div class="dropdown float-right"><a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" data-toggle="modal" data-target="#addNewStudentModal" class="dropdown-item">Add a new student</a>
                            <a href="#" data-toggle="modal" data-target="#uploadStudentsBulkModal" class="dropdown-item">Upload students in bulk</a>
                            <a href="{{ route("students.download-all-students-sheet", ["format" => "excel"]) }}" class="dropdown-item">Download list of all students</a>
                        </div>
                    </div>

                    <h4 class="m-t-0 header-title">Students</h4>
                    <table class="table mb-0" id="students-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Registration Number</th>
                            <th>Full Name</th>
                            <th>School</th>
                            <th class="d-none">Department</th>
                            <th class="">
                                Reports
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1 @endphp
                        @foreach($students as $student)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $student->registration_number }}</td>
                                <td>{{ ucwords($student->user->full_name) }}</td>
                                <td>
                                    {{ ($student->user->school) ? $student->user->school->school_title : "No school" }}
                                </td>
                                <td class="d-none">{{ ucfirst($student->department->title) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route("student.download-biodata", ["id" => $student->id]) }}" class="btn btn-outline-info btn-sm"><i class="mdi mdi-download"></i> Biodata</a>
                                    </div>
                                </td>
                                <td>
                                    <form method="post" action="{{ route("admin.student.destroy", ["id" => $student->id]) }}" id="delete-student-{{ $student->id }}">
                                        @csrf
                                        {{ method_field("DELETE") }}
                                        <div class="btn-group">
                                            <a href="{{ route("admin.student.show", ["id" => $student->id]) }}" class="btn btn-outline-info btn-sm"><i class="mdi mdi-eye"></i> View</a>

                                            <button type="button" data-toggle="modal" data-target="#editStudent{{ $student->id }}Modal" class="btn btn-info btn-sm"><i class="mdi mdi-square-edit-outline"></i> Edit</button>

                                            <button type="button" data-toggle="modal" data-target="#changeStudent{{ $student->id }}PasswordModal" class="btn btn-warning btn-sm"><i class="mdi mdi-account-switch"></i> Change Password</button>

                                            @if($student->active)
                                                <a href="{{ route("admin.student.deactivate", ["id" => $student->id]) }}" class="btn btn-outline-warning btn-sm"><i class="mdi mdi-eye"></i> Deactivate</a>
                                            @else
                                                <a href="{{ route("admin.student.activate", ["id" => $student->id]) }}" class="btn btn-outline-success btn-sm"><i class="mdi mdi-eye"></i> Activate</a>
                                            @endif

                                            <button class="btn btn-danger btn-sm delete-student" type="button" data-student="{{ $student->id }}" data-reg="{{ $student->registration_number }}">
                                                <i class="mdi mdi-delete"></i> Delete
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>

                            @php $i++ @endphp
                        @endforeach
                        </tbody>
                    </table>
                    
                    <?php   echo  $students->links() ?>
                    
                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNewStudentModal" tabindex="-1" role="dialog" aria-labelledby="addNewStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewStudentModalLabel">Add new student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route("admin.student.store") }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12 col-sm-6">
                                <input class="form-control" type="text" id="surname" required name="surname" placeholder="Surname">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <input class="form-control" type="text" id="other_names" required name="other_names" placeholder="Other Names">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-sm-6">
                                <input class="form-control" type="email" id="email" name="email" placeholder="Email Address (optional)">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <select class="form-control" id="gender" required name="gender">
                                    <option value="">Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <select class="form-control" required name="school">
                                    <option value="">Select School</option>
                                    @foreach($schools as $school)
                                        <option value="{{ $school->id }}">{{ ucfirst($school->school_title) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-sm-6">
                                <select class="form-control" id="program" required name="program">
                                    <option value="">Select a program</option>
                                    @foreach($programs as $program)
                                        <option value="{{ $program->id }}" data-departments="{{ $program->departments }}">{{ ucfirst($program->title) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <select class="form-control" id="department" required name="department">
                                    <option value="">Select a department</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-sm-6">
                                <input class="form-control" type="text" id="registration_number" required name="registration_number" placeholder="Registration Number">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <input class="form-control" type="number" id="current_session" required name="current_session" placeholder="Current Session" value="1" min="1">
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

    <div class="modal fade" id="uploadStudentsBulkModal" tabindex="-1" role="dialog" aria-labelledby="uploadStudentsBulkModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadStudentsBulkModalLabel">Upload excel sheet for students</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route("students.bulk-upload") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="table-responsive bulk-upload-guidelines">
                            <div class="bulk-upload-guidelines-header">
                                Excel sheet must have the following columns
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Registration Number</th>
                                    <th>Surname</th>
                                    <th>Other Names</th>
                                </tr>
                            </table>
                        </div>

                        <div class="row">
                            <div class="form-group col-12">
                                <select class="form-control" required name="school">
                                    <option value="">Select School</option>
                                    @foreach($schools as $school)
                                        <option value="{{ $school->id }}">{{ ucfirst($school->school_title) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-sm-6">
                                <select class="form-control" id="program" required name="program">
                                    <option value="">Select a program</option>
                                    @foreach($programs as $program)
                                        <option value="{{ $program->id }}" data-departments="{{ $program->departments }}">{{ ucfirst($program->title) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <select class="form-control" id="department" required name="department">
                                    <option value="">Select a department</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12 col-sm-6">
                                <input type="number" min="1" required name="current_session" class="form-control" placeholder="Current Session">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <input class="form-control" type="file" id="bulk_students" required name="bulk_students">
                            </div>
                        </div>

                        <hr>
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($students as $student)

        <div class="modal fade edit-student-modal" id="editStudent{{ $student->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="editStudent{{ $student->id }}ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStudent{{ $student->id }}ModalLabel">Update student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ route("admin.student.update", ["id" => $student->id]) }}">
                        @csrf
                        {{ method_field("PUT") }}

                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-12 col-sm-6">
                                    <input class="form-control" type="text" id="surname" required name="surname" placeholder="Surname" value="{{ $student->user->surname }}">
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <input class="form-control" type="text" id="other_names" required name="other_names" placeholder="Other Names" value="{{ $student->user->other_names }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-sm-6">
                                    <input class="form-control" type="email" id="email" name="email" placeholder="Email Address (optional)" value="{{ $student->user->email }}">
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <select class="form-control" id="gender" required name="gender">
                                        <option value="">Gender</option>
                                        <option value="male" @if($student->user->gender == "male") selected @endif>Male</option>
                                        <option value="female" @if($student->user->gender == "female") selected @endif>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <select class="form-control" required name="school">
                                        <option value="">Select School</option>
                                        @foreach($schools as $school)
                                            <option value="{{ $school->id }}" @if($student->user->school_id == $school->id) selected @endif>{{ ucfirst($school->school_title) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-sm-6">
                                    <select class="form-control edit-student-program" data-studentid="{{ $student->id }}" id="program" required name="program">
                                        <option value="">Select a program</option>
                                        @foreach($programs as $program)
                                            <option value="{{ $program->id }}" data-departments="{{ $program->departments }}" @if($student->program_id == $program->id) selected @endif>{{ ucfirst($program->title) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <select class="form-control" id="department" required name="department">
                                        <option value="{{ $student->department_id }}">{{ $student->department->title }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-sm-6">
                                    <input class="form-control" type="text" id="registration_number" required name="registration_number" placeholder="Registration Number" value="{{ $student->registration_number }}">
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                    <input class="form-control" type="number" id="current_session" required name="current_session" placeholder="Current Session" value="{{ $student->current_session }}">
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

        <div class="modal fade edit-student-modal" id="changeStudent{{ $student->id }}PasswordModal" tabindex="-1" role="dialog" aria-labelledby="changeStudent{{ $student->id }}PasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changeStudent{{ $student->id }}PasswordModalLabel">Update student password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ route("admin.student.update-password") }}">
                        @csrf
                        {{ method_field("PUT") }}
                        <input type="hidden" name="student_id" value="{{ $student->id }}">

                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <input class="form-control" type="password" required name="password" placeholder="Password">
                                </div>
                                <div class="form-group col-12">
                                    <input class="form-control" type="password" required name="password_confirmation" placeholder="Password Confirmation">
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
    @endforeach
@endsection

@section("page_scripts")
    <script>
        //$("#uploadStudentsBulkModal").modal("show");

        $(document).ready(function() {
            // Default Datatable
            $('#students-table').DataTable({
                searching: true,
                lengthChange: true ,
				 "order": [[ 0, "asc" ]]
				
            });
        });

        $(".delete-student").click(function(e){
            let student_id = $(this).data("student");
            let student_reg = $(this).data("reg");
            swal({
                html:"Are you sure you want to delete student <b>"+student_reg+"</b>?<br>You won't be able to revert this!",
                type:"warning",
                showCancelButton: true,
                confirmButtonText:"Yes, delete this student!"
            }).then((willDelete) => {
                if (willDelete.value) {
                    $("#delete-student-" + student_id).submit();
                } else {
                    e.preventDefault();
                }
            });
        });

        const add_new_student_modal = $("#addNewStudentModal");
        const add_student_program = add_new_student_modal.find("select[name=program]");
        const add_student_department = add_new_student_modal.find("select[name=department]");

        add_student_program.on("change", function () {
            add_student_department.html('<option value="">Select a department</option>').val('');
            if(add_student_program.val() !== "") {
                let student_departments = add_student_program.find("option:selected").data("departments");
                $.each(student_departments, function (key, val) {
                    add_student_department.append('<option value="'+val.id+'">'+val.title+'</option>');
                });
            }
        });

        const edit_new_student_modal = $(".edit-student-modal");
        const edit_student_program = edit_new_student_modal.find("select[name=program]");

        edit_student_program.on("change", function () {
            let student_id = $(this).data("studentid");
            let edit_student_department = $(".edit-student-modal#editStudent"+student_id+"Modal").find("select[name=department]");

            edit_student_department.html('<option value="">Select a department</option>').val('');

            if(edit_student_program.val() !== "") {
                let student_departments = edit_student_program.find("option:selected").data("departments");
                $.each(student_departments, function (key, val) {
                    edit_student_department.append('<option value="'+val.id+'">'+val.title+'</option>');
                });
            }
        });

        const bulk_upload_student_modal = $("#uploadStudentsBulkModal");
        const bulk_upload_program = bulk_upload_student_modal.find("select[name=program]");
        const bulk_upload_department = bulk_upload_student_modal.find("select[name=department]");

        bulk_upload_program.on("change", function () {
            bulk_upload_department.html('<option value="">Select a department</option>').val('');

            if(bulk_upload_program.val() !== "") {
                let student_departments = bulk_upload_program.find("option:selected").data("departments");
                $.each(student_departments, function (key, val) {
                    bulk_upload_department.append('<option value="'+val.id+'">'+val.title+'</option>');
                });
            }
        });

    </script>
@endsection
