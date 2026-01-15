@extends('layouts.app')

@section("page_title", "Supervisors")

@section('page_content')

    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box">
                    <div class="dropdown float-right"><a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" data-toggle="modal" data-target="#addNewSupervisorModal" class="dropdown-item">Add a new supervisor</a>
                        </div>
                    </div>

                    <h4 class="m-t-0 header-title">Supervisors</h4>
                    <table class="table mb-0" id="supervisors-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>School</th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1 @endphp
                        @foreach($supervisors as $supervisor)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ ucwords($supervisor->full_name) }}</td>
                                <td>
                                    {{ $supervisor->email }}
                                </td>
                                <td>
                                    {{ ucfirst($supervisor->gender) }}
                                </td>
                                <td>
                                    {{ ($supervisor->school) ? $supervisor->school->school_title : "No school" }}
                                </td>
                                <td>
                                    <form method="post" action="{{ route("admin.supervisor.destroy", ["id" => $supervisor->id]) }}" id="delete-supervisor-{{ $supervisor->id }}">
                                        @csrf
                                        {{ method_field("DELETE") }}
                                        <button type="button" data-toggle="modal" data-target="#editSupervisor{{ $supervisor->id }}Modal" class="btn btn-info btn-sm"><i class="mdi mdi-square-edit-outline"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm delete-supervisor" type="button" data-supervisor="{{ $supervisor->id }}">
                                            <i class="mdi mdi-delete"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="editSupervisor{{ $supervisor->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="editSupervisor{{ $supervisor->id }}ModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editSupervisor{{ $supervisor->id }}ModalLabel">Update supervisor</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="{{ route("admin.supervisor.update", ["id" => $supervisor->id]) }}">
                                            @csrf
                                            {{ method_field("PUT") }}

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="form-group col-12 col-sm-6">
                                                        <input class="form-control" type="text" id="surname" required name="surname" placeholder="Surname" value="{{ $supervisor->surname }}">
                                                    </div>
                                                    <div class="form-group col-12 col-sm-6">
                                                        <input class="form-control" type="text" id="other_names" required name="other_names" placeholder="Other Names" value="{{ $supervisor->other_names }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-12 col-sm-6">
                                                        <input class="form-control" type="email" id="email" required name="email" placeholder="Email Address" value="{{ $supervisor->email }}">
                                                    </div>
                                                    <div class="form-group col-12 col-sm-6">
                                                        <select class="form-control" id="gender" required name="gender">
                                                            <option value="">Gender</option>
                                                            <option value="male" @if($supervisor->gender == "male") selected @endif>Male</option>
                                                            <option value="female" @if($supervisor->gender == "female") selected @endif>Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-12">
                                                        <select class="form-control" required name="school">
                                                            <option value="">Select School</option>
                                                            @foreach($schools as $school)
                                                                <option value="{{ $school->id }}" @if($supervisor->school_id == $school->id) selected @endif>{{ ucfirst($school->school_title) }}</option>
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

    <div class="modal fade" id="addNewSupervisorModal" tabindex="-1" role="dialog" aria-labelledby="addNewSupervisorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewSupervisorModalLabel">Add new supervisor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route("admin.supervisor.store") }}">
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
                                <input class="form-control" type="email" id="email" required name="email" placeholder="Email Address">
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
            $('#supervisors-table').DataTable({
                searching: false,
                lengthChange: false
            });
        });

        $(".delete-supervisor").click(function(e){
            let supervisor_id = $(this).data("supervisor");
            swal({
                html:"Are you sure you want to delete this supervisor?<br>You won't be able to revert this!",
                type:"warning",
                showCancelButton: true,
                confirmButtonText:"Yes, delete this supervisor!"
            }).then((willDelete) => {
                if (willDelete.value) {
                    $("#delete-supervisor-" + supervisor_id).submit();
                } else {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection