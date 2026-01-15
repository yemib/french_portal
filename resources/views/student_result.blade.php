     
                   <?php  if(count($result_format)  > 0) {  ?>
                      
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                    
                   <tr> 
                   <?php  foreach($result_format as $result_format){ 
	
	?>
	
	 
	
	  <th> {{ $result_format->courses }} </th>  
	
	 
	  
	<?php
	
}  ?>
     <th> Total   </th>              
     <th> Average  </th>              
     <th> Grade  </th>              
     </tr>                
                    
           
                    </thead>
                    <!----    get the result value here ---->
                    
                    
                    <tbody>
                  
           
                   
                       <tr>
                       	                  <?php  $summation =  0 ; $course_length  =  0;  foreach($result as $result){ 
	
	?>
	
	 
	
	  <td> {{ $result->courses }} </td>  
	
	 
	  
	<?php
	
	$summation  =   $result->courses  + $summation ; 
	
	$course_length++;
	
}  ?>
                   
                       	<td> <?php   if( $course_length !=  0)  {   ?>     {{  $summation   }}   <?php   }?></td>
                       	
                       	<td>  <?php   if( $course_length !=  0)  {   ?>   {{ round($summation/ $course_length, 1 )  }}    <?php  } ?></td>
                       	
                       	
                       	
                       	<td><?php   if(isset($grade->grade)) {  ?>   {{  $grade->grade }} <?php  }?> </td>
                       	    	    	
                       	
                       </tr>    
                    
                         
                                   
                    </tbody>
                </table>
                
                
                
               <?php  }  else{
	
	
	echo('No result');
} ?>