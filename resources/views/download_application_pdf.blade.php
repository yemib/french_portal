@extends('layouts.pure')

@section('page_content')
    <div class="account-pages">
        <div class="account-box">
           
           <a  class="text-success"  href="https://frenchvillage.edu.ng/"> Home  </a>
            <!-- Logo box-->
            <div class="account-logo-box">
                <h4 class="text-uppercase text-center">
                    <a  class="text-success">
                        <div>
                            <img src="{{ asset("_dashboard/assets/images/logo_dark.png") }}" alt="" height="28" class="d-none">
                           Download Your Application Form 
                        </div>
                    </a>
                </h4>
            </div>
            <div class="account-content">

                @if($errors->count())
                    <div class="text-danger text-center mb-3">
                        <small>{{ $errors->first() }}</small>
                    </div>
                @endif
                @if(Session::has('danger'))
                    <div class="text-danger text-center mb-3">
                        <small>{!! Session::get('danger') !!}</small>
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="text-success text-center mb-3">
                        <small>{!! Session::get('success') !!}</small>
                    </div>
                @endif

               
                <form  onSubmit="" action="/download_application" name="SubmitRemitaForm" method="post">
                    @csrf
                    
                    <input name="id" value="{{ $id }}" type="hidden">
                    
                    <button type="submit" name="submit_btn" class="btn btn-success btn-block">Download  </button>
                </form>
                <!-- end row-->
                
         
                
            </div>
            <!-- end account-content -->
        </div>
        <!-- end account-box -->
    </div>
@endsection
