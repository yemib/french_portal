<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<div id="wrapper">

    <div class="content-page">
        <div class="content">
            <div class="col-12">
                <h5>
                    {{ config("app.name") }}
                    <br>
                    <small>@yield("pdf_title")</small>
                </h5>
            </div>

            <br>

            @if(isset($student))
                <div class="col-12">
                    <div class="card-box">
                        <div class="student-profile-box">
                            <div class="avatar">
                                <img src="{{ public_path(). '/' . (($student->user->avatar) ? "storage/images/avatar/".$student->user->id."/".$student->user->avatar : "_dashboard/assets/images/users/avatar-1.jpg") }}" class="img-fluid img-rounded img-thumbnail" style="max-width: 200px">
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-12 table-responsive">
                @yield("pdf_content")
            </div>

            <hr>

            <div class="col-12">
                <div class="text-right" style="font-size: xx-small; color: #888">
                    <i>{{ date("d-m-Y H:i:sa") }}</i>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>