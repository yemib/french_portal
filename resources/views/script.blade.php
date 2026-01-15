<script>	
	
	function  send_landing_page(event,to, form_id,display_data){
//animation
		
 event.preventDefault();
$.ajax({  
  url:to,  
  method:"POST",  
  data:$('#'+form_id).serialize(),  
  success:function(data)  
  {    
	 $('#'+display_data).html(data);
	 
	  
  }  
}).fail(function(status) {
    alertcon('Network Problem', 8000);
  });  

}	
	
	
	function  change_value_sub(event,to, form_id,display_data){
//animation
$('#'+display_data).html('<option>Loading......</option>' );
		
 event.preventDefault();
$.ajax({  
  url:to,  
  method:"POST",  
  data:$('#'+form_id).serialize(),  
  success:function(data)  
  {    
	 $('#'+display_data).html(data);
	
	 //   stop animation 
	  
  }  
}).fail(function(status) {
    alertcon('Network Problem', 8000);
  });  

}	
		
	
	
	
	
	
	
	
	
	function  change_password_email(event,to, form_id,display_data){
		
		event.preventDefault();
//animation
$('#'+display_data).val('Loading...' );
$('#'+display_data).attr('disabled' ,'disabled');
	//disble  the button

$.ajax({  
  url:to,  
  method:"POST",  
  data:$('#'+form_id).serialize(),  
  success:function(data)  
  {    
	   $('#display_output').html(data);
	  
	 
	  $('#'+display_data).val('Request Reset');
	   $('#'+display_data).removeAttr('disabled');
	
	 //   stop animation 
  }  
}).fail(function(status) {
    alertcon('Network Problem' , 8000);
	
	 $('#'+display_data).val('Request Reset');
	   $('#'+display_data).removeAttr('disabled');
  });  

}	
	
	
	
	
	
	
	
	
	function  email_subsribe(event,to,  form_id,display_data  ){
//animation
		 event.preventDefault();
$('#'+display_data).html('Sending...' );

$.ajax({  
  url:to,  
  method:"POST",  
  data:$('#'+form_id).serialize(),  
  success:function(data)  
  {    
	  $('#'+display_data).html('Email  Sent');
	  setTimeout(function(){ $('#'+display_data).html('Subscribe'); }  , 1000);
	alertcon('Email Sent' , 3000);
	 //   stop animation 
	  
  }  
}).fail(function(status) {
    alertcon('Network Problem',8000);
  });  

}	
	
	

	   
	function  get_ajax(path_here){  
	
	$.ajax({
        type: 'get',
        dataType: 'html',
        url:  path_here,
        data: "qty=" + newqty + "& rowId=" + rowId + "& proId=" + proId,
        success: function (response) {
            console.log(response);
            $('#updateDiv').html(response);
        }
    }).fail(function(status) {
    alertcon('Network Problem', 8000);
  });
	
	}
	
	
	
	
	
	
	
	// read image 
	
		function previewImages() {
	
 var $preview = $('#preview');
					
			
			$preview.show();

  if (this.files) $.each(this.files, readAndPreview);

  function readAndPreview(i, file) {
    
    if (!/\.(jpe?g|png|gif|ico|jpeg)$/i.test(file.name)){
		
		$preview.html('');
      return alert(file.name +" is not an image");
    } // else...
        var reader = new FileReader();
	$(reader).on("load", function() {

		
	$preview.css( 'background-image'  , 'url('+this.result+')');
	//auotmatically load the image 
	
		
	});
	
    reader.readAsDataURL(file);
    
  }

}
	
	
	
	
	// sub image 
	
	
	
	
	
		function subImages() {
	
 var $preview = $('#sub_preview');
			
			
$preview.show();
$preview.html('');			
			
			
  if (this.files) $.each(this.files, readAndPreview);

  function readAndPreview(i, file) {
    
    if (!/\.(jpe?g|png|gif|ico|jpeg)$/i.test(file.name)){
      return alert(file.name +" is not an image");
    } // else...
        var reader = new FileReader();
	  
	$(reader).on("load", function() {

		
	$preview.append( '<img   height="100"   style="width:40%"       src=" '+this.result+' "  /> ');
		
		
	//auotmatically load the image 
	
		
	});
	
    reader.readAsDataURL(file);
    
  }

}
	
	
	
	
	
	
	
	
	
	
	
