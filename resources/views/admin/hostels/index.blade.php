@extends('layouts.app')

@section("page_title", "Hostels")

@section('page_content')

    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="dropdown float-right"><a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" data-toggle="modal" data-target="#addNewHostelModal" class="dropdown-item">Add a new hostel</a>
                        </div>
                    </div>

                    <h4 class="m-t-0 header-title">Hostels</h4>
                    <table class="table mb-0" id="hostels-table">
                        <thead>
                        <tr>
                            <th class="d-none">#</th>
                            <th>Title</th>
                            <th>Total Capacity</th>
                            <th>Spaces Remaining</th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1 @endphp
                        @foreach($hostels as $hostel)
                            <tr>
                                <th class="d-none" scope="row">{{ $i }}</th>
                                <td>{{ ucfirst($hostel->title) }}</td>
                                <td>
                                    {{ $hostel->capacity }}
                                </td>
                                <td>
                                    {{ $hostel->spaces_remaining }}
                                </td>
                                <td>
                                    <form method="post" action="{{ route("admin.hostel.destroy", ["id" => $hostel->id]) }}">
                                        @csrf
                                        {{ method_field("DELETE") }}
                                        <div class="btn-group">
                                            <button type="button" data-toggle="modal" data-target="#editHostel{{ $hostel->id }}Modal" class="btn btn-info btn-sm"><i class="mdi mdi-square-edit-outline"></i> Edit</button>
                                            <button class="btn btn-danger btn-sm" type="submit">
                                                <i class="mdi mdi-delete"></i> Delete
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="editHostel{{ $hostel->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="editHostel{{ $hostel->id }}ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editHostel{{ $hostel->id }}ModalLabel">Update hostel</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="{{ route("admin.hostel.update", ["id" => $hostel->id]) }}">
                                            @csrf
                                            {{ method_field("PUT") }}
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <input class="form-control" type="text" id="title" required name="title" placeholder="Hostel title" value="{{ $hostel->title }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <input class="form-control" type="number" id="rooms" required name="rooms" placeholder="Number of rooms" value="{{ $hostel->rooms }}" readonly>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <input class="form-control" type="number" id="room_capacity" required name="room_capacity" placeholder="Single room capacity" value="{{ $hostel->room_capacity }}" readonly>
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

    <div class="modal fade" id="addNewHostelModal" tabindex="-1" role="dialog" aria-labelledby="addNewHostelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewHostelModalLabel">Add new hostel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route("admin.hostel.store") }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <input class="form-control" type="text" id="title" required name="title" placeholder="Hostel title">
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" type="number" id="rooms" required name="rooms" placeholder="Number of rooms">
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" type="number" id="room_capacity" required name="room_capacity" placeholder="Single room capacity">
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
        //$("#addNewHostelModal").modal("show");

        $(document).ready(function() {
            // Default Datatable
            $('#hostels-table').DataTable({
                searching: false,
                lengthChange: false
            });
        });
    </script>
@endsection