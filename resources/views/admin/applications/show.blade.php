@extends('layouts.app')

@section("page_title", "Application")

@section('page_content')

    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box">
                    <div class="dropdown float-right d-none"><a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                        <div class="dropdown-menu dropdown-menu-right d-none">

                        </div>
                    </div>

                    <h4 class="m-t-0 header-title">Application</h4>
                    <table class="table mb-0 table-bordered" id="application-table">
                        <thead>
                        </thead>
                        <tbody>
                        <tr>
                            <th width="40%"></th>
                            <td>
                                <img src="{{ asset("storage/images/passport/".$application_form->passport) }}" class="img-fluid img-rounded img-thumbnail" style="max-height: 100px" />
                            </td>
                        </tr>
                        <tr>
                            <th width="40%">Full Name</th>
                            <td>{{ $application_form->full_name }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Email</th>
                            <td>{{ $application_form->email }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Sex</th>
                            <td>{{ $application_form->sex }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Marital Status</th>
                            <td>{{ $application_form->marital_status }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Phone</th>
                            <td>{{ $application_form->phone }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Date of birth</th>
                            <td>{{ $application_form->dob->toFormattedDateString() }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Nationality</th>
                            <td>{{ $application_form->nationality }}</td>
                        </tr>
                        <tr>
                            <th width="40%">State of origin</th>
                            <td>{{ $application_form->state_of_origin }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Place of birth</th>
                            <td>{{ $application_form->place_of_birth }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Postal Address</th>
                            <td>{{ $application_form->postal_address }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Permanent Address</th>
                            <td>{{ $application_form->permanent_address }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Next of Kin</th>
                            <td>{{ $application_form->next_of_kin }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Relationship</th>
                            <td>{{ $application_form->next_of_kin_relationship }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Occupation</th>
                            <td>{{ $application_form->next_of_kin_occupation }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Address</th>
                            <td>{{ $application_form->next_of_kin_address }}</td>
                        </tr>
                        <tr>
                            <th width="40%">NYSC Status</th>
                            <td>{{ $application_form->nysc_status }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Previous Disability</th>
                            <td>{{ $application_form->had_disability }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Disability</th>
                            <td>{{ $application_form->had_disability_yes }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Level of French Proficiency</th>
                            <td>{{ $application_form->level_of_french_proficiency }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Post Secondary Qualification</th>
                            <td>{{ $application_form->any_post_secondary_qualification }}</td>
                        </tr>
                        <tr>
                            <th width="40%">State of Post Secondary Qualification</th>
                            <td>{{ $application_form->any_post_secondary_qualification_yes }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Post Secondary Qualification Year</th>
                            <td>{{ $application_form->any_post_secondary_qualification_year }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Post Secondary Qualification Institution</th>
                            <td>{{ $application_form->institution }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Course in view</th>
                            <td>{{ $application_form->course_in_view }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Course in view award</th>
                            <td>{{ $application_form->course_in_view_award }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Previous application to French Village</th>
                            <td>{{ $application_form->applied_before }}</td>
                        </tr>
                        <tr>
                            <th width="40%"></th>
                            <td>{{ $application_form->applied_before_yes }}</td>
                        </tr>
                        <tr>
                            <th width="40%">Previous course attendance</th>
                            <td>{{ $application_form->attended_course_before }}</td>
                        </tr>
                        <tr>
                            <th width="40%"></th>
                            <td>{{ $application_form->attended_course_before_yes }}</td>
                        </tr>

                        <tr>
                            <th width="40%">Referee 1</th>
                            <td>
                                <i class="mdi mdi-account"></i> {{ $application_form->referee_1_name }}
                                <br>
                                <small>
                                    <i>Position: </i>{{ $application_form->referee_1_position }}
                                </small>
                                <br>
                                <small>
                                    <i>Address: </i>{{ $application_form->referee_1_address }}
                                </small>
                            </td>
                        </tr>
                        <tr>
                            <th width="40%">Referee 2</th>
                            <td>
                                <i class="mdi mdi-account"></i> {{ $application_form->referee_2_name }}
                                <br>
                                <small>
                                    <i>Position: </i>{{ $application_form->referee_2_position }}
                                </small>
                                <br>
                                <small>
                                    <i>Address: </i>{{ $application_form->referee_2_address }}
                                </small>
                            </td>
                        </tr>
                        <tr>
                            <th width="40%">Referee 3</th>
                            <td>
                                <i class="mdi mdi-account"></i> {{ $application_form->referee_3_name }}
                                <br>
                                <small>
                                    <i>Position: </i>{{ $application_form->referee_3_position }}
                                </small>
                                <br>
                                <small>
                                    <i>Address: </i>{{ $application_form->referee_3_address }}
                                </small>
                            </td>
                        </tr>
                        <tr>
                            <th width="40%">Sponsor</th>
                            <td>
                                Name: {{ $application_form->sponsor_name }}
                                <br>
                                Address: {{ $application_form->sponsor_address }}
                            </td>
                        </tr>
                        <tr>
                            <th width="40%">Proposed Vocation</th>
                            <td>
                                Name: {{ $application_form->proposed_vocation }}
                            </td>
                        </tr>
                              <tr>
                            <th width="40%">Course in view award</th>
                            
                            <?php  $program =  App\Http\Models\Program::find($application_form->program_id); ?>
                            <td>
                               {{  $program->title }}
                            </td>
                        </tr>
                        
                        
                        
                        <tr>
                            <th width="40%">Secondary Education</th>
                            <td>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Subject</th>
                                        <th>Grade</th>
                                    </tr>
                                    @for ($i = 1; $i <= 9; $i++)
                                        @php $this_subject = 'secondary_education_subject_'.$i; $this_grade = 'secondary_education_grade_'.$i; @endphp
                                        @if($application_form->$this_subject)
                                            <tr>
                                                <td>
                                                    {{ $application_form->$this_subject }}
                                                </td>
                                                <td>
                                                    {{ $application_form->$this_grade }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endfor
                                </table>
                            </td>
                        </tr>
                        
                        
                        
                        
                        </tbody>
                    </table>
                </div>

                @if(!$application_form->processed)
                    <div class="mb-5 text-center">
                        <form method="post" action="{{ route("admin.applications.destroy", ["id" => $application_form->id]) }}">
                            @csrf
                            {{ method_field("DELETE") }}
                            <div class="">
                                <a href="{{ route("admin.applications.approve", ["id" => $application_form->id]) }}" class="btn btn-success"><i class="mdi mdi-check-circle-outline"></i> Approve application and create student</a>
                                <button class="btn btn-danger" type="submit">
                                    <i class="mdi mdi-delete"></i> Delete Application
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section("page_scripts")
    <script>
        //$("#addNewCourseModal").modal("show");

        $(document).ready(function() {
            // Default Datatable
            /*$('#applications-table').DataTable({
                searching: false,
                lengthChange: false
            });*/
        });
    </script>
@endsection
