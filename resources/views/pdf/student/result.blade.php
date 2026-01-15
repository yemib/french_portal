@extends("pdf.pdf_overall")

@section("pdf_title", $student->user->full_name." Course Results for level ". $session)

@section("pdf_content")
  
      <?php 
//

use App\Http\Models\results_format;
use App\Http\Models\result;

						$result_format = results_format::where('program_id' ,  $student->program->id  )->where('session'  ,  $session )->get();
						
						$result = result::where('program_id' , $student->program->id  )->where('session'  ,  $session)->where('matric',$student->registration_number )->get();
						
						$grade = result::where('program_id' , $student->program->id  )->where('session'  ,  $session)->where('matric',$student->registration_number )->first();
						
						?>
                   
   
   
   
   
   @include('student_result')
   
   
   
    
    
    
@endsection