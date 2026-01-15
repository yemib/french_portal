@extends('layouts.app')

@section("page_title", "Departments")

@section('page_content')

    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="dropdown float-right"><a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" data-toggle="modal" data-target="#addNewDepartmentModal" class="dropdown-item">Add a new department</a>
                        </div>
                    </div>

                    <h4 class="m-t-0 header-title">Results</h4>
                    <table class="table mb-0" id="results-table">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>No. d'Inscrp.(Matric No)</th>
                            <th>NOMS ET PRENOMS(Full Name)</th>
                            <th>SEX</th>
                            @foreach ($department->courses as $course)
                                <th>
                                    {{ $course->code }}
                                </th>
                            @endforeach
                            <th>AVERAGE</th>
                            <th>GRADE</th>
                            <th class="">REMARK</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1 @endphp
                        @foreach($department->students as $student)
                            @if ($student->user->school_id == $user->school_id)
                                <tr>
                                    <td scope="row">{{ $i }}</td>
                                    <td>
                                        {{ $student->registration_number }}
                                    </td>
                                    <td>
                                        {{ $student->user->full_name }}
                                    </td>
                                    <td>
                                        {{ ucfirst($student->user->gender) }}
                                    </td>
                                    @foreach ($department->courses as $course)
                                        <td>
                                            @if ($course_result = $student->course_results->where('course_id', $course->id)->first())
                                                {{ $course_result->score }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    @endforeach
                                    <td>
                                        {{ $student->course_results->sum('score') / ($student->course_results->count() > 0 ? $student->course_results->count() : 1) }}
                                    </td>
                                    <td>
                                        -
                                    </td>
                                    <td class="">
                                        {{ $student->result_remark ? $student->result_remark->content : '-' }}
                                    </td>
                                </tr>

                                @php $i++ @endphp
                            @endif
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
        //$("#addNewDepartmentModal").modal("show");

        $(document).ready(function() {
            // Default Datatable
            $('#results-table').DataTable({
                searching: false,
                lengthChange: false
            });
        });
    </script>
@endsection
