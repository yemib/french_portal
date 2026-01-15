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
                            {{ __('Reset Password') }}
                        </div>
                    </a>
                </h4>
            </div>
            <div class="account-content">
                <form method="POST" action="{{ route('password.email') }}">
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
                        <button class="btn btn-block btn-success waves-effect waves-light" type="submit">
                            {{ __('Send Password Reset Link') }}
                        </button>
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
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