$('#file-input').on("change", previewImages);	
	
	
$('#sub-input').on("change", subImages);	
	
	
	
	
	
	
	
	
	
	// use get function period 
	
	
	function   get_send(path  , inside_value , individual_value , v_price){
				   //$('#item').html('Loading...');
			$('#item2').html('Loading...');
		$('#'+individual_value).html('Loading...');
	
$.get( path, { sendok:'yes'})
  .done(function(data) {
  
	//$('#'+container_id).html(data);
	if(data.individual_total_delivery > 0 ){
	
	        $('#'+inside_value).html(data.increase_value);
			$('#'+individual_value).html(data.individual_total);
	
	
			$('#'+v_price).val(data.individual_total_delivery); 
	
			$('#total_value2').html(data.total);
			$('#subtotal').html(data.subtotal);
			$('#item').html(data.number_item);
			$('#item2').html(data.number_item);
	
	
	}
	
	
  }).fail(function(status) {
    alertcon('Network Problem', 8000);
  });
		
	}	
	
	
	
	
	function   saved_send(path  , individual ){
		$('#'+individual).html('saving...');		   
$.get( path, { sendok:'yes'})
  .done(function(data) {
	
  alertcon('Saved' , 3000);
	
$('#'+individual).hide(500);
	
  }).fail(function(status) {
    alertcon('Network Problem' , 8000);
  });
		
	}	
	
	
	
	function   change_state(path  , individual ){
		
	$('#'+individual).html('Loading....');		
		
$.get( path, { sendok:'yes'})
  .done(function(data) {
	
$('#'+individual).html(data);
	
  }).fail(function(status) {
    alertcon('Network Problem', 8000);
  });
		
	}
		
	
	
	
	
	
	
	function   side_cart(path){
	alertcon('Loading..........', 500000000  );
		
$.get( path, { sendok:'yes'})
  .done(function(data) {
	
	alertcon(' ', 5);
	
	$('.container_login').fadeIn();
	$('#form_contain_login').hide();
	
	$('.side_cart').show();
	$('#cart_content').html(data);
	
	
  }).fail(function(status) {
    alertcon('Network Problem', 8000);
  });
		
	}
	
	
	
	
		
	function   update_address(path){
		
$('#delivery_price_here').html('Loading....');	
		
$.get( path, { sendok:'yes'})
  .done(function(data) {
	
	
	
$('#delivery_price_here').html(data);
	
$('#delivery_price').val(data);	
	
$('#disabled_button,#disabled_button1').show();
	
var finalamount = parseInt($('#subtotalt').val()) +   parseInt( data );
	
	
	
	$('#total_value2').html(finalamount);
	
	
	
  }).fail(function(status) {
    alertcon('Network Problem', 8000);
  });
		
	}
		
	
	
	
	
	
	
	
	function   alcategory(path,picture){
		
		$('#loading_p').html('Loading......');
				   
$.get( path, { sendok:'yes'})
  .done(function(data) {
	
	
	$('#show').html(data);
	
	$('#loading_p').html('');
	
	$('#al_show_img').css('background-image' , 'url("'+picture+'")');
	
	//document.getElementById('al_show_img').style.back
	
  }).fail(function(status) {
    alertcon('Network Problem', 8000);
  });
		
	}
	
	
	
	
	
