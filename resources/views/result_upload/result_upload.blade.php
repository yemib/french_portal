@extends('layouts.app')

@section("page_title", "Students")

@section('page_content')

<?php
//program model  
// school model  

use App\Http\Models\program;
use App\Http\Models\Setting;


$program  = program::get();
$school  = Setting::get();


?>


<div class="pt-1">
    <div class="row mt-1">
        <div class="col-12">
            <div class="card-box">

                <h4 class="m-t-0 header-title">Result Upload </h4>


                <form action="course/students/upload-results" method="post" enctype="multipart/form-data">




                    <label> Date : </label>

                    <div class="row">


                        <div class="col-sm-3">


                            From : <input class="form-control" required type="date" name="from_date" />

                        </div>

                        <div class="col-sm-3">




                            To : <input class="form-control" required type="date" name="to_date" />

                        </div>



                    </div>

                    <div> <br /> </div>







                    <div class="form-group mb-3 col-12 col-md-12">

                        <label> Select Programs </label>

                        <select class="form-control" name="program">
                            <?php foreach ($program  as $program) {    ?>


                                <option value="{{   $program->id }}"> {{ $program->title }} </option>

                            <?php   } ?>

                        </select>


                    </div>


                    <div class="form-group mb-3 col-12 col-md-12">

                        <label> Select School </label>

                        <select name="school" class="form-control">



                            <?php foreach ($school as $school) {   ?>

                                <option value="{{   $school->id  }}"> {{ $school->school_title  }} </option>

                            <?php   } ?>

                        </select>

                    </div>

                    <div class="form-group mb-3 col-3 col-md-3">
                        <label> Session </label>

                        <input required class="form-control" type="number" name="session">

                    </div>


                    <!---    place the format here   --->


                    <div class="bulk-upload-guidelines-header">
                        Excel sheet must have the following columns format
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th> S/N</th>

                            <th>Matric No</th>


                            <th>Name</th>


                            <th> courses.... </th>
                            <th>Total </th>
                            <th>Average </th>
                            <th>Grade </th>
                            <th>Remark </th>



                        </tr>
                    </table>



                    <div class="form-group mb-3 col-12 col-md-12">
                        <label class="btn btn-primary" for="file">Select Excel Sheet </label>
                        <input style="" id="file" type="file" name="result_sheet" /> @csrf
                        <div class="form-group mb-3 col-12 col-md-12"> <input class="btn btn-success" type="submit" value="submit" />
                        </div>
                    </div>



            </div>
        </div>
    </div>

    </form>
    @endsection

    @section("page_scripts")
    <script>
        $(document).ready(function() {
            // Default Datatable
            $('#students-table').DataTable({
                searching: false,
                lengthChange: false
            });
        });
    </script>
    @endsection