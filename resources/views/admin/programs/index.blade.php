@extends('layouts.app')

@section("page_title", "Programs")

@section('page_content')

    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box">
                    <div class="dropdown float-right"><a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" data-toggle="modal" data-target="#addNewProgramModal" class="dropdown-item">Add a new program</a>
                        </div>
                    </div>

                    <h4 class="m-t-0 header-title">Programs</h4>
                    <table class="table mb-0" id="programs-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th class="d-none">Duration (Semesters)</th>
                            <th>Tuition Amount</th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1 @endphp
                        @foreach($programs as $program)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ ucfirst($program->title) }}</td>
                                <td class="d-none">{{ $program->duration }}</td>
                                <td>{{ number_format($program->tuition) }}</td>
                                <td>
                                    <form method="post" action="{{ route("admin.program.destroy", ["id" => $program->id]) }}">
                                        @csrf
                                        {{ method_field("DELETE") }}
                                        <button type="button" data-toggle="modal" data-target="#editProgram{{ $program->id }}Modal" class="btn btn-info btn-sm"><i class="mdi mdi-square-edit-outline"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="mdi mdi-delete"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="editProgram{{ $program->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="editProgram{{ $program->id }}ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editProgram{{ $program->id }}ModalLabel">Update program</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="{{ route("admin.program.update", ["id" => $program->id]) }}">
                                            @csrf
                                            {{ method_field("PUT") }}
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <input class="form-control" type="text" id="title" required name="title" placeholder="Program title" value="{{ $program->title }}">
                                                </div>
                                                <div class="form-group mb-3 d-none">
                                                    <input class="form-control" type="number" id="duration" min="1" name="duration" placeholder="Duration (Semesters)" value="{{ $program->duration }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <input class="form-control" type="number" id="tuition" required min="1" name="tuition" placeholder="Amount for tuition" value="{{ $program->tuition }}">
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

    <div class="modal fade" id="addNewProgramModal" tabindex="-1" role="dialog" aria-labelledby="addNewProgramModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewProgramModalLabel">Add new program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route("admin.program.store") }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <input class="form-control" type="text" id="title" required name="title" placeholder="Program title">
                        </div>
                        <div class="form-group mb-3 d-none">
                            <input class="form-control" type="number" id="duration" min="1" name="duration" placeholder="Duration (Semesters)" value="">
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" type="number" id="tuition" required min="1" name="tuition" placeholder="Amount for tuition" value="">
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
        //$("#addNewProgramModal").modal("show");

        $(document).ready(function() {
            // Default Datatable
            $('#programs-table').DataTable({
                searching: false,
                lengthChange: false
            });
        });
    </script>
@endsection
