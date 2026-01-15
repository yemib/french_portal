@extends('layouts.app')

@section("page_title", "Countries")

@section('page_content')

    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box">
                    <div class="dropdown float-right"><a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" data-toggle="modal" data-target="#addNewCountryModal" class="dropdown-item">Add a new country</a>
                        </div>
                    </div>

                    <h4 class="m-t-0 header-title">Countries</h4>
                    <table class="table mb-0" id="countries-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Country</th>
                            <th>Lecturers</th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1 @endphp
                        @foreach($countries as $country)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ ucfirst($country->title) }}</td>
                                <td>{{ ucfirst($country->program->title) }}</td>
                                <td>
                                    0
                                </td>
                                <td>
                                    <form method="post" action="{{ route("admin.country.destroy", ["id" => $country->id]) }}">
                                        @csrf
                                        {{ method_field("DELETE") }}
                                        <button type="button" data-toggle="modal" data-target="#editCountry{{ $country->id }}Modal" class="btn btn-info btn-sm"><i class="mdi mdi-square-edit-outline"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="mdi mdi-delete"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="editCountry{{ $country->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="editCountry{{ $country->id }}ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editCountry{{ $country->id }}ModalLabel">Update country</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="{{ route("admin.country.update", ["id" => $country->id]) }}">
                                            @csrf
                                            {{ method_field("PUT") }}
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <select class="form-control" id="program" required name="program">
                                                        <option value="">Select a program</option>
                                                        @foreach($programs as $program)
                                                            <option value="{{ $program->id }}" @if($program->id == $country->program->id) selected @endif>{{ ucfirst($program->title) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <input class="form-control" type="text" id="title" required name="title" placeholder="Country title" value="{{ $country->title }}">
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

    <div class="modal fade" id="addNewCountryModal" tabindex="-1" role="dialog" aria-labelledby="addNewCountryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewCountryModalLabel">Add new country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route("admin.country.store") }}">
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
                            <input class="form-control" type="text" id="title" required name="title" placeholder="Country title">
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
        //$("#addNewCountryModal").modal("show");

        $(document).ready(function() {
            // Default Datatable
            $('#countries-table').DataTable({
                searching: false,
                lengthChange: false
            });
        });
    </script>
@endsection