@extends('layouts.app')

@section("page_title", "Courses")

@section('page_content')

    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box">
                    <div class="dropdown float-right"><a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" data-toggle="modal" data-target="#addNewCourseModal" class="dropdown-item">Add a new course</a>
                        </div>
                    </div>

                    <h4 class="m-t-0 header-title">Courses</h4>
                    <table class="table mb-0" id="courses-table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Code</th>
                            <th>Department</th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1 @endphp
                        @foreach($courses as $course)
                            <tr>
                                <td>{{ ucfirst($course->title) }}</td>
                                <td>{{ ucfirst($course->code) }}</td>
                                <td>
                                    {{ ucfirst($course->department->title) }}
                                    <small class="text-muted">
                                        -
                                        Level {{ $course->level }}
                                    </small>
                                </td>
                                <td>
                                    <form method="post" action="{{ route("admin.course.destroy", ["id" => $course->id]) }}">
                                        @csrf
                                        {{ method_field("DELETE") }}
                                        <div class="btn-group">
                                           <?php 
                                           /*
                                            <a href="{{ route("course.show", ["id" => $course->id]) }}" class="btn btn-outline-success btn-sm"><i class="mdi mdi-eye"></i> View</a> */
                                            
                                            ?>
                                            <button type="button" data-toggle="modal" data-target="#editCourse{{ $course->id }}Modal" class="btn btn-info btn-sm"><i class="mdi mdi-square-edit-outline"></i> Edit</button>
                                            
                                            <button class="btn btn-danger btn-sm" type="submit">
                                                <i class="mdi mdi-delete"></i> Delete
                                            </button>
                                            
                                            
                                        </div>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="editCourse{{ $course->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="editCourse{{ $course->id }}ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editCourse{{ $course->id }}ModalLabel">Update course</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="{{ route("admin.course.update", ["id" => $course->id]) }}">
                                            @csrf
                                            {{ method_field("PUT") }}
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <input class="form-control" type="text" id="title" required name="title" placeholder="Course title" value="{{ $course->title }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <input class="form-control" type="text" id="code" required name="code" placeholder="Course code" value="{{ $course->code }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <select class="form-control" id="department" required name="department">
                                                        <option value="">Select a department</option>
                                                        @foreach($departments as $department)
                                                            <option value="{{ $department->id }}" @if($department->id == $course->department->id) selected @endif>{{ ucfirst($department->title) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <input class="form-control" min="1" required type="number" id="level" name="level" placeholder="Course level" value="{{ $course->level }}">
                                                </div>
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

    <div class="modal fade" id="addNewCourseModal" tabindex="-1" role="dialog" aria-labelledby="addNewCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewCourseModalLabel">Add new course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route("admin.course.store") }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <input class="form-control" type="text" id="title" required name="title" placeholder="Course title">
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" type="text" id="code" required name="code" placeholder="Course code">
                        </div>
                        <div class="form-group mb-3">
                            <select class="form-control" id="department" required name="department">
                                <option value="">Select a department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ ucfirst($department->title) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" min="1" type="number" id="level" required name="level" placeholder="Course level">
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