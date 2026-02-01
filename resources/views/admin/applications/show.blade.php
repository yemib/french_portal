@extends('layouts.app')

@section("page_title", "Application")

@section('page_content')

<div class="pt-1">
    <div class="row mt-1">
        <div class="col-12">
            
                @include("admin.applications.application_details", ["application_form" => $application_form])

            <!-- this will only show if you are admins -->

            @if(!$application_form->processed)
            <div class="mb-5 text-center">
                <form method="post" action="{{ route("admin.applications.destroy", ["id" => $application_form->id]) }}">
                    @csrf
                    {{ method_field("DELETE") }}
                    <div class="">
                        <a href="{{ route("admin.applications.approve", ["id" => $application_form->id]) }}" class="btn btn-success"><i class="mdi mdi-check-circle-outline"></i> Approve application and create student</a>
                        <button class="btn btn-danger" type="submit">
                            <i class="mdi mdi-delete"></i> Delete Application
                        </button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section("page_scripts")
<script>
    //$("#addNewCourseModal").modal("show");

    $(document).ready(function() {
        // Default Datatable
        /*$('#applications-table').DataTable({
            searching: false,
            lengthChange: false
        });*/
    });
</script>
@endsection