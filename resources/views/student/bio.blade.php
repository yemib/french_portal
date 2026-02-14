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
                    <img src="{{ asset(($user->avatar) ? $user->avatar : "_dashboard/assets/images/users/avatar-1.jpg") }}" class="img-fluid img-rounded img-thumbnail">
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
                <!--   <div class="mt-1">
                        Level: <b>{{ $user->student->current_session }}</b>
                    </div> -->
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-8 col-md-9">
        <div class="card-header bg-dark text-white">
            Please fill the form below
        </div>
        <div class="card-box">
            <form method="post" action="{{ route('student.bio') }}"  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Surname</label>
                        <input class="form-control" type="text" placeholder="Surname" required readonly name="surname" value="{{ $user->surname }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Other Names</label>
                        <input class="form-control" type="text" placeholder="Other names" required readonly name="other_names" value="{{ $user->other_names }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>State of origin</label>

                        <select class="form-control" type="text" required name="state_of_origin">
                            <option value="">State of origin</option>
                            @foreach($states as $state)
                            <option value="{{ $state->id }}" {{ ($state->id == (($user->student->biodata) ? $user->student->biodata->state_of_origin : "")) ? "selected" : "" }}>{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Institution</label>
                        <input class="form-control" type="text"
                            placeholder="Institution" name="institution"
                            value="{{ ($user->student->biodata) ? $user->student->biodata->institution : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Phone Number</label>
                        <input class="form-control" type="text" placeholder="Phone" required name="phone" value="{{ ($user->student->biodata) ? $user->student->biodata->phone : "" }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Date of Birth</label>
                        <input class="form-control" type="date" placeholder="Date of birth" required name="dob" value="{{ ($user->student->biodata) ? $user->student->biodata->dob : ""/*\Carbon\Carbon::now()->subYears(20)->format("d/m/Y")*/ }}">
                    </div>




                    <div class="form-group col-md-6">
                        <label>Sex</label>
                        <select class="form-control" name="sex">
                            <option>Male</option>
                            <option>Female</option>

                        </select>
                    </div>


                    <div class="form-group col-md-6">
                        <label>Blood Group</label>

                        <input class="form-control" type="text"
                            placeholder="Blood Group" required name="blood_group"
                            value="{{ ($user->student->biodata) ? $user->student->biodata->blood_group : "" }}">

                    </div>


                    <div class="form-group col-md-6">
                        <label>Place of Birth</label>
                        <input class="form-control" type="text"
                         placeholder="Place of birth" required name="place_of_birth" 
                         value="{{ ($user->student->biodata) ? $user->student->biodata->place_of_birth : '' }}">
                    </div>

                     <div class="form-group col-md-6">
                        <label for="signature">Upload Signature</label>
                        <input class="form-control" type="file"
                         placeholder="Upload Signature"  @if( !$user->student->biodata) required  @endif name="signature" 
                        >
                        @if( $user->student->biodata)
                        <img   src="{{  $user->student->biodata->signature }}"   width="100"   height="100"/>

                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Next of Kin Name</label>
                        <input class="form-control" type="text" placeholder="Next of kin" required name="next_of_kin" value="{{ ($user->student->biodata) ? $user->student->biodata->next_of_kin : "" }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label style="text-transform: capitalize">Next of kin phone number </label>
                        <input class="form-control" type="text" placeholder="Next of kin phone number" required name="next_of_kin_phone" value="{{ ($user->student->biodata) ? $user->student->biodata->next_of_kin_phone : "" }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Address of next of kin </label>
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