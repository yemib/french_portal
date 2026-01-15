@extends("pdf.pdf_overall")

@section("pdf_title", "Hostel Allocation Form")

@section("pdf_content")
    <table class="card-box table table-bordered table-striped">
        <tbody>
        <tr>
            <th>Full Name</th>
            <td>
                {{ $hostel_allocation->student->user->full_name }}
            </td>
        </tr>
        <tr>
            <th>Registration Number</th>
            <td>
                {{ $hostel_allocation->student->user->student->registration_number }}
            </td>
        </tr>
        <tr>
            <th>Program</th>
            <td>
                {{ $hostel_allocation->student->user->student->program->title }}
            </td>
        </tr>
        <tr>
            <th>Department</th>
            <td>
                {{ $hostel_allocation->student->user->student->department->title }}
            </td>
        </tr>
        <tr>
            <th>Level</th>
            <td>
                {{ $hostel_allocation->student->user->student->current_session }}
            </td>
        </tr>
        <tr>
            <th>Hostel</th>
            <td>
                @if($hostel_allocation->student->user->student->current_accommodation)
                    {{ ucfirst($hostel_allocation->student->user->student->current_accommodation->hostel->title) }}
                @else
                    <i>None</i>
                @endif
            </td>
        </tr>
        <tr>
            <th>Room Number</th>
            <td>
                @if($hostel_allocation->student->user->student->current_accommodation)
                    {{ $hostel_allocation->student->user->student->current_accommodation->room_number }}
                @else
                    <i>None</i>
                @endif
            </td>
        </tr>
        <tr>
            <th>Bed Space Number</th>
            <td>
                @if($hostel_allocation->student->user->student->current_accommodation)
                    {{ $hostel_allocation->student->user->student->current_accommodation->space_id }}
                @else
                    <i>None</i>
                @endif
            </td>
        </tr>
        </tbody>
    </table>
@endsection