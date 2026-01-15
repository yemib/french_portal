<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ config("app.name") }} | @yield("page_title", "Welcome")</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta content="" name="description">
    <meta content="" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ asset("_dashboard/assets/images/favicon.ico") }}">

    <!-- Icons css -->
    <link rel="stylesheet" type="text/css" href="{{ asset("_dashboard/assets/libs/%40mdi/font/css/materialdesignicons.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("_dashboard/assets/libs/dripicons/webfont/webfont.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("_dashboard/assets/libs/simple-line-icons/css/simple-line-icons.css") }}">
    <!-- App css -->
    <link rel="stylesheet" href="{{ asset("_dashboard/assets/css/app.min.css") }}">
    <link rel="stylesheet" href="{{ asset("_dashboard/assets/css/custom.css") }}">
    <!-- jvectormap -->
    <link href="{{ asset("_dashboard/assets/libs/jqvmap/jqvmap.min.css") }}" rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <link href="{{ asset("_dashboard/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css") }}" rel="stylesheet" type="text/css">
    <link href="{{ asset("_dashboard/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css") }}" rel="stylesheet" type="text/css">

    <link href="{{ asset("_dashboard/assets/libs/sweetalert2/sweetalert2.min.css") }}" rel="stylesheet" type="text/css">

    @yield("page_styles")
</head>

@if(in_array(Route::currentRouteName(), ["login", "logout", "register", "password.request", "password.email", "password.reset", "password.update", "verification.notice", "verification.verify", "verification.resend", "make-application-payment"]))

    <body class="bg-account-pages">

        @include("layouts.accounts_header")

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wrapper-page">
                            @yield("page_content")
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- jQuery  -->
        <script src="{{ asset("_dashboard/assets/libs/jquery/jquery.min.js") }}"></script>
        <script src="{{ asset("_dashboard/assets/libs/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
        <script src="{{ asset("_dashboard/assets/libs/jquery-slimscroll/jquery.slimscroll.min.js") }}"></script>
        <script src="{{ asset("_dashboard/assets/libs/metismenu/metisMenu.min.js") }}"></script>
        <!-- App js -->
        <script src="{{ asset("_dashboard/assets/js/jquery.core.js") }}"></script>
        <script src="{{ asset("_dashboard/assets/js/jquery.app.js") }}"></script>

    @yield("page_scripts")
    </body>

@else

    <body>
        <div id="wrapper">

            @include("layouts.header")

            @include("layouts.left_nav")

            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">

                        @include("layouts.alerts")

                     
                        @yield("page_content")
                    </div>
                </div>
            </div>

            @include("layouts.footer")

            @include("layouts.right_nav")

        </div>

        <!-- jQuery  -->
        <script src="{{ asset("_dashboard/assets/libs/jquery/jquery.min.js") }}"></script>
        <script src="{{ asset("_dashboard/assets/libs/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
        <script src="{{ asset("_dashboard/assets/libs/jquery-slimscroll/jquery.slimscroll.min.js") }}"></script>
        <script src="{{ asset("_dashboard/assets/libs/metismenu/metisMenu.min.js") }}"></script>

        <!-- Datatable js -->
        <script src="{{ asset("_dashboard/assets/libs/datatables.net/js/jquery.dataTables.min.js") }}"></script>
        
        
        <script src="{{ asset("_dashboard/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
        
        
        
        <script src="{{ asset("_dashboard/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js") }}"></script>
        
        <script src="{{ asset("_dashboard/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js") }}"></script>
        
        <!-- KNOB JS -->
        <script src="{{ asset("_dashboard/assets/libs/jquery-knob/jquery.knob.min.js") }}"></script>
        <!-- App js -->
        
        <script src="{{ asset("_dashboard/assets/js/jquery.core.js") }}"></script>
        
        <script src="{{ asset("_dashboard/assets/js/jquery.app.js") }}"></script>

        {{--Sweet alert--}}
        
        <script src="{{ asset("_dashboard/assets/libs/sweetalert2/sweetalert2.min.js") }}"></script>
        
        
        @include('script')
        
        
        @yield("page_scripts")

   
   
   @include('alertcon')
    </body>

@endif
</html>
