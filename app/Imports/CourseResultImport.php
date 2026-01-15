<?php

namespace App\Imports;

use App\Http\Models\result;
use App\Http\Models\results_format;
use App\Http\Models\program;
use App\Http\Models\setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;



class CourseResultImport implements ToModel
{
	protected $extra_array;

	protected $x;

	public function __construct($extra_array)
	{
		$this->extra_array = $extra_array;

		$this->x = 0;
	}

	/**
	 * @param array $row
	 *
	 * @return Model|Model[]|null
	 */
	public function model(array $row)
	{


		$total_column = 	count($row);

		// constant values  
		$program = program::find($this->extra_array["program"]);



		$school   =  setting::find($this->extra_array["school"]);



		$known_column_total =  3 + 4;

		$leght_of_course = $total_column  - $known_column_total;



		$leght_of_last_col =   $leght_of_course  +  3;

		//$starting_value_of_d_lastcolum =   $leght_of_course + 1 ; 



		if (!is_string($row[0])) {



			$result  = new result();


			for ($x = 0; $x <   $leght_of_course; $x++) {



				$result  = new result();



				$result->matric = $row[1];
				$result->name = $row[2];


				$result->from_date  =  $this->extra_array["from_date"];


				$result->to_date  =  $this->extra_array["to_date"];


				$result->program  = $program->title;

				$result->school = $school->school_title;

				$result->program_id = $this->extra_array["program"];

				$result->school_id = $this->extra_array["school"];

				$result->session = $this->extra_array["session"];




				// changing values  




				$result->courses = $row[3 +   $x];


				$result->total = $row[($leght_of_last_col)];
				$result->average = $row[($leght_of_last_col + 1)];


				$result->grade = (isset($row[($leght_of_last_col + 2)])) ?   $row[($leght_of_last_col + 2)]  : '    ';



				$result->remark = (isset($row[($leght_of_last_col + 3)])) ? $row[($leght_of_last_col + 3)]  :  '  ';

				$result->save();
			}



			return $result;
		}

		if (is_string($row[0])) {

			for ($x = 0; $x <   $leght_of_course; $x++) {

				$result_format  = new results_format();

				$result_format->matric = $row[1];
				$result_format->name = $row[2];

				$result_format->from_date  =  $this->extra_array["from_date"];

				$result_format->to_date  =  $this->extra_array["to_date"];

				$result_format->program  = $program->title;

				$result_format->school = $school->school_title;

				$result_format->program_id = $this->extra_array["program"];

				$result_format->school_id = $this->extra_array["school"];

				$result_format->session = $this->extra_array["session"];


				// changing values  


				$result_format->courses = $row[3 +   $x];
				$result_format->total = $row[($leght_of_last_col)];
				$result_format->average = $row[($leght_of_last_col + 1)];

				$result_format->grade = (isset($row[($leght_of_last_col + 2)])) ?  $row[($leght_of_last_col + 2)] : ' ';

				$result_format->remark = (isset($row[($leght_of_last_col + 3)])) ? $row[($leght_of_last_col + 3)]   : '  ';
				$result_format->save();
			}


			$this->x++;

			return $result_format;
		}




		return   null;
	}
}
