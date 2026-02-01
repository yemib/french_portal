@extends('layouts.app')

@section("page_title", "Students")

@section('page_content')

<?php
use App\Http\Models\Program;
use App\Http\Models\Setting;

$program  = Program::get();
$school   = Setting::get();
?>

<style>
    .card-header small {
        opacity: 0.9;
    }

    .form-label {
        font-size: 0.9rem;
    }

    .table th {
        font-size: 0.85rem;
        white-space: nowrap;
    }

    .alert-info {
        border-left: 4px solid #0d6efd;
    }
</style>
<div class="container-fluid pt-3">

    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            <div class="card shadow-sm border-0">

                <!-- Header -->
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="mdi mdi-upload"></i> Result Upload
                    </h4>
                    <small>Upload student results using an Excel sheet</small>
                </div>

                <!-- Body -->
                <div class="card-body">

                    <form action="course/students/upload-results" method="post" enctype="multipart/form-data">
                        @csrf

                        <!-- Date Range -->
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">📅 Date Range</h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">From</label>
                                    <input class="form-control" required type="date" name="from_date">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">To</label>
                                    <input class="form-control" required type="date" name="to_date">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Program & School -->
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">🎓 Academic Information</h6>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Select Program</label>
                                    <select class="form-control" name="program">
                                        @foreach($program as $program)
                                            <option value="{{ $program->title }}">
                                                {{ $program->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Select School</label>
                                    <select class="form-control" name="school">
                                        @foreach($school as $school)
                                            <option value="{{ $school->school_title }}">
                                                {{ $school->school_title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Session</label>
                                    <input required class="form-control" type="number" name="session" placeholder="e.g. 2024">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Excel Format Guide -->
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">📄 Excel Sheet Format</h6>
                            <div class="alert alert-info small">
                                The uploaded Excel file must strictly follow the structure below.
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-sm align-middle text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Matric No</th>
                                            <th>Name</th>
                                            <th>Sex</th>
                                            <th>Group</th>
                                            <th>Courses...</th>
                                            <th>Total</th>
                                            <th>Average</th>
                                            <th>Grade</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <!-- File Upload -->
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">📤 Upload Result Sheet</h6>

                            <div class="d-flex align-items-center gap-3">
                                <label for="file" class="btn btn-outline-primary">
                                    <i class="mdi mdi-file-excel"></i> Choose Excel File
                                </label>

                                <input id="file" type="file" name="result_sheet" hidden>
                               
                            </div>

                            

                                <span style="font-weight: bolder;"  id="selected-file-name" class="text-muted">
                                    No file selected
                                </span>
                        </div>

                        <!-- Submit -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="mdi mdi-check-circle-outline"></i> Submit Results
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection


@section("page_scripts")
<script>
    document.getElementById('file').addEventListener('change', function () {
        const fileName = this.files.length > 0
            ? this.files[0].name
            : 'No file selected';

        document.getElementById('selected-file-name').textContent = fileName;
    });
</script>
@endsection
