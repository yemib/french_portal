<div  id="alertcon"   style="width: 50%; position: fixed ; background: rgba(245,82,8,1.00); bottom:0px ; padding: 20px; z-index: 9670000000009999999999; font-weight: bolder; display: none;color: rgba(255,255,255,1.00)"> 
thanjs
</div>

<script>
function  alertcon(str,x){
					$('#alertcon').show();
				$('#alertcon').html(str);
				
				setTimeout(function(){$('#alertcon').hide(500);},x);
				
				
			}  </script>