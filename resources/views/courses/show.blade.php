@extends('layouts.app')

@section("page_title", "Students taking ".$course->title)

@section('page_content')
    

    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box">
                    <div class="text-right mb-2">
                        <div class="btn-group">
                            @if($course->can_upload_result)
                                <a data-toggle="modal" data-target="#uploadStudentsSheetModal" class="btn btn-outline-success">
                                    <i class="mdi mdi-upload"></i> Upload Result Sheet for {{ $course->title }}
                                </a>
                            @endif
                            <a href="{{ route("course.student-sheet", ["id" => $course->id, "format" => "excel"]) }}" class="btn btn-outline-info">
                                <i class="mdi mdi-download"></i> Download as Excel
                            </a>
                        </div>
                    </div>

                    <h4 class="m-t-0 header-title">Students taking {{ $course->title }}</h4>

                    <table class="table mb-0" id="courses-table">
                        <thead>
                        <tr>
                            <th>Registration Number</th>
                            
                            
                            <th>Full Name</th>
                            
                            <th>
                                Score
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($course->students as $student)
                            <tr>
                                <td>{{ $student->registration_number }}</td>
                                <td>{{ $student->user->full_name }}</td>
                                <td>
                                    {{ ($course->student_result($student->id)) ? $course->student_result($student->id)->score : "NULL" }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

   
   
    <div  style="" class="modal fade" id="uploadStudentsSheetModal" tabindex="-1" role="dialog" aria-labelledby="uploadStudentsSheetModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
           
           
            <div    class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadStudentsSheetModalLabel">Upload excel sheet for students</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route("students.upload-results") }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}" required>
                    <div class="modal-body">

                        <div class="table-responsive bulk-upload-guidelines">
                            <div class="bulk-upload-guidelines-header">
                                Excel sheet must have the following columns
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Registration Number</th>
                                    <th>Full Name</th>
                                    <th>Score</th>
                                 
                                </tr>
                            </table>
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="file" id="student_sheet" required name="student_sheet">
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




@endsection

@section("page_scripts")
    <script>
        //$("#addNewCourseModal").modal("show");

        $(document).ready(function() {
            // Default Datatable
            $('#courses-table').DataTable({
                searching: false,
                lengthChange: false
            });
        });
    </script>
@endsection