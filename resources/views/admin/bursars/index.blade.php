@extends('layouts.app')

@section("page_title", "Bursars")

@section('page_content')

    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box">
                    <div class="dropdown float-right"><a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" data-toggle="modal" data-target="#addNewBursarModal" class="dropdown-item">Add a new bursar</a>
                        </div>
                    </div>

                    <h4 class="m-t-0 header-title">Bursars</h4>
                    <table class="table mb-0" id="bursars-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1 @endphp
                        @foreach($bursars as $bursar)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ ucwords($bursar->full_name) }}</td>
                                <td>
                                    {{ $bursar->email }}
                                </td>
                                <td>
                                    {{ ucfirst($bursar->gender) }}
                                </td>
                                <td>
                                    <form method="post" action="{{ route("admin.bursar.destroy", ["id" => $bursar->id]) }}">
                                        @csrf
                                        {{ method_field("DELETE") }}
                                        <button type="button" data-toggle="modal" data-target="#editBursar{{ $bursar->id }}Modal" class="btn btn-info btn-sm"><i class="mdi mdi-square-edit-outline"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="mdi mdi-delete"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="editBursar{{ $bursar->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="editBursar{{ $bursar->id }}ModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editBursar{{ $bursar->id }}ModalLabel">Update bursar</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="{{ route("admin.bursar.update", ["id" => $bursar->id]) }}">
                                            @csrf
                                            {{ method_field("PUT") }}

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="form-group col-12 col-sm-6">
                                                        <input class="form-control" type="text" id="surname" required name="surname" placeholder="Surname" value="{{ $bursar->surname }}">
                                                    </div>
                                                    <div class="form-group col-12 col-sm-6">
                                                        <input class="form-control" type="text" id="other_names" required name="other_names" placeholder="Other Names" value="{{ $bursar->other_names }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-12 col-sm-6">
                                                        <input class="form-control" type="email" id="email" required name="email" placeholder="Email Address" value="{{ $bursar->email }}">
                                                    </div>
                                                    <div class="form-group col-12 col-sm-6">
                                                        <select class="form-control" id="gender" required name="gender">
                                                            <option value="">Gender</option>
                                                            <option value="male" @if($bursar->gender == "male") selected @endif>Male</option>
                                                            <option value="female" @if($bursar->gender == "female") selected @endif>Female</option>
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

    <div class="modal fade" id="addNewBursarModal" tabindex="-1" role="dialog" aria-labelledby="addNewBursarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewBursarModalLabel">Add new bursar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route("admin.bursar.store") }}">
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
            $('#bursars-table').DataTable({
                searching: false,
                lengthChange: false
            });
        });
    </script>
@endsection