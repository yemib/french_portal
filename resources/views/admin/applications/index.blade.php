@extends('layouts.app')

@section("page_title", "Pending Applications")

@section('page_content')

    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box">
                    <div class="dropdown float-right"><a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                        <div class="dropdown-menu dropdown-menu-right d-none">
                            <a href="#" data-toggle="modal" data-target="#addNewCourseModal" class="dropdown-item">Add a new application</a>
                        </div>
                    </div>

                    <h4 class="m-t-0 header-title">Pending Applications</h4>
                    <table class="table mb-0" id="applications-table">
                        <thead>
                        <tr>
                            <th class="d-none"></th>
                            <th>Date</th>
                            <th>Applicant</th>
                            <th>Payment Status</th>
                            <th>Processing Status</th>
                            <th>Program</th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        @php $i = 1 @endphp
                        
                        @foreach($pending_applications as $application)
                            <tr>
                                <td class="d-none">{{ $application->created_at }}</td>
                                <td>{{ $application->created_at->toFormattedDateString() }}</td>
                                <td>{{ ucfirst($application->full_name) }}</td>
                                <td>
                                    @if($application->paid)
                                        <small class="text-success">
                                            Paid
                                        </small>
                                    @else
                                        <small class="text-warning">
                                            Pending
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    @if($application->processed)
                                        <small class="text-success">
                                            Processed
                                        </small>
                                    @else
                                        <small class="text-warning">
                                            Pending
                                        </small>
                                    @endif
                                </td>
                                
                                <?php $program  =  App\Http\Models\Program::find($application->program_id);  ;  ?>
                                
                                <td>  {{$program->title}}  </td>
                                <td>
                                    <a href="{{ route("admin.applications.show", ["id" => $application->id]) }}" class="btn btn-outline-success btn-sm"><i class="mdi mdi-eye"></i> View </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    
                    {{  $pending_applications->links()  }}
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section("page_scripts")
    <script>
        //$("#addNewCourseModal").modal("show");

        $(document).ready(function() {
            // Default Datatable
            $('#applications-table').DataTable({
                searching: true,
                lengthChange: true,
				 "order": [[ 0, "desc" ]]
            });
        });
    </script>
@endsection
