@extends('layouts.app')

@section("page_title", "Departments")

@section('page_content')

    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box">
                    <div class="dropdown float-right"><a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" data-toggle="modal" data-target="#addNewDepartmentModal" class="dropdown-item">Add a new department</a>
                        </div>
                    </div>

                    <h4 class="m-t-0 header-title">Departments</h4>
                    <table class="table mb-0" id="departments-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Department</th>
                            <th>Lecturers</th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1 @endphp
                        @foreach($departments as $department)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ ucfirst($department->title) }}</td>
                                <td>{{ ucfirst($department->program->title) }}</td>
                                <td>
                                    0
                                </td>
                                <td>
                                    <form method="post" action="{{ route("admin.department.destroy", ["id" => $department->id]) }}">
                                        @csrf
                                        {{ method_field("DELETE") }}
                                        <button type="button" data-toggle="modal" data-target="#editDepartment{{ $department->id }}Modal" class="btn btn-info btn-sm"><i class="mdi mdi-square-edit-outline"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="mdi mdi-delete"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="editDepartment{{ $department->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="editDepartment{{ $department->id }}ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editDepartment{{ $department->id }}ModalLabel">Update department</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="{{ route("admin.department.update", ["id" => $department->id]) }}">
                                            @csrf
                                            {{ method_field("PUT") }}
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <select class="form-control" id="program" required name="program">
                                                        <option value="">Select a program</option>
                                                        @foreach($programs as $program)
                                                            <option value="{{ $program->id }}" @if($program->id == $department->program->id) selected @endif>{{ ucfirst($program->title) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <input class="form-control" type="text" id="title" required name="title" placeholder="Department title" value="{{ $department->title }}">
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

    <div class="modal fade" id="addNewDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="addNewDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewDepartmentModalLabel">Add new department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route("admin.department.store") }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <select class="form-control" id="program" required name="program">
                                <option value="">Select a program</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}">{{ ucfirst($program->title) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" type="text" id="title" required name="title" placeholder="Department title">
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
        //$("#addNewDepartmentModal").modal("show");

        $(document).ready(function() {
            // Default Datatable
            $('#departments-table').DataTable({
                searching: false,
                lengthChange: false
            });
        });
    </script>
@endsection
