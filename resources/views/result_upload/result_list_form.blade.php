@extends('layouts.app')

@section("page_title", "Students")

@section('page_content')

   <?php 
//program model  
// school model  

use App\Http\Models\program;
use App\Http\Models\Setting;


$program  = program::get();
$school  = Setting::get();


?>
   
   
    <div class="pt-1">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card-box">
   <?php  $admin_type  =  auth()->user()->account_type ;
					
					$lead  =  'admin';
				if( $admin_type == 'super_admin' ){
					
					$lead  = 'admin';
				}else  if( $admin_type == 'supervisor'){
					
					$lead  =  'supervisor';
				} else if($admin_type == 'senior_lecturer'){
					
						$lead  = 'lecturer' ; 
					
				}	
					
					
					
					
					?>  
        
                                    
         <h4 class="m-t-0 header-title"> Fill the Form  (Result list Form ) </h4>
                   
                   
      <form  id="form_id"  action="{{ $lead }}/results/1"  method="post"   enctype="multipart/form-data">               
                        
                      <div class="form-group mb-3 col-12 col-md-12">
                    
               <label>  Select  Programs     </label>

               <select required   onChange="change_value_sub(event,'date_list', 'form_id','display_data')"  class="form-control"  name="program"  >  
                         
                         <option> </option>
                         
                          <?php     foreach($program  as $program)  {    ?>
                             
                                   
                <option   value="{{   $program->id }}"> {{   $program->title }}    </option>
                
                <?php   } ?>
                 
              </select>
              
              
					</div> 
                      
                    <?php  if($admin_type == 'super_admin'   OR  $admin_type =='senior_lecturer') {  ?>
                  
                              
                                                      
                       <div class="form-group mb-3 col-12 col-md-12">

                      <label>    Select School   </label> 
                         <select        name="school"    class="form-control">  
                              
                           <?php    foreach($school as $school ) {   ?>
                            
                             <option   value="{{   $school->id  }}">  {{   $school->school_title  }} </option>                                                           
                             
                             <?php   } ?>
                          
                             </select>                                                   
                             
					</div>                                                                                
                          <?php  } ?>
                        
                            <div class="form-group mb-3 col-12 col-md-12">
                    
      <label>  Date     </label>
          
          
           <select    id="display_data" required  name="from_date"   class="form-control"   >    
           
            <option  value="">  None  </option>
             
              </select>
            

             
              
					</div> 
                      
                      
                      <div class="form-group mb-3 col-12 col-md-12">                                                             
                      <label> Session  </label> 
                      
                     <input    required  class="form-control"  type="number"    name="session"  >  
                   
					</div>   
                                                                                                                                                                   
                                                                                                                                                                     
            <!---    place the format here   --->    
                                                                                    
                     <div class="form-group mb-3 col-12 col-md-12">                                                                                                 
                          @csrf          
                      <div class="form-group mb-3 col-12 col-md-12">                     
                     <input  class="btn btn-success"  type="submit"  value="Submit"   />                                                                          
					</div>                                                                                                           
                </div>
           
          
               </div>
        </div>
    </div>
    
      </form>
@endsection

@section("page_scripts")
    <script>
        $(document).ready(function() {
            // Default Datatable
            $('#students-table').DataTable({
                searching: false,
                lengthChange: false
            });
        }); 
    </script>
@endsection