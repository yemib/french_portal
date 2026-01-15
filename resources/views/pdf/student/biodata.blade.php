@extends("pdf.pdf_overall")

@section("pdf_title", "Student Biodata for ".$student->user->full_name)

@section("pdf_content")
    <table class="card-box table table-bordered table-striped">
        <tbody>
        <tr>
            <th>Full Name</th>
            <td>
                {{ $student->user->full_name }}
            </td>
        </tr>
        <tr>
            <th>Registration Number</th>
            <td>
                {{ $student->registration_number }}
            </td>
        </tr>
        <tr>
            <th>Program</th>
            <td>
                {{ $student->program->title }}
            </td>
        </tr>
        <tr>
            <th>Department</th>
            <td>
                {{ $student->department->title }}
            </td>
        </tr>
        <tr>
            <th>Level</th>
            <td>
                {{ $student->current_session }}
            </td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>
                {{ ($student->biodata) ? $student->biodata->phone : NULL }}
            </td>
        </tr>
        <tr>
            <th>Date of birth</th>
            <td>
                {{ ($student->biodata) ? $student->biodata->dob : NULL }}
            </td>
        </tr>
        <tr>
            <th>State of origin</th>
            <td>
                {{ ($student->biodata) ? $student->biodata->state_of_origin : NULL }}
            </td>
        </tr>
        <tr>
            <th>School of origin</th>
            <td>
                {{ ($student->biodata) ? $student->biodata->school_of_origin : NULL }}
            </td>
        </tr>
        <tr>
            <th>Next of kin</th>
            <td>
                {{ ($student->biodata) ? $student->biodata->next_of_kin_name : NULL }}
            </td>
        </tr>
        <tr>
            <th>Next of kin phone</th>
            <td>
                {{ ($student->biodata) ? $student->biodata->next_of_kin_phone : NULL }}
            </td>
        </tr>
        <tr>
            <th>Next of kin address</th>
            <td>
                {{ ($student->biodata) ? $student->biodata->next_of_kin_address : NULL }}
            </td>
        </tr>
        </tbody>
    </table>
@endsection