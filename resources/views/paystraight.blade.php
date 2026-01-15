@extends('layouts.pure')
@section('page_content')
<?php

use App\Http\Models\Program;

$program   =    Program::get();
?>


<div class="account-pages" style="padding-top: 0">
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
            <div class="account-box" style="max-width: inherit">
                <div class="account-logo-box text-center">
                    <img src="{{ asset("images/Nigeria-French-Language-Village-NFLV.jpg") }}" alt="" style="max-height: 70px" class="img-fluid">
                    <div>
                        <h3 class="d-none">
                            {{ config('app.name') }}
                        </h3>
                        <a style="color: rgba(0,13,251,1.00) !important" href="{{ route("home") }}" class="text-success">
                            <h5 style="color: rgba(0,13,251,1.00) !important" class="text-uppercase text-center">
                                STUDENT CHARGES
                            </h5>
                        </a>
                    </div>
                </div>
                <div class="account-content">

                    <form method="POST" action="/payment_gateway" enctype="multipart/form-data">
                        @csrf



                        @if(Session::has('danger'))
                        <div class="text-danger text-center">
                            <small>{!! Session::get('danger') !!}</small>
                        </div>
                        @endif


                        <div id="register_personal_section">

                            <h5 class="text-uppercase mb-3">Pay Directly </h5>
                            <div class="row">




                                <div class="form-group mb-3 col-12 col-md-12">

                                    <p> Note : Please make sure you keep your RRR code after payment </p>


                                    <input class="form-control" type="" name="name" id="email" required placeholder="Name or School Name">


                                </div>






                                <div class="form-group mb-3 col-12 col-md-12">


                                    <input class="form-control" type="email" name="email" id="email" required placeholder="Your Email or School email">


                                </div>



                                <div class="form-group mb-3 col-12 col-md-12">

                                    <label> Number Of Students (Ignore if you are paying for yourself)</label>

                                    <input class="form-control" type="number" min="1" name="number" value="1" id="email" required placeholder="Number Of Students (Ignore if you are paying for yourself)">


                                </div>









                                <div class="form-group mb-3 col-12 col-md-12">


                                    <input class="form-control" type="" name="registration" id="email" placeholder="Your Matric Number (optional)">


                                </div>





                                <div class="form-group mb-3 col-12 col-md-12">

                                    <p> Please type in the correct session or module you are paying for e.g 1 </p>

                                    <input required class="form-control" type="number" name="session" id="email" placeholder="Session/Module">


                                </div>










                                <div style="" class="form-group mb-3 col-12 col-md-12">


                                    <lable> Select Your Program </lable>


                                    <select style="" name="program_id" class="form-control" type="text" id="program" required>

                                        <option></option>

                                        <?php foreach ($program   as $program) {   ?>





                                            <option value="{{   $program->id  }}"> {{ $program->title  }} </option>



                                        <?php     }  ?>

                                    </select>
                                </div>





                            </div>
                        </div>



                        <div class="form-group">

                            <p> Note : Please make sure you keep your RRR code after payment </p>

                            <button class="btn btn-block btn-success waves-effect waves-light" type="submit">Submit</button>
                        </div>



                    </form>
                    <!-- end form -->

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