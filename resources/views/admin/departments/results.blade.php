@extends('layouts.app')

@section("page_title", "Result")

@section('page_content')

   
   <?php 


use App\Http\Models\result;


use App\Http\Models\results_format;
use App\Http\Models\program;
use App\Http\Models\setting;

$program   =  program::where('id'  ,$program_id )->first();

$school   =  setting::where('id'  ,$school_id )->first();


// get the value of the result and format  period based on from.....   


//get record for the supervisor   display .....

//supervisor school id period 



$result_extravalue  = result::where('from_date',  $from_date )->where('program_id' , $program_id )->where('school_id'   , $school_id)->where('session'  , $session  )->first();



$result  = result::where('from_date',  $from_date )->where('program_id' , $program_id )->where('school_id'   , $school_id)->where('session'  , $session  )->get();



$result_format  = results_format::where('from_date',  $from_date )->where('program_id' , $program_id )->where('school_id'   , $school_id)->where('session'  , $session  )->get();









?>
   
    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box table-responsive">
                   
                   
                    <div class="dropdown float-right">
                       <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!---
                            <a href="#" data-toggle="modal" data-target="#addNewDepartmentModal" class="dropdown-item">Add a new department</a>   --->
               
                            
                        </div>
                    </div>
                    

                    <h4 class="m-t-0 header-title">Results</h4>
                    
                    
                    
                 <p>   Date <br/> From  : {{ $from_date    }}   To :  <?php   if(isset($result_extravalue->to_date)) { 
 ?>  {{  $result_extravalue->to_date }}   <?php   }  ?>  </p> 
                    
                  <p>   Program  : <?php   if(isset($program->title))   {  echo($program->title); }  ?>    </p>    
                    
                   <p>  School  : <?php   if(isset($school->school_title))   {  echo($school->school_title); }  ?>   </p>  
                   
                   
                   <p> Session :    {{  $session }}    </p>
                    
                    
                    
                    
           <div  align="right"> 
                  
                  
                   <?php if(auth()->user()->account_type  == 'super_admin'  OR  auth()->user()->account_type  == 'senior_lecturer') {   ?>
                    
                    
                    <!-- <button   class="btn btn-primary"> Download Result  </button> -->
                    
                  
                    
                     <button  id="delete1"   onClick="deletex('/delete_cousrse/{{$from_date}}/{{$program_id }}/{{ $school_id }}/{{ $session }}',1)"  class="btn btn-danger">  Delete  </button> 
                     
                     
                     <?php  } ?>
                     
                        <br/>
                        <br/>
                              </div>     
                    
                    
                    
                    
                    
                    <table class="table mb-0" id="contd1">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            
                            <th>No. d'Inscrp.(Matric No)  result </th>
                            
                            <th>NOMS ET PRENOMS(Full Name)</th>
                            
                          <!---  <th>SEX</th>   --->
                           
                           
                            @foreach ($result_format as $course)
                                <th>
                                    {{ $course->courses }}
                                </th>
                            @endforeach
                            
                            
                            
                            <th>TOTAL</th>
                            
                            
                            <th>AVERAGE</th>
                            
                            
                            <th>GRADE</th>
                            
                            
                            <th>REMARK</th>
                           
                            
                            
                            
                            <!---
                            <th>GRADE</th>
                            <th class="">REMARK</th>    ---->
                            
                            
                        </tr>
                        </thead>
                        <tbody   id="delete_table">
                        
                      
                     <?php 
							$i  =  1;
				$matric   = array();
			$name    = array();
        $total  = array();
        $average  = array();
         $grade  = array();

         $remark   = array();
  

							foreach($result as  $result)   {  
								
								if( !in_array($result['matric'], $matric)){
				
	
?>
  
  <tr>  
 <td scope="row">{{ $i }}</td>
    
<td><?php  
  			if( !in_array($result['matric'], $matric)){
				
				
				echo($result['matric']);
			}
			               
            ?>                    
                                  </td>
                                
                  
                                
<td><?php  
  			if( !in_array($result['name'], $name)){
				
				?>
				
				
				<?php
				
			
				echo($result['name']);
			}
			               
            ?>                    
                                  </td>
                             
                               
                                
          <?php  
								
	$course_score  = result::where('matric' , $result['matric'])->where('session',  $session )->where('program_id' , $program_id)->where('from_date'  ,  $from_date )->get();
								
								foreach($course_score  as  $course_score ){   ?>  
                                    
                                    <td>
                                    {{  $course_score->courses    }}
                                    </td>
                               
                                           
                                  <?php   }?>
                                  
                                  
                               <?php  
								$summation  =  0  ;
									
            $couse_total  =  result::where('matric' , $result['matric'])->where('session',  $session )->where('program_id' , $program_id)->where('from_date'  ,  $from_date )->get();  
           $couse_total2  =  result::where('matric' , $result['matric'])->where('session',  $session )->where('program_id' , $program_id)->where('from_date'  ,  $from_date )->count();  
									
									
									$count_total_course  =  0  ;
								foreach($couse_total as $couse_total ){
									$summation  = $couse_total['courses']  + $summation ;
									
									$count_total_course++;
								}
								?>
								
								<td> {{  $summation }}  </td>
								<?php
							 
									
									$total_count_cours = $couse_total2 ;
								
								$average  =  $summation  / $count_total_course  ;
								
								
	  
	  
	  ?>
             
                           <td>     <?php    echo(  round($average, 1)  ) ;  
							   
							   $summation  =  0   ; 
								 $average  =  0  ;  
								
							   ?> </td>    
                               
                               
                        <td>  <?php  
  		
				
				
				echo($result['grade']);
	
			               
            ?>   </td>       
                        <td>
                              <?php  
  		
				echo($result['remark']);
			
			               
            ?>  
                                </td>       
                               
                                

</tr>

<?php

array_push( $matric ,  $result['matric']);
array_push( $name ,  $result['name']);
array_push( $grade ,  $result['grade']);
array_push( $remark ,  $result['remark']);
                
	$i++ ; 							
}} ?>
                    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("page_scripts")
    <script>
        //$("#addNewDepartmentModal").modal("show");

        $(document).ready(function() {
            // Default Datatable
            $('#results-table').DataTable({
                searching: true,
                lengthChange: true
            });
        });
    </script>
@endsection