function toggle_password() {
  var x = document.getElementById("myInput");
  var toggle_button =document.getElementById("toggle_button");
  if (x.type === "password") {
    x.type = "text";
	  toggle_button.innerHTML='hide';
  } else {
    x.type = "password";
	   toggle_button.innerHTML='show';
  }
}
	
	
	// chage of prduct picture  
	
	
	function  pix_change(imag, fore){
		
		
		 $preview = $('.'+fore);
		
		$preview.css( 'background-image'  , 'url('+imag+')');
		
		
		
		
	}
	
	
	
	function  deletex(path,id){
		
		var con = confirm('Do you want to Delete ?');
		
		if(con  == true) {  
			
	$('#delete'+id).html('Loading....');
			
		$.get( path, { sendok:'yes'})
  .done(function(data) {
  
	//$('#'+container_id).html(data);

	$('#contd'+id).hide(1000);
			
alertcon('Delete   Successful' , 6000);		
			
	
  }).fail(function(status) {
    alertcon('Network Problem', 8000);
  });
		}
	}
	
	
	function feature(fea , val){
		$('#feature').show();
		
		$('#feature').append('<p   style="float: left ; width: 50% " ><br/><label> '+fea+' </label><br/><input type="hidden" contenteditable="false"  value="'+fea+'"   name="fea[]" />:<input size="5"   placeholder="'+fea+'" value="'+val+'"  name="val[]" /></p>');
		
	}
	
	
	
	
	

	function  upoad_course(event,upload_form,progress_id ,file_id1,file_id2, message_id,  direction_pathzz , addind_content){

	 $('#'+message_id).hide();
		   
        
		   
		$('#'+addind_content).hide(); 
		   	
		
	$('.loading').html('loading.....');
	var loaded  = 0 ;
		
$('#submit').attr('type' , 'text'); 

$('#submit').attr('disabled' ,'disabled');

	$('#submit').val('Uploading....');	
		
 var myForm = document.getElementById(upload_form);
        event.preventDefault();
		
		
 var  xhrt =  $.ajax({
       url:direction_pathzz,
       xhr: function() { // custom xhr (is the best)
    
    var xhr = new XMLHttpRequest();
    var total = 0;
	var loaded = 0;
    
    // Get the total size of files
		   
		  
    $.each(document.getElementById(file_id1).files, function(i, file) {
           total += file.size;
    });
		   
$.each(document.getElementById(file_id2).files, function(i, file) {
           total += file.size;
    });
		   
		   
    
    // Called when upload progress changes. xhr2
    xhr.upload.addEventListener("progress", function(evt) {
           // show progress like example
		
           var loaded = (evt.loaded/total).toFixed(2)*100; // percent
    
           $('#'+progress_id).text('Uploading... ' + loaded + '%' );
    }, false);
    
xhr.upload.addEventListener("error", function(evt){
	
	
	$('#'+progress_id).html('<span  style="color:red"  > Error Occur.  Upload Stopped</span>');
	
	alertcon('Error Occur.  Upload Stopped', 8000);
	
	$('#submit').attr('type' , 'submit'); 
	$('#submit').removeAttr('disabled'); 
	
 $('#submit').val('Submit');
} );
		   
    return xhr;
    },
       method:"POST",
       data: new FormData(myForm)  , // $('#upload_form').serialize()
       dataType:'JSON',
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
		   
		   
		   $('.loading').html(' ');
		   
	var addcontent =	 data.content_display;
		   
		   	 $('#'+message_id).show();
		   
        
		   
		$('#'+addind_content).show(); 
		   
        $('#'+message_id).css('display', 'block');
		   
        $('#'+message_id).html(data.message);
		   
        $('#'+message_id).addClass(data.class_name);
		   
		$('#'+addind_content).html(addcontent); 
		   
        
		     $('#submit').val('Save');
		   
		   	$('#submit').attr('type' , 'submit');
		   	$('#submit').removeAttr('disabled');
		   
		 
		  
		   
		   if(data.message == 'Upload Successfully'){ 
			   
			   $('#preview,#sub_preview').hide();
			   
		     $('#'+upload_form)[0].reset(); 
			   
			   
		   }
		   
		   
		   
		  
 
		   
       }
	 
	

	 
      })


}

	
	
	
	
	
	
	
	
	function  profileupdate(event, to, upload_form,display_data){
 $('#'+display_data).html('Loading....');
$('#submit').attr('disabled'  , 'disabled');
	 	
		
 var myForm = document.getElementById(upload_form);
        event.preventDefault();
		
		
 var  xhrt =  $.ajax({
       url:to,
       xhr: function() { // custom xhr (is the best)
    
    var xhr = new XMLHttpRequest();
    var total = 0;
	var loaded = 0;
    
    // Get the total size of files
    
xhr.upload.addEventListener("error", function(evt){
	
	alertcon('Network Problem', 8000);
	  $('#submit').removeAttr('disabled'); 
	$('#'+display_data).html('');

} );
		   
    return xhr;
    },
       method:"POST",
       data: new FormData(myForm)  , // $('#upload_form').serialize()
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
		   
		   
		   
			 $('#'+display_data).html(data);
	 
	  $('#submit').removeAttr('disabled');   
 
		   
       }
	 
	

	 
      })


}

	
	function  showme()  {
		 var  option_val =	 $('#selectco').val();
			
			var option_country =  $('#selectco option[value='+option_val+']').html()
			
			
			if(  option_val !='none'){
			
			$('#option_code').val(option_val);
			$('#country').val(option_country);
			
			}
			if(option_country  != 'Nigeria'){
				
				$('#extra_country_val').hide();
				$('#extra_country_val  input').removeAttr('required');
				
				
				
			}else{
				$('#extra_country_val').show();
				$('#extra_country_val  input').attr('required'  , 'required');
				
				
			}
			
		}
	
	
</script>



