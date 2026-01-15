@extends('layouts.app')

@section("page_title", "Students")

@section('page_content')

    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title">Students in {{ ucfirst(auth()->user()->school->school_title) }}</h4>
                    <table class="table mb-0" id="students-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Registration Number</th>
                            <th>Full Name</th>
                            <th>Program</th>
                            <th>Department</th>
                            <th>
                                View
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
                                <td>{{ ucfirst($student->program->title) }}</td>
                                <td>{{ ucfirst($student->department->title) }}</td>
                                <td>
                                    <a href="{{ route("supervisor.student.show", ["id" => $student->id]) }}" class="btn btn-outline-info btn-sm"><i class="mdi mdi-eye"></i> View</a>
                                </td>
                            </tr>
                            @php $i++ @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("page_scripts")
    <script>
        $(document).ready(function() {
            // Default Datatable
            $('#students-table').DataTable({
                searching: false,
                lengthChange: false
            });
        });
    </script>
@endsection