@extends('layouts.app')

@section('page_content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Student Results</h4>
        </div>
        <div align="right" style="padding-right: 10px;">
            <br />
            <a href="{{ route('upload-result') }}" class="btn btn-primary">Upload Result</a>
        </div>

        <div class="card-body" style="overflow: auto;">
            <!-- FILTERS -->

            <table class="table table-bordered table-striped w-100" id="resultTable">
                <thead class="table-dark">
                    <tr>
                        <th>Action</th>
                        <th> From Date</th>
                        <th>To Date </th>
                        <th>Matric No</th>
                        <th>Name</th>
                        <th>Sex</th>
                        <th>GRP</th>

                        <th>Course</th>
                        <th>Total</th>
                        <th>Average</th>
                        <th>Grade</th>
                        <th>Remark</th>
                        <th>Program</th>
                        <th>School</th>
                        <th>Uploaded By</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                    <tr data-id="{{ $result->id }}">


                        <td style="white-space: nowrap  !important;">
                            <button class="btn btn-sm btn-warning edit-btn">Edit</button>
                            <button class="btn btn-sm btn-success save-btn d-none">Save</button>
                            <button class="btn btn-sm btn-danger delete-button">Delete</button>

                            <button
                                class="btn btn-sm toggle-publish-btn 
                                {{ $result->publish ? 'btn-success' : 'btn-secondary' }}"
                                data-id="{{ $result->id }}">
                                {{ $result->publish ? 'Published' : 'Unpublished' }}
                            </button>
                        </td>
                        <td contenteditable="false" data-field="from_date">{{ $result->from_date }}</td>
                        <td contenteditable="false" data-field="to_date">{{ $result->to_date }}</td>
                        <td contenteditable="false" data-field="matric">{{ $result->matric }}</td>
                        <td contenteditable="false" data-field="name">{{ $result->name }}</td>
                        <td contenteditable="false" data-field="sex">{{ $result->sex }}</td>
                        <td contenteditable="false" data-field="grp">{{ $result->grp }}</td>

                        <td>
                            <button
                                class="btn btn-sm btn-info view-courses-btn"
                                data-id="{{ $result->id }}"
                                data-name="{{ $result->name }}"
                                data-matric="{{ $result->matric }}"
                                data-courses='{{$result->course}}'>
                                View Courses
                            </button>
                        </td>



                        <td contenteditable="false" data-field="total">{{ $result->total }}</td>
                        <td contenteditable="false" data-field="average">{{ $result->average }}</td>
                        <td contenteditable="false" data-field="grade">{{ $result->grade }}</td>
                        <td contenteditable="false" data-field="remark">{{ $result->remark }}</td>
                        <td contenteditable="false" data-field="program">{{ $result->program }}</td>
                        <td contenteditable="false" data-field="school">{{ $result->school }}</td>
                        <td>{{ $result->uploaded_by }}</td>

                    </tr>
                    @endforeach
                </tbody>

            </table>


            <style>
                #resultTable td,
                #resultTable th {
                    white-space: nowrap !important;
                }
            </style>


            <!-- COURSES MODAL -->
            <div class="modal fade" id="coursesModal" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Student Courses</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <p><strong>Matric No:</strong> <span id="modalMatric"></span></p>
                            <p><strong>Name:</strong> <span id="modalName"></span></p>

                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Course</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody id="coursesTableBody"></tbody>
                            </table>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-success" id="saveCoursesBtn">Save Changes</button>
                        </div>

                    </div>
                </div>
            </div>




        </div>
    </div>
</div>
@endsection

@section("page_scripts")
<script>
    $(function() {

        let table = $('#resultTable').DataTable({
            responsive: false,
            scrollX: true,
            pageLength: 100
        });

        // EDIT MODE
        $('#resultTable').on('click', '.edit-btn', function() {
            let row = $(this).closest('tr');

            row.find('td[data-field]').attr('contenteditable', true)
                .addClass('bg-light');

            row.find('.edit-btn').addClass('d-none');
            row.find('.save-btn').removeClass('d-none');
        });

        // SAVE UPDATE
        $('#resultTable').on('click', '.save-btn', function() {
            let row = $(this).closest('tr');
            let id = row.data('id');
            let data = {
                _token: "{{ csrf_token() }}",
                id: id
            };

            row.find('td[data-field]').each(function() {
                data[$(this).data('field')] = $(this).text().trim();
            });

            $.post("{{ route('results.update') }}", data, function() {
                row.find('td[data-field]')
                    .attr('contenteditable', false)
                    .removeClass('bg-light');

                row.find('.save-btn').addClass('d-none');
                row.find('.edit-btn').removeClass('d-none');

                Swal.fire('Updated!', 'Record updated successfully.', 'success');
            });
        });

        // DELETE WITH SWEETALERT
        $('#resultTable').on('click', '.delete-button', function() {
            let row = $(this).closest('tr');
            let id = row.data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This record will be permanently deleted!",

                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {



                if (result.value) {


                    $.post("{{ route('results.delete') }}", {
                        _token: "{{ csrf_token() }}",
                        id: id
                    }, function() {
                        table.row(row).remove().draw();

                        Swal.fire(
                            'Deleted!',
                            'Record has been deleted.',
                            'success'
                        );
                    });
                }
            });
        });


        let currentResultId = null;

        $('#resultTable').on('click', '.view-courses-btn', function() {

            let courses = $(this).data('courses');
            let name = $(this).data('name');
            let matric = $(this).data('matric');
            currentResultId = $(this).data('id');

            $('#modalName').text(name);
            $('#modalMatric').text(matric);

            let rows = '';

            Object.entries(courses).forEach(([course, score]) => {
                rows += `
            <tr>
                <td contenteditable="true" data-course="${course}">${course}</td>
                <td contenteditable="true">${score}</td>
            </tr>
                `;
            });

            $('#coursesTableBody').html(rows);

            $('#coursesModal').modal('show');
        });


        $('#saveCoursesBtn').click(function() {

            let courses = {};

            $('#coursesTableBody tr').each(function() {
                let course = $(this).find('td').eq(0).text().trim();
                let score = $(this).find('td').eq(1).text().trim();
                courses[course] = score;
            });

            $.post("{{ route('results.update.courses') }}", {
                _token: "{{ csrf_token() }}",
                id: currentResultId,
                course: JSON.stringify(courses)
            }, function() {

                // ✅ UPDATE THE VIEW BUTTON DATA
                let row = $('#resultTable tr[data-id="' + currentResultId + '"]');
                let viewBtn = row.find('.view-courses-btn');

                viewBtn.attr('data-courses', JSON.stringify(courses));
                viewBtn.data('courses', courses); // important for jQuery cache

                $('#coursesModal').modal('hide');

                Swal.fire(
                    'Saved!',
                    'Courses updated successfully.',
                    'success'
                );
            });
        });



        $('#resultTable').on('click', '.toggle-publish-btn', function() {



            let btn = $(this);
            let id = btn.data('id');

            $.post("{{ route('results.toggle.publish') }}", {
                _token: "{{ csrf_token() }}",
                id: id
            }, function(res) {

                if (res.publish) {
                    btn.removeClass('btn-secondary')
                        .addClass('btn-success')
                        .text('Published');
                } else {
                    btn.removeClass('btn-success')
                        .addClass('btn-secondary')
                        .text('Unpublished');
                }
            });
        });


    });
</script>
@endsection