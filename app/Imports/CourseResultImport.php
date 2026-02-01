<?php

namespace App\Imports;

use App\Http\Models\result;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class CourseResultImport extends \PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder
implements ToCollection, WithHeadingRow, WithCustomValueBinder
{
	protected $extra;

	public function __construct($extra)
	{
		$this->extra = $extra;
	}

	public function collection(Collection $rows)
	{
		if ($rows->isEmpty()) {
			return;
		}

		/*
        |------------------------------------------------------------
        | GET HEADERS (CORRECTLY)
        |------------------------------------------------------------
        */
		$headers = array_keys($rows->first()->toArray());
		$totalColumns = count($headers);

		if ($totalColumns < 9) {
			return;
		}

		/*
        |------------------------------------------------------------
        | FIXED COLUMN INDEXES
        |------------------------------------------------------------
        */
		$SN_INDEX      = 0;
		$MATRIC_INDEX  = 1;
		$NAME_INDEX    = 2;
		$SEX_INDEX 		= 3 ;
		$GRP_INDEX     = 4;

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

			// Convert row safely to indexed array
			$rowValues = array_values($row->toArray());

			if (
				empty($rowValues[$MATRIC_INDEX]) ||
				empty($rowValues[$NAME_INDEX])
			) {
				continue;
			}

			$matric  = $rowValues[$MATRIC_INDEX];
			$name    = $rowValues[$NAME_INDEX];
			$sex     = $rowValues[$SEX_INDEX] ?? null;
			$grp     = $rowValues[$GRP_INDEX] ?? null;
			$total   = $rowValues[$TOTAL_INDEX] ?? null;
			$average = $rowValues[$AVERAGE_INDEX] ?? null;
			$grade   = $rowValues[$GRADE_INDEX] ?? null;
			$remark  = $rowValues[$REMARK_INDEX] ?? null;

			/*
            |------------------------------------------------------------
            | LOOP COURSES
            |------------------------------------------------------------
            */
			for ($i = $COURSE_START; $i <= $COURSE_END; $i++) {

				if (!isset($headers[$i])) {
					continue;
				}

				$courseName  = strtoupper(trim($headers[$i]));
				$courseScore = $rowValues[$i] ?? null;

				if ($courseScore === null || $courseScore === '') {
					continue;
				}

				result::create([
					'student_id' => 1, // replace later
					'matric'  =>  $matric , 
					'name'    =>  $name ,
					'sex'     =>  $sex ,
					'grp'   =>  $grp ,
					'course'     => $courseName,
					'score'      => (int) $courseScore,
					'total'      => $total,
					'average'    => $average,
					'grade'      => $grade,
					'remark'     => $remark,
					'program'    => $this->extra['program'] ?? null,
					'school'     => $this->extra['school'] ?? null,
					'session'    => $this->extra['session'] ?? null,
					'from_date'  => $this->extra['from_date'] ?? null,
					'to_date'    => $this->extra['to_date'] ?? null,
				]);
			}
		}
	}

	/*
    |------------------------------------------------------------
    | ENSURE NUMBERS ARE NOT AUTO-CONVERTED
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
