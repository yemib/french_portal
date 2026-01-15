@extends('layouts.app')

@section("page_styles")
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset("_dashboard/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css") }}">
@endsection

@section("page_title", "Make Payment")

@section('page_content')

    <div class="page-title-box">
        <h4 class="page-title">Student Biodata</h4>
    </div>

    <div class="row">
        <div class="col-12 col-sm-4 col-md-3">
            <div class="card-box">
                <div class="student-profile-box text-center p-2">
                    <div class="avatar mb-1">
                        <img src="{{ asset(($user->avatar) ? "storage/images/avatar/".$user->id."/".$user->avatar : "_dashboard/assets/images/users/avatar-1.jpg") }}" class="img-fluid img-rounded img-thumbnail">
                    </div>
                    <div class="mt-1">
                        <i class="mdi mdi-account-outline"></i> <b>{{ $user->full_name }}</b>
                    </div>
                    <div class="mt-1">
                        <i class="mdi mdi-tab"></i> {{ $user->student->registration_number }}
                    </div>
                    <div class="mt-1">
                        <i class="mdi mdi-book-open"></i> {{ $user->student->program->title }}
                    </div>
                    <div class="mt-1">
                        <i class="mdi mdi-book-open-variant"></i> {{ $user->student->department->title }}
                    </div>
                    <div class="mt-1">
                        Level: <b>{{ $user->student->current_session }}</b>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-8 col-md-9">
            <div class="card-header bg-dark text-white">
                Please fill the form below
            </div>
            <div class="card-box">
                <form method="post" action="{{ route("student.bio") }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input class="form-control" type="text" placeholder="Surname" required readonly name="surname" value="{{ $user->surname }}">
                        </div>
                        <div class="form-group col-md-6">
                            <input class="form-control" type="text" placeholder="Other names" required readonly name="other_names" value="{{ $user->other_names }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <select class="form-control" type="text" required name="state_of_origin">
                                <option value="">State of origin</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}" {{ ($state->id == (($user->student->biodata) ? $user->student->biodata->state_of_origin : "")) ? "selected" : "" }}>{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <input class="form-control" type="text" placeholder="School of origin (optional)" name="school_of_origin" value="{{ ($user->student->biodata) ? $user->student->biodata->school_of_origin : "" }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input class="form-control" type="text" placeholder="Phone" required name="phone" value="{{ ($user->student->biodata) ? $user->student->biodata->phone : "" }}">
                        </div>
                        <div class="form-group col-md-6">
                            <input class="form-control" type="text" placeholder="Date of birth" required name="date_of_birth" value="{{ ($user->student->biodata) ? $user->student->biodata->dob : ""/*\Carbon\Carbon::now()->subYears(20)->format("d/m/Y")*/ }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input class="form-control" type="text" placeholder="Next of kin" required name="next_of_kin" value="{{ ($user->student->biodata) ? $user->student->biodata->next_of_kin_name : "" }}">
                        </div>
                        <div class="form-group col-md-6">
                            <input class="form-control" type="text" placeholder="Next of kin phone number" required name="next_of_kin_phone" value="{{ ($user->student->biodata) ? $user->student->biodata->next_of_kin_phone : "" }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" type="text" placeholder="Address of next of kin" required name="next_of_kin_address">{{ ($user->student->biodata) ? $user->student->biodata->next_of_kin_address : "" }}</textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info btn-block">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section("page_scripts")
    <!-- bootstrap datepicker -->
    <script src="{{ asset("_dashboard/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js") }}"></script>

    <script>
        $("input[name=date_of_birth]").datepicker({
            autoclose: true,
            format: "yyyy-mm-dd"
        });
    </script>
@endsection