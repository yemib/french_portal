<?php

namespace App\Imports;

use App\Http\Models\result;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class CourseResultImport extends DefaultValueBinder
    implements ToCollection, WithHeadingRow, WithCustomValueBinder
{
    protected array $extra;

    public function __construct(array $extra)
    {
        $this->extra = $extra;
    }

    public function collection(Collection $rows)
    {
        if ($rows->isEmpty()) {
            return;
        }

        // Get headers safely
        $headers = array_values(array_keys($rows->first()->toArray()));
        $totalColumns = count($headers);

        if ($totalColumns < 9) {
            return;
        }

        /*
        |------------------------------------------------------------
        | COLUMN INDEXES
        |------------------------------------------------------------
        */
        $SN_INDEX     = 0;
        $MATRIC_INDEX = 1;
        $NAME_INDEX   = 2;
        $SEX_INDEX    = 3;
        $GRP_INDEX    = 4;

        $TOTAL_INDEX   = $totalColumns - 4;
        $AVERAGE_INDEX = $totalColumns - 3;
        $GRADE_INDEX   = $totalColumns - 2;
        $REMARK_INDEX  = $totalColumns - 1;

        /*
        |------------------------------------------------------------
        | COURSE RANGE
        |------------------------------------------------------------
        */
        $COURSE_START = 5;
        $COURSE_END   = $TOTAL_INDEX - 1;

        foreach ($rows as $row) {

            $rowValues = array_values($row->toArray());

            if (empty($rowValues[$MATRIC_INDEX]) || empty($rowValues[$NAME_INDEX])) {
                continue;
            }

            $courses = [];

            for ($i = $COURSE_START; $i <= $COURSE_END; $i++) {

                if (!isset($headers[$i])) {
                    continue;
                }

                $score = $rowValues[$i] ?? null;

                if ($score === null || $score === '') {
                    continue;
                }

                $courseCode = strtoupper(trim($headers[$i]));
                $courses[$courseCode] = (int) $score;
            }

            if (empty($courses)) {
                continue;
            }

            result::create([
                'student_id' => 1, // replace later
                'matric'     => $rowValues[$MATRIC_INDEX],
                'name'       => $rowValues[$NAME_INDEX],
                'sex'        => $rowValues[$SEX_INDEX] ?? null,
                'grp'        => $rowValues[$GRP_INDEX] ?? null,

                // 👇 JSON column
                'course'     => json_encode($courses),

                'total'      => $rowValues[$TOTAL_INDEX] ?? null,
                'average'    => $rowValues[$AVERAGE_INDEX] ?? null,
                'grade'      => $rowValues[$GRADE_INDEX] ?? null,
                'remark'     => $rowValues[$REMARK_INDEX] ?? null,

                'program'    => $this->extra['program'] ?? null,
                'school'     => $this->extra['school'] ?? null,
                'session'    => $this->extra['session'] ?? null,
                'from_date'  => $this->extra['from_date'] ?? null,
                'to_date'    => $this->extra['to_date'] ?? null,
                'user_id'  =>  auth()->user()->id ??  null  ,
                'uploaded_by' =>auth()->user()->surname .  "  " . auth()->user()->other_names   ??  null 
            ]);
        }
    }

    /*
    |------------------------------------------------------------
    | PREVENT EXCEL AUTO-NUMBER CONVERSION
    |------------------------------------------------------------
    */
    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);
            return true;
        }

        return parent::bindValue($cell, $value);
    }
}
