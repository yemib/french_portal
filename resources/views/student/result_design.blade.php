@section('page_content')

<style>
    .student-results {
        max-width: 1000px;
        margin: auto;
        padding: 25px;
        font-family: "Segoe UI", system-ui, sans-serif;
    }

    /* HEADER */
    .result-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .result-header h2 {
        font-size: 28px;
        background: linear-gradient(90deg, #2563eb, #7c3aed);
        -webkit-background-clip: text;
        color: transparent;
    }

    .result-header p {
        color: #6b7280;
    }

    /* ACCORDION */
    .result-accordion {
        margin-bottom: 18px;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    /* HEADER BUTTON */
    .accordion-header {
        width: 100%;
        background: linear-gradient(135deg, #1e3a8a, #312e81);
        color: #fff;
        padding: 18px 20px;
        border: none;
        outline: none;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .accordion-header.active {
        background: linear-gradient(135deg, #2563eb, #7c3aed);
    }

    .term {
        font-weight: 600;
        font-size: 16px;
    }

    .toggle-icon {
        font-size: 26px;
        transition: transform 0.3s ease;
    }

    .accordion-header.active .toggle-icon {
        transform: rotate(45deg);
    }

    /* BODY */
    .accordion-body {
        max-height: 0;
        overflow: hidden;
        background: #fff;
        transition: max-height 0.4s ease;
    }

    .accordion-body.open {
        max-height: 1000px;
    }

    /* SUMMARY */
    .summary-box {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 15px;
        padding: 20px;
        background: #f9fafb;
    }

    .summary-box div {
        text-align: center;
        background: #fff;
        border-radius: 12px;
        padding: 12px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
    }

    .summary-box span {
        color: #6b7280;
        font-size: 13px;
    }

    .summary-box strong {
        display: block;
        font-size: 18px;
        color: #1f2937;
    }

    /* TABLE */
    .table-wrapper {
        padding: 20px;
    }

    .course-table {
        width: 100%;
        border-collapse: collapse;
    }

    .course-table th,
    .course-table td {
        padding: 12px;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
    }

    .course-table th {
        background: #eef2ff;
    }

    /* GRADES */
    .grade-badge {
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: bold;
        color: #fff;
    }

    .grade-a {
        background: #16a34a;
    }

    .grade-b {
        background: #22c55e;
    }

    .grade-c {
        background: #eab308;
    }

    .grade-d {
        background: #f97316;
    }

    .grade-f {
        background: #dc2626;
    }

    /* NO RESULT */
    .no-result {
        text-align: center;
        color: #9ca3af;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .accordion-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .term {
            font-size: 15px;
        }
    }
</style>

<div class="student-results">

    <!-- Header -->
    <div class="result-header">
        <!-- check if  the student match the registration no -->

        <h2>My Academic Results</h2>

        
    </div>

 

    @forelse($results as $index => $result)
    <div class="result-accordion">

        <!-- Accordion Header -->
        <button class="accordion-header {{ $index === 0 ? 'active' : '' }}">
            <div>
                <span class="term">
                    {{ \Carbon\Carbon::parse($result->from_date)->format('d M Y') }}
                    →
                    {{ \Carbon\Carbon::parse($result->to_date)->format('d M Y') }}
                </span>
                @if($result->grade != NULL && $result->grade != "N/A" )
                <span class="grade-badge grade-{{ strtolower($result->grade) }}">
                    Grade : {{ $result->grade }}
                </span>

                @endif
            </div>
            <span class="toggle-icon">+</span>
        </button>

        <!-- Accordion Content -->
        <div class="accordion-body {{ $index === 0 ? 'open' : '' }}">

            <!-- Summary -->
            <div class="summary-box">
                <div>
                    <span>Total</span>
                    <strong>{{ $result->total }}</strong>
                </div>
                <div>
                    <span>Average</span>
                    <strong>{{ $result->average }}</strong>
                </div>
                <div>
                    <span>Remark</span>
                    <strong>{{ $result->remark }}</strong>
                </div>
            </div>

            <!-- Courses Table -->
            <div class="table-wrapper">
                <table class="course-table">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(json_decode($result->course, true) as $course => $score)
                        <tr>
                            <td>{{ $course }}</td>
                            <td>{{ $score }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    @empty
    <p class="no-result">No results available.</p>
    @endforelse

</div>
@endsection

@section('page_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const headers = document.querySelectorAll('.accordion-header');

        headers.forEach(header => {
            header.addEventListener('click', function() {

                const currentBody = this.nextElementSibling;
                const isOpen = this.classList.contains('active');

                // Close all accordions
                headers.forEach(h => {
                    h.classList.remove('active');
                    h.querySelector('.toggle-icon').textContent = '+';
                    h.nextElementSibling.classList.remove('open');
                });

                // If it was closed, open it
                if (!isOpen) {
                    this.classList.add('active');
                    this.querySelector('.toggle-icon').textContent = '×';
                    currentBody.classList.add('open');
                }
            });
        });

    });
</script>
@endsection