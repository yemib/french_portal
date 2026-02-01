<?php
/* if (!session('confirm_payment')) {
?>

    <script>
        window.location = '/registration_payment';
    </script>
<?php

    die();
}

 */
?>
@extends('layouts.app')

@section('page_content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


<div class="account-pages" style="padding-top: 0">
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
            <div class="account-box" style="max-width: inherit">
                <div class="account-logo-box text-center">
                    <img src="{{ asset('images/Nigeria-French-Language-Village-NFLV.jpg') }}" alt="" style="max-height: 70px" class="img-fluid">
                    <div>
                        <h3 class="d-none">
                            {{ config('app.name') }}
                        </h3>
                        <a href="{{ route('home') }}" class="text-success">
                            <h5 class="text-uppercase text-center">
                                Application for admission into special programmes
                            </h5>
                        </a>
                    </div>
                </div>
                <div class="account-content">

                    <form method="POST" action="<?php if (isset(auth()->user()->account_type)) { ?>/register_straight<?php  } else {   ?> {{ route('register') }} <?php } ?>" enctype="multipart/form-data">
                        @csrf

                        @if(Session::has('success'))
                        <div class="text-success text-center">
                            <small>{!! Session::get('success') !!}</small>
                        </div>
                        @else
                        @if($errors->count())
                        <div class="text-danger text-center">
                            <small>{{ $errors->first() }}</small>
                        </div>
                        @endif
                        @if(Session::has('danger'))
                        <div class="text-danger text-center">
                            <small>{!! Session::get('danger') !!}</small>
                        </div>
                        @endif

                        <div id="register_personal_section">
                            <h5 class="text-uppercase mb-3">Personal Data</h5>
                            <div class="row">
                                <div class="form-group mb-3 col-12 col-md-4">
                                    <input class="form-control" type="text" name="surname" id="surname" required placeholder="Surname">
                                </div>
                                <div class="form-group mb-3 col-12 col-md-4">
                                    <input class="form-control" type="text" name="first_name" id="first_name" required placeholder="First Name">
                                </div>
                                <div class="form-group mb-3 col-12 col-md-4">
                                    <input class="form-control" type="text" name="other_names" id="other_names" required placeholder="Other Names">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-12 col-md-4">
                                    <select class="form-control" name="sex" required>
                                        <option value="">Sex</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-12 col-md-4">
                                    <select class="form-control" name="marital_status" required>
                                        <option value="">Marital Status</option>
                                        <option value="Single">Single</option>
                                        <option value="Single">Married</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-12 col-md-4">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                                </div>
                                <div class="form-group mb-3 col-12 col-md-4">
                                    <input type="email" class="form-control" name="email" placeholder="email" required>
                                </div>


                                <div class="form-group mb-3 col-12 col-md-4">
                                    <input type="password" class="form-control" name="password" placeholder="Desired Password" required>
                                </div>



                                <div class="form-group mb-3 col-12 col-md-4">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Re enter your Password" required>
                                </div>


                            </div>
                            <div class="row">
                                <div class="form-group mb-12 col-12 col-md-12">



                                    <input
                                        id="dob"
                                        class="form-control"
                                        name="dob"
                                        type="text"
                                        placeholder="Select date of birth" />



                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-12 col-md-4">
                                    <input type="text" class="form-control" name="place_of_birth" placeholder="Place of birth" required>
                                </div>
                                <div class="form-group mb-3 col-12 col-md-4">
                                    <input type="text" class="form-control" name="nationality" placeholder="Nationality" required>
                                </div>
                                <div class="form-group mb-3 col-12 col-md-4">
                                    <input type="text" class="form-control" name="state_of_origin" placeholder="State of origin" required>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <textarea type="text" class="form-control" name="postal_address" placeholder="Postal Address" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <textarea type="text" class="form-control" name="permanent_address" placeholder="Permanent contact address (if different from above)"></textarea>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3 col-12 col-md-4">
                                    <input type="text" class="form-control" name="next_of_kin" placeholder="Next of kin" required>
                                </div>
                                <div class="form-group mb-3 col-12 col-md-4">
                                    <input type="text" class="form-control" name="next_of_kin_relationship" placeholder="Relationship" required>
                                </div>
                                <div class="form-group mb-3 col-12 col-md-4">
                                    <input type="text" class="form-control" name="next_of_kin_occupation" placeholder="Occupation" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="next_of_kin_address" placeholder="Next of kin address" class="form-control" required></textarea>
                            </div>

                            <div class="row">
                                <div class="form-group mb-3 col-12 col-md-6">
                                    <select class="form-control" name="had_disability" required>
                                        <option value="">Have you any disability?</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-12 col-md-6">
                                    <input type="text" class="form-control" name="had_disability_yes" placeholder="If yes, please state nature of disability">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div id="register_academic_section">
                            <h5 class="text-uppercase mb-3 mt-3">Academic Data</h5>

                            <div class="form-group">
                                <select class="form-control" name="level_of_french_proficiency" required>
                                    <option value="">Level of proficiency in french</option>
                                    <option value="Beginner">Beginner</option>
                                    <option value="Elementary">Elementary</option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Advanced">Advanced</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="form-group col-12 col-md-6">
                                    <select class="form-control" name="any_post_secondary_qualification" required>
                                        <option value="">Any Post-Secondary qualification in french?</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-12 col-md-6">
                                    <input type="text" class="form-control" name="any_post_secondary_qualification_yes" placeholder="If yes, please state which">
                                </div>
                                <div class="form-group mb-3 col-12 col-md-6">
                                    <input type="text" class="form-control" name="any_post_secondary_qualification_year" placeholder="Year">
                                </div>
                                <div class="form-group mb-3 col-12 col-md-6">
                                    <select class="form-control" name="any_post_secondary_qualification_institution">
                                        <option value="">Select School</option>
                                        @foreach($schools as $school)
                                        <option value="{{ $school->id }}">{{ ucfirst($school->school_title) }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control d-none" name="any_post_secondary_qualification_institution_old" placeholder="Institution">
                                </div>
                                <div class="form-group mb-3 col-12 col-md-6">
                                    <input type="text" class="form-control" name="course_in_view" placeholder="Course in view">
                                </div>
                                <div class="form-group mb-3 col-12 col-md-6">
                                    <select class="form-control" name="course_in_view_award">
                                        <option value="">Please select</option>
                                        <option value="Certificate">Certificate</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Post-Graduate Diploma">Post-Graduate Diploma</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-12 col-md-6">
                                    <select class="form-control" name="applied_before" required>
                                        <option value="">Have you ever applied for admission into the Nigerian French Village?</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-12 col-md-6">
                                    <input type="text" class="form-control" name="applied_before_yes" placeholder="If yes, please specify">
                                </div>
                                <div class="form-group mb-3 col-12 col-md-6">
                                    <select class="form-control" name="attended_course_before" required>
                                        <option value="">Have you ever attended any course in the Nigerian French Village?</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-12 col-md-6">
                                    <input type="text" class="form-control" name="attended_course_before_yes" placeholder="If yes, please specify, stating programme, year and level of pass">
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-uppercase mb-1 mt-1">Secondary Education <small>(WASC/GCE/SSC)</small></h5>
                            </div>
                            {{-- <div class="form-group">
                                        <input type="radio" name="secondary_education" value="">
                                    </div> --}}
                            @for ($i = 1; $i <= 9; $i++)
                                <div class="col-12 col-md-6 form-group">
                                <input type="text" name="secondary_education_subject_{{ $i }}" class="form-control" placeholder="Subject" required>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <input type="text" name="secondary_education_grade_{{ $i }}" class="form-control" placeholder="Grade" required>
                        </div>
                        @endfor
                </div>

                <hr>
                <div class="row">
                    <div class="col-12">
                        <h5 class="text-uppercase mb-1 mt-1">Reference</h5>
                        <small>
                            <label for="">Name three persons to whom reference may be made, (at last one of these should be your teacher in the institution you attended)</label>
                        </small>
                    </div>
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="form-group mb-3 col-12 col-md-6">
                        <input type="text" class="form-control" name="referee_{{ $i }}_name" placeholder="Name of referee">
                </div>
                <div class="form-group mb-3 col-12 col-md-6">
                    <input type="text" class="form-control" name="referee_{{ $i }}_position" placeholder="Position / Rank">
                </div>
                <div class="form-group mb-3 col-12">
                    <textarea type="text" class="form-control" rows="2" name="referee_{{ $i }}_address" placeholder="Address"></textarea>
                </div>
                @endfor
                {{-- <div class="form-group mb-3 col-12 col-md-6">
                                        <input type="text" class="form-control" name="referee_2_name" placeholder="Name of referee">
                                    </div>
                                    <div class="form-group mb-3 col-12 col-md-6">
                                        <input type="text" class="form-control" name="referee_2_position" placeholder="Position / Rank">
                                    </div>
                                    <div class="form-group mb-3 col-12">
                                        <textarea type="text" class="form-control" rows="2" name="referee_2_address" placeholder="Address"></textarea>
                                    </div>
                                    <div class="form-group mb-3 col-12 col-md-6">
                                        <input type="text" class="form-control" name="referee_3_name" placeholder="Name of referee">
                                    </div>
                                    <div class="form-group mb-3 col-12 col-md-6">
                                        <input type="text" class="form-control" name="referee_3_position" placeholder="Position / Rank">
                                    </div>
                                    <div class="form-group mb-3 col-12">
                                        <textarea type="text" class="form-control" rows="2" name="referee_3_address" placeholder="Address"></textarea>
                                    </div> --}}
                <small>
                    <label for="">
                        {{-- Each referee is to complete  --}}
                    </label>
                </small>
            </div>

            <hr>
            <div class="row">
                <div class="col-12">
                    <h5 class="text-uppercase mb-1 mt-1">Sponsorship</h5>
                    <small>
                        Give the name and address of your sponsor (if any)
                    </small>
                </div>
                <div class="form-group mb-3 col-12">
                    <input type="text" class="form-control" name="sponsor_name" placeholder="Name">
                </div>
                <div class="form-group mb-3 col-12">
                    <textarea type="text" class="form-control" rows="2" name="sponsor_address" placeholder="Address"></textarea>
                </div>

                <div class="form-group mb-3 col-12">
                    <input type="text" class="form-control" name="proposed_vocation" placeholder="Proposed profession, vocation or activity on completion of course">
                </div>
                <div class="form-group mb-3 col-12">
                    <label for="">Attach your passport photograph</label>
                    <input type="file" class="form-control" name="passport" accept="image/*" required>
                </div>
            </div>

            <hr>
            <div class="row mt-3">
                <div class="form-group col-12 col-sm-6">
                    <select class="form-control" id="program" required name="program">
                        <option value="">Select a program</option>
                        @foreach($programs as $program)
                        <option value="{{ $program->id }}" data-departments="{{ $program->departments }}">{{ ucfirst($program->title) }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group col-12 col-sm-6">
                    <select class="form-control" id="department" required name="department">
                        <option value="">Select a department</option>



                    </select>
                </div>


            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="terms" required>
                    I hereby declare that the information supplied in this form are to the best of my knowledge and belief.
                </label>
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-success waves-effect waves-light" type="submit">Submit</button>
            </div>
            @endif
            </form>
            <!-- end form -->
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p class="text-muted">
                        Already have an account?
                        <a href="{{ route("login") }}" class="text-dark ml-1">
                            <b>Sign In</b>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mb-4 mt-4">
        <h5>
            Payments powered by:
        </h5>
        <img src="{{ asset("remita.jpg") }}" alt="" style="max-width: 150px">
    </div>
</div>
</div>
</div>
@endsection

@section("page_scripts")
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#dob", {
        dateFormat: "Y-m-d",
        maxDate: "today",
        yearSelectorType: "dropdown"
    });
</script>

<script src="{{ asset('js/moment.min.js') }}"></script>
<script type="text/javascript">
    const register_form = $(".account-content").find("form");
    const register_program = register_form.find("select[name=program]");
    const register_department = register_form.find("select[name=department]");
    let register_month_of_birth = $("select[name=month_of_birth]");
    let register_day_of_birth = $("select[name=day_of_birth]");

    register_program.on("change", function() {
        register_department.html('<option value="">Select a department</option>').val('');
        if (register_program.val() !== "") {
            let student_departments = register_program.find("option:selected").data("departments");
            $.each(student_departments, function(key, val) {
                register_department.append('<option value="' + val.id + '">' + val.title + '</option>');
            });
        }
    });

    register_month_of_birth.on("change", function() {
        if (register_month_of_birth.val() !== "") {
            register_day_of_birth.html('<option value="">Day of birth</option>').val("");
            for (var day_of_birth = 1; day_of_birth <= moment("2012-" + register_month_of_birth.val(), "YYYY-MM").daysInMonth(); day_of_birth++) {
                register_day_of_birth.append('<option value="' + day_of_birth + '">' + day_of_birth + '</option>');
            }
        }
    });
</script>
@endsection