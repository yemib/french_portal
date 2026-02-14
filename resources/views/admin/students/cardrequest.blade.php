@extends('layouts.app')

@section("page_title", "Students")

@section('page_content')

<div class="pt-1">
    <div class="row mt-1">
        <div class="col-12">
            <div class="card-box" style="overflow: auto">
                <div class="dropdown float-right"><a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">

                        <a href="{{ route("students.download-all-students-sheet", ["format" => "excel"]) }}" class="dropdown-item">Download list of all students</a>

                    </div>
                </div>

                <h4 class="m-t-0 header-title">Students</h4>
                <table class="table mb-0" id="students-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Passport</th>
                            <th>Signature</th>
                            <th>Registration Number</th>
                            <th>Full Name</th>
                            <th>Institution</th>
                            <th>Sex</th>
                            <th>Blood Group</th>
                            <th>date of birth</th>
                            <th>place of birth</th>


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

                            <td> <a href="{{ $student->user->avatar}}">
                                    <img height="100" width="100"
                                        src="{{ $student->user->avatar}}" /> </a> </td>


                            <td> <a href="{{ $student->biodata->signature}}">
                                    <img height="100" width="100"
                                        src="{{ $student->biodata->signature}}" /> </a>
                            </td>



                            <td>{{ $student->registration_number }}</td>
                            <td>{{ ucwords($student->user->full_name) }}</td>


                            <td>{{ $student->biodata->institution }}</td>
                            <td>{{ $student->biodata->sex  }}</td>
                            <td>{{ $student->biodata->blood_group   }}</td>
                            <td>{{ $student->biodata->dob   }}</td>
                            <td>{{ $student->biodata->place_of_birth }}</td>





                            <td>
                                {{ ($student->user->school) ? $student->user->school->school_title : "No school" }}
                            </td>

                            <td class="d-none">{{ ucfirst($student->department->title) }}</td>

                            <td>
                                <form method="post" action="{{ route("admin.student.destroy", ["id" => $student->id]) }}" id="delete-student-{{ $student->id }}">
                                    @csrf

                                    <div class="btn-group">
                                        <a href="{{ route("admin.student.show", ["id" => $student->id]) }}" class="btn btn-outline-info btn-sm"><i class="mdi mdi-eye"></i> View</a>

                                            <button  type="button" data-url="{{ route("admin.student.approve_card_request", ["id" => $student->id]) }}" class="btn btn-outline-success btn-sm toggle-status"><i class="mdi mdi-eye"></i> Approve Card</button>

                                        <button  type="button" data-url="{{ route("admin.student.deny_card_request", ["id" => $student->id]) }}" class="btn btn-outline-warning btn-sm toggle-status"><i class="mdi mdi-eye"></i> Deny Card</button>

                                    


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







  
</script>
@endsection