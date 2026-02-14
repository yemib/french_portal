@extends('layouts.app')

@section("page_title", "Students")

@section('page_content')

<div class="pt-1">
    <div class="row mt-1">
        <div class="col-12">
            <div class="card-box" style="overflow: auto">
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
                            <th>  Email </th>
                            <th>School</th>
                            <th class="d-none">Department</th>
                           
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
                            <td>
                                {{ $student->registration_number }}
                                
                            </td>
                            <td>
                                {{ ucwords($student->user->full_name) }}

                                <hr/>
                                Payment Status  : 

                                <?php
                                $payment_count =     $student->remita_payments->where("reason", "tuition")->where("paid", true)->count();



                                ?>

                                @if($payment_count > 0)

                               <span style="color: green;">Paid</span> 

                                @else
                               <span style="color: red;"> Unpaid  </span>

                                @endif




                            
                            </td>
                            <td> @if($student->user->email) {{ $student->user->email  }} @endif</td>
                            <td>
                                {{ ($student->user->school) ? $student->user->school->school_title : "No school" }}
                            </td>
                            <td class="d-none">{{ ucfirst($student->department->title) }}</td>
                            
                            <td>
                                <form method="post" action="{{ route("admin.student.destroy", ["id" => $student->id]) }}" id="delete-student-{{ $student->id }}">
                                    @csrf
                                    {{ method_field("DELETE") }}
                                    <div class="btn-group">
                                        <a href="{{ route("admin.student.show", ["id" => $student->id]) }}" class="btn btn-outline-info btn-sm"><i class="mdi mdi-eye"></i> View</a>

                                        <button type="button" data-toggle="modal" data-target="#editStudent{{ $student->id }}Modal" class="btn btn-info btn-sm"><i class="mdi mdi-square-edit-outline"></i> Edit</button>

                                        <button type="button" data-toggle="modal" data-target="#changeStudent{{ $student->id }}PasswordModal" class="btn btn-warning btn-sm"><i class="mdi mdi-account-switch"></i> Change Password</button>

                                        @if($student->active)
                                        <button data-url="{{ route("admin.student.deactivate", ["id" => $student->id]) }}" class="btn btn-outline-warning btn-sm toggle-status"><i class="mdi mdi-eye"></i> Deactivate</button>
                                        @else
                                        <button data-url="{{ route("admin.student.activate", ["id" => $student->id]) }}" class="btn btn-outline-success btn-sm toggle-status"><i class="mdi mdi-eye"></i> Activate</button>
                                        @endif

                                        <!-- approve the payment  of student  -->
                                        <?php

                                        $payment_count =     $student->remita_payments
                                            ->where("reason", "tuition")->where("paid", true)->count();

                                        ?>

                                        @if( $payment_count > 0 )

                                        <button type="button" data-url="{{ route("admin.student.deny", ["id" => $student->id]) }}" data-reg="{{ $student->user->full_name }}"
                                            class="btn btn-outline-success btn-sm deny"><i class="mdi mdi-eye"></i>
                                            Disapprove Student Payment</button>


                                        @else

                                        <button type="button" data-url="{{ route("admin.student.approve", ["id" => $student->id]) }}"
                                            class="btn btn-outline-success btn-sm approve"><i class="mdi mdi-eye"></i>
                                            Approve Payment</button>

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

                <?php echo  $students->links() ?>


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
                                <th>Email</th>
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

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    /* ================================
         GLOBAL AJAX SETUP
        ================================ */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /* ================================
       BUTTON LOADING HELPERS
    ================================ */
    function setBtnLoading(btn, text = "Please wait") {
        btn.data("original-html", btn.html());
        btn.prop("disabled", true);
        btn.html(`<span class="spinner-border spinner-border-sm mr-1"></span> ${text}`);
    }

    function resetBtn(btn) {
        btn.prop("disabled", false);
        btn.html(btn.data("original-html"));
    }

    /* ================================
       DATATABLE INIT
    ================================ */
    let studentsTable;

    $(document).ready(function() {
        studentsTable = $('#students-table').DataTable({
            searching: true,
            lengthChange: true,
            order: [
                [0, "asc"]
            ],
        });
    });

    /* ================================
       REFRESH TABLE ONLY
    ================================ */
    function refreshStudentsTable() {
        $.get(window.location.href, function(response) {

            let tbody = $(response).find("#students-table tbody").html();

            studentsTable.clear().destroy();
            $("#students-table tbody").html(tbody);

            studentsTable = $('#students-table').DataTable({
                searching: true,
                lengthChange: true,
                order: [
                    [0, "asc"]
                ],
            });
        });
    }

    /* ================================
       DELETE STUDENT
    ================================ */
    $(document).on("click", ".delete-student", function() {

        let btn = $(this);
        let studentId = btn.data("student");
        let reg = btn.data("reg");
        let row = btn.closest("tr");
        let url = $("#delete-student-" + studentId).attr("action");

        swal({
            html: `Delete <b>${reg}</b>?`,
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete"
        }).then((r) => {
            if (r.value) {

                setBtnLoading(btn, "Deleting");

                $.post(url, {
                        _method: "DELETE"
                    })
                    .done(() => {
                        studentsTable.row(row).remove().draw(false);
                        swal("Deleted", "Student removed", "success");
                    })
                    .fail(() => {
                        swal("Error", "Delete failed", "error");
                    })
                    .always(() => resetBtn(btn));
            }
        });
    });

    /* ================================
       ADD STUDENT
    ================================ */
    $("#addNewStudentModal form").on("submit", function(e) {
        e.preventDefault();

        let form = $(this);
        let btn = form.find("button[type=submit]");

        setBtnLoading(btn, "Saving");

        $.post(form.attr("action"), form.serialize())
            .done((data) => {
                if(data.success  == true) { 
                $("#addNewStudentModal").modal("hide");
                form[0].reset();
                swal("Success", "Student added", "success");
                refreshStudentsTable();

                }else{

                     swal("error", data.message, "error");


                }
            })
            .fail(xhr => {
                swal("Error", xhr.responseJSON?.message || "Failed", "error");
            })
            .always(() => resetBtn(btn));
    });

    /* ================================
       EDIT STUDENT
    ================================ */
    $(".edit-student-modal form").on("submit", function(e) {
        e.preventDefault();

        let form = $(this);
        let btn = form.find("button[type=submit]");

        setBtnLoading(btn, "Updating");

        $.post(form.attr("action"), form.serialize())
            .done(() => {
                form.closest(".modal").modal("hide");
                swal("Updated", "Student updated", "success");
                refreshStudentsTable();
            })
            .fail(() => {
                swal("Error", "Update failed", "error");
            })
            .always(() => resetBtn(btn));
    });

    /* ================================
       CHANGE PASSWORD
    ================================ */
    $("form[action*='update-password']").on("submit", function(e) {
        e.preventDefault();

        let form = $(this);
        let btn = form.find("button[type=submit]");

        setBtnLoading(btn, "Saving");

        $.post(form.attr("action"), form.serialize())
            .done(() => {
                form.closest(".modal").modal("hide");
                form[0].reset();
                swal("Success", "Password updated", "success");
            })
            .fail(() => {
                swal("Error", "Password update failed", "error");
            })
            .always(() => resetBtn(btn));
    });

    /* ================================
       BULK UPLOAD
    ================================ */
    $("#uploadStudentsBulkModal form").on("submit", function(e) {
        e.preventDefault();

        let form = $(this);
        let btn = form.find("button[type=submit]");
        let fd = new FormData(this);

        setBtnLoading(btn, "Uploading");

        $.ajax({
            url: form.attr("action"),
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            success: function() {
                $("#uploadStudentsBulkModal").modal("hide");
                swal("Success", "Upload completed", "success");
                refreshStudentsTable();
            },
            error: function() {
                swal("Error", "Upload failed", "error");
            },
            complete: function() {
                resetBtn(btn);
            }
        });
    });

    /* ================================
       ACTIVATE / DEACTIVATE
    ================================ */
    $(document).on("click", ".toggle-status", function(e) {
        e.preventDefault();

        let btn = $(this);

        setBtnLoading(btn, "Updating");

        $.get(btn.data("url"))
            .done(() => {
                swal("Success", "Status updated", "success");
                refreshStudentsTable();
            })
            .fail(() => {
                swal("Error", "Action failed", "error");
            })
            .always(() => resetBtn(btn));
    });

    $(document).on("click", ".approve", function() {

        let btn = $(this);

        let reg = btn.data("reg");


        swal({
            html: `Are  you sure You want to Approve <b>${reg}</b> Payment?`,
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Approve"
        }).then((r) => {
            if (r.value) {

                setBtnLoading(btn, "Approving...");



                $.get(btn.data("url"))
                    .done(() => {
                        swal("Success", "Status updated", "success");
                        refreshStudentsTable();
                    })
                    .fail(() => {
                        swal("Error", "Action failed", "error");
                    })
                    .always(() => resetBtn(btn));






            }
        });
    });



    $(document).on("click", ".deny", function() {

        let btn = $(this);

        let reg = btn.data("reg");


        swal({
            html: `Are  you sure You want to Deny <b>${reg}</b>  Payment?`,
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Deny"
        }).then((r) => {
            if (r.value) {

                setBtnLoading(btn, "Denying...");



                $.get(btn.data("url"))
                    .done(() => {
                        swal("Success", "Status updated", "success");
                        refreshStudentsTable();
                    })
                    .fail(() => {
                        swal("Error", "Action failed", "error");
                    })
                    .always(() => resetBtn(btn));






            }
        });
    });







    /* ================================
       PROGRAM → DEPARTMENT
    ================================ */
    function loadDepartments(select, target) {
        target.html('<option value="">Select a department</option>');

        let depts = select.find("option:selected").data("departments") || [];
        $.each(depts, (_, d) => {
            target.append(`<option value="${d.id}">${d.title}</option>`);
        });
    }

    $("#addNewStudentModal select[name=program]").on("change", function() {
        loadDepartments($(this), $("#addNewStudentModal select[name=department]"));
    });

    $(".edit-student-program").on("change", function() {
        let id = $(this).data("studentid");
        loadDepartments($(this), $("#editStudent" + id + "Modal select[name=department]"));
    });

    $("#uploadStudentsBulkModal select[name=program]").on("change", function() {
        loadDepartments($(this), $("#uploadStudentsBulkModal select[name=department]"));
    });
</script>
@endsection