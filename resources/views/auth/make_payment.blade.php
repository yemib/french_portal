@extends('layouts.app')

@section('page_content')
    <div class="account-pages">
        <div class="account-box">
            <!-- Logo box-->
            <div class="account-logo-box">
                <h4 class="text-uppercase text-center">
                    <a href="{{ route("home") }}" class="text-success">
                        <div>
                            <img src="{{ asset("_dashboard/assets/images/logo_dark.png") }}" alt="" height="28" class="d-none">
                            Complete your application payment
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

                <form action="https://login.remita.net/remita/ecomm/finalize.reg" name="SubmitRemitaForm" method="post">
                    @csrf
                    <input name="merchantId" value="4054002435" type="hidden">
                    <input name="hash" value="{{ hash("SHA512", "4054002435".$rrr."184762") }}" type="hidden">
                    <input name="rrr" value="{{ $rrr }}" type="hidden">
                    <input name="responseurl" value="http://portal.frenchvillage.edu.ng/pay-remita" type="hidden">
                    <button type="submit" name="submit_btn" class="btn btn-success btn-block">Pay Via Remita</button>
                </form>
                <!-- end row-->
                
                    @if(Session::has('success'))
                    
                    
                    <div   style="display: none" class="text-success text-center mb-3">
                        <small>{!! Session::get('success') !!}</small>
                    </div>
                    
                    
                @endif
                
            </div>
            <!-- end account-content -->
        </div>
        <!-- end account-box -->
    </div>
@endsection
