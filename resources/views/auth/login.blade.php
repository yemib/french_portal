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
                            {{ __('Login') }}
                        </div>
                    </a>
                </h4>
            </div>
            <div class="account-content">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

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
                    @if(Session::has('success'))
                        <div class="text-success text-center">
                            <small>{!! Session::get('success') !!}</small>
                        </div>
                    @endif

                    <div class="form-group mb-3">
                        <label for="user_id" class="font-weight-medium">User ID</label>
                        <input class="form-control" type="text" id="user_id" required name="user_id" placeholder="Enter your user id">
                    </div>
                    <div class="form-group mb-3">
                        <a href="{{ route("password.request") }}" class="text-muted float-right d-none">
                            <small>Forgot your password?</small>
                        </a>
                        <label for="password" class="font-weight-medium">Password</label>
                        <input class="form-control" type="password" required name="password" id="password" placeholder="Enter your password">
                    </div>
                    <div class="form-group mb-3">
                        <div class="checkbox checkbox-info">
                            <input id="remember" name="remember" type="checkbox">
                            <label for="remember">Remember me</label>
                        </div>
                    </div>
                    <div class="form-group row text-center">
                        <div class="col-12">
                            <button class="btn btn-block btn-success waves-effect waves-light" type="submit">{{ __('Login') }}</button>
                        </div>
                    </div>
                </form>
                <!-- end form -->
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted">
                            Don't have an account?
                            <a href="{{ route("register") }}" class="text-dark m-l-5">
                                <b>Sign Up</b>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- end row-->
            </div>
            <!-- end account-content -->
        </div>
        <!-- end account-box -->
        <div class="text-center mt-4 mb-4">
            <h5>
                Payments powered by:
            </h5>
            <img src="{{ asset("remita.jpg") }}" alt="" style="max-width: 150px">
        </div>
    </div>
@endsection
