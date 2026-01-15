@extends('layouts.app')

@section("page_title", "Schools")

@section('page_content')

    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box">
                    <div class="dropdown float-right"><a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" data-toggle="modal" data-target="#addNewSchoolModal" class="dropdown-item">Add a new school</a>
                        </div>
                    </div>

                    <h4 class="m-t-0 header-title">Schools</h4>
                    <table class="table mb-0" id="schools-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>School Name</th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1 @endphp
                        @foreach($schools as $school)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>
                                    {{ $school->school_title }}
                                </td>
                                <td>
                                    <form method="post" action="{{ route("admin.school.destroy", ["id" => $school->id]) }}" id="delete-school-{{ $school->id }}">
                                        @csrf
                                        {{ method_field("DELETE") }}
                                        <button type="button" data-toggle="modal" data-target="#editSchool{{ $school->id }}Modal" class="btn btn-info btn-sm"><i class="mdi mdi-square-edit-outline"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm delete-school" type="button" data-school="{{ $school->id }}">
                                            <i class="mdi mdi-delete"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="editSchool{{ $school->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="editSchool{{ $school->id }}ModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editSchool{{ $school->id }}ModalLabel">Update school</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="{{ route("admin.school.update", ["id" => $school->id]) }}">
                                            @csrf
                                            {{ method_field("PUT") }}
                                            <div class="modal-body">
                                                <input class="form-control" type="text" id="school" required name="school_name" placeholder="School" value="{{ $school->school_title }}">
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

    <div class="modal fade" id="addNewSchoolModal" tabindex="-1" role="dialog" aria-labelledby="addNewSchoolModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewSchoolModalLabel">Add new school</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route("admin.school.store") }}">
                    @csrf
                    <div class="modal-body">
                        <input class="form-control" type="text" id="school" required name="school_name" placeholder="School" value="">
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
            $('#schools-table').DataTable({
                searching: false,
                lengthChange: false
            });
        });

        $(".delete-school").click(function(e){
            let school_id = $(this).data("school");
            swal({
                html:"Deleting this school will remove all users from this school?<br>You won't be able to revert this!",
                type:"warning",
                showCancelButton: true,
                confirmButtonText:"Yes, delete this school!"
            }).then((willDelete) => {
                if (willDelete.value) {
                    $("#delete-school-" + school_id).submit();
                } else {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection
