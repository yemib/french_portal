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


                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                    <tr data-id="{{ $result->id }}">


                        <td style="white-space: nowrap  !important;">
                            <button class="btn btn-sm btn-warning edit-btn">Edit</button>
                            <button class="btn btn-sm btn-success save-btn d-none">Save</button>
                            <button class="btn btn-sm btn-danger delete-button">Delete</button>
                        </td>
                        <td contenteditable="false" data-field="from_date">{{ $result->from_date }}</td>
                        <td contenteditable="false" data-field="to_date">{{ $result->to_date }}</td>
                        <td contenteditable="false" data-field="matric">{{ $result->matric }}</td>
                        <td contenteditable="false" data-field="name">{{ $result->name }}</td>
                        <td contenteditable="false" data-field="sex">{{ $result->sex }}</td>
                        <td contenteditable="false" data-field="grp">{{ $result->grp }}</td>

                        <td contenteditable="false" data-field="course">{{ $result->course }}</td>
                        <td contenteditable="false" data-field="score">{{ $result->score }}</td>
                        <td contenteditable="false" data-field="average">{{ $result->average }}</td>
                        <td contenteditable="false" data-field="grade">{{ $result->grade }}</td>
                        <td contenteditable="false" data-field="remark">{{ $result->remark }}</td>
                        <td contenteditable="false" data-field="program">{{ $result->program }}</td>
                        <td contenteditable="false" data-field="school">{{ $result->school }}</td>

                    </tr>
                    @endforeach
                </tbody>

            </table>


            <style>
                #resultTable td  ,  #resultTable th {
                    white-space: nowrap !important;
                }
            </style>



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

    });
</script>
@endsection