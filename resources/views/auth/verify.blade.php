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
                            {{ __('Register') }}
                        </div>
                    </a>
                </h4>
            </div>
            <div class="account-content">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="username" class="font-weight-medium">Full Name</label>
                        <input class="form-control" type="text" id="username" required="" placeholder="Michael Zenaty">
                    </div>
                    <div class="form-group mb-3">
                        <label for="emailaddress" class="font-weight-medium">Email address</label>
                        <input class="form-control" type="email" id="emailaddress" required="" placeholder="john@deo.com">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="font-weight-medium">Password</label>
                        <input class="form-control" type="password" required="" id="password" placeholder="Enter your password">
                    </div>
                    <div class="form-group mb-3">
                        <div class="checkbox checkbox-info">
                            <input id="remember" type="checkbox" checked="checked">
                            <label for="remember">I accept <a href="#" class="text-muted">Terms and Conditions</a></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-success waves-effect waves-light" type="submit">Free Sign Up</button>
                    </div>
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
        <!-- end account-box -->
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
