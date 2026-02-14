@extends('layouts.app')

@section("page_title", "Manage Settings")

@section('page_content')

    <div class="page-title-box">
        <ol class="breadcrumb float-right d-none">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Manage Settings</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Pages</a>
            </li>
            <li class="breadcrumb-item active">Starter</li>
        </ol>
        <h4 class="page-title">Manage Settings</h4>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card-header bg-dark text-white">
                <i class="mdi mdi-account"></i> Personal
            </div>
            <div class="card-box">
                <form method="post" action="{{ route("user.manage-settings") }}">
                @csrf
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <input class="form-control" name="surname" required placeholder="Surname" value="{{ auth()->user()->surname }}">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <input class="form-control" name="other_names" required placeholder="Other Names" value="{{ auth()->user()->other_names }}">
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-sm">Save Profile</button>
                </div>
            </form>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card-header bg-dark text-white">
                <i class="mdi mdi-lock"></i> Password
            </div>
            <div class="card-box">
                <div class="student-profile-box text-center">
                    <form method="post" action="{{ route("user.change-password") }}">
                        @csrf
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" required placeholder="Enter New password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirmation" required placeholder="Confirm New password">
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-outline-info btn-sm">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="card-header bg-dark text-white">
                <i class="mdi mdi-image"></i> Picture
            </div>
            <div class="card-box">
                <div class="student-profile-box text-center">
                    <div class="avatar mb-1">
                        <img src="{{ asset((auth()->user()->avatar) ? auth()->user()->avatar : "_dashboard/assets/images/users/avatar-1.jpg") }}" class="img-fluid img-rounded img-thumbnail">
                    </div>
                    <form method="post" action="{{ route("user.change-avatar") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" class="form-control" name="avatar" accept="image/*" required>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-outline-success btn-sm">Save Avatar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("page_scripts")
@endsection
