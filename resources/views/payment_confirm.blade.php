@extends('layouts.pure')

@section('page_content')
   
   
   <?php 

use App\Http\Models\Program;


$program   =    Program::get();


?>
   
   
    <div class="account-pages" style="padding-top: 0  ; width: 1000px !important ">
        <div class="row"  style="max-width: 100% !important">
            <div class="col-12 col-lg-10 offset-lg-1">
                <div class="account-box" style="max-width: inherit">
                    <div class="account-logo-box text-center">
                        <img src="https://frenchvillage.edu.ng/picture_logo/logo.png" alt="" style="max-height: 70px" class="img-fluid">
                        <div>
                            <h3 class="d-none">
                                {{ config('app.name') }}
                            </h3>
                            <a  class="text-success">
                                <h5 class="text-uppercase text-center">
                                    Confirm Payment Status
                                </h5>
                            </a>
                        </div>
                    </div>
                    <div class="account-content">
                       
                        <form method="POST" action="/confirmpayment" enctype="multipart/form-data">
                            @csrf

                           
                          
                                @if(Session::has('danger'))
                                    <div class="text-danger text-center">
                                        <small>{!! Session::get('danger') !!}</small>
                                    </div>
                                @endif
                                 
                                 
                                  @if(Session::has('success'))
                                <div class="text-success text-center">
                                    <small>{!! Session::get('success') !!}</small>
                                </div>
                                
                                @endif
                                

                 <div id="register_personal_section">
                                    
                              <h5 class="text-uppercase mb-3">Check Remita Status</h5>
                                    <div class="row">
                                    
                                           
                                       <div class="form-group mb-3 col-12 col-md-12">
                                                   
              <label  for="remita">   REMITA RETRIEVAL REFERENCE  (RRR)    </label>
                         <input class="form-control" type="text" name="rrr" id="remita" required placeholder="REMITA RETRIEVAL REFERENCE  (RRR)">
                                        </div>
                               
                                        
                                    </div>
                                </div>

                                
                                   
                                   <div class="form-group">
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

        register_program.on("change", function () {
            register_department.html('<option value="">Select a department</option>').val('');
            if(register_program.val() !== "") {
                let student_departments = register_program.find("option:selected").data("departments");
                $.each(student_departments, function (key, val) {
                    register_department.append('<option value="'+val.id+'">'+val.title+'</option>');
                });
            }
        });

        register_month_of_birth.on("change", function () {
            if(register_month_of_birth.val() !== "") {
                register_day_of_birth.html('<option value="">Day of birth</option>').val("");
                for(var day_of_birth=1; day_of_birth<=moment("2012-"+register_month_of_birth.val(), "YYYY-MM").daysInMonth(); day_of_birth++)
                {
                    register_day_of_birth.append('<option value="'+day_of_birth+'">'+day_of_birth+'</option>');
                }
            }
        });
    </script>
@endsection
