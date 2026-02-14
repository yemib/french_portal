@extends('layouts.app')

@section("page_title", "Make Payment")

@section('page_content')

    <div class="row pt-3">
        <div class="col-12 col-sm-4 col-md-3">
            <div class="card-box">
                <div class="student-profile-box text-center p-2">
                    <div class="avatar mb-1">
                        <img src="{{ asset(($user->avatar) ? $user->avatar : "_dashboard/assets/images/users/avatar-1.jpg") }}" class="img-fluid img-rounded img-thumbnail">

                       
                    </div>
                    <div class="mt-1">
                        <i class="mdi mdi-account-outline"></i> <b>{{ $user->full_name }} </b>
                    </div>
                    <div class="mt-1">
                        <i class="mdi mdi-tab"></i> {{ $user->student->registration_number }}
                    </div>
                    <div class="mt-1">
                        <i class="mdi mdi-book-open"></i> {{ $user->student->program->title }}
                    </div>
                    <div class="mt-1">
                        <i class="mdi mdi-book-open-variant"></i> {{ $user->student->department->title }}
                    </div>
                    <div class="mt-1">
                        Level: <b>{{ $user->student->current_session }}</b>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-8 col-md-9">
            <div class="card-header bg-dark text-white">
                You need to make your  tuition payment for the current session
            </div>
            <div class="card-box">
                <div class="alert alert-info">
                    <small>
                        <h4>Steps to make payment</h4>
                        <ol>
                            <li>Generate a new RRR number</li>
                            <li>Click on the button to Pay via Remita</li>
                            <li>Make Payment</li>
                            <li>Wait for your payment to be verified</li>
                        </ol>
                    </small>
                </div>

                <form method="POST" action="{{ route("payment.generate-rrr") }}" class="form-inline">
                    @csrf
                    
                    <div class="form-group mr-2">
                        <input type="hidden" class="form-control" name="email" placeholder="Enter your email address" required    value="great@gmail.com"/>
                    </div>
                    
                    <div class="form-group mr-2">
                       
                       <input   value="tuition"   name="payment_type"   required   type="hidden" />
                       
                      
                    </div>
                    
                    <button type="submit" class="btn btn-success">Generate RRR</button>
                    
                </form>
            </div>

            <div class="card-box">
              
            
               <form onSubmit="change_address()"  id="form_part"   method="get"  action="{{ route('check-remita-payment-status' , ['rrr']) }}"> 
               
             <div class="form-group mr-2">
                       <input  id="rrrv" style="width: 40% !important ; display: inline-block"  class="form-control"  placeholder="RRR  Number"     name="rrr"   required    />
                       
                        <button   onMouseOver="change_address()"  onClick="change_address()" type="submit" class="btn btn-success">Check Status</button>
                      
                    </div> 
				   <script>
				   function change_address(){
					   
					   //get the  input value period  okay  
					   
					  $rrr =   $('#rrrv').val();
					   
					   $('#form_part').attr('action'  ,  '/check-remita-payment-status/'+$rrr);
					   
					   
				   }
				   
				   </script>
             
               
               
               </form>
               
               
                <table class="table table-bordered">
                    <tr>
                        <th>S/N</th>
                        <th>RRR</th>
                        <th>Reason</th>
                        <th>Amount</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                    @php $i=1 @endphp
                    @foreach ($remita_payments as $remita_payment)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $remita_payment->rrr }}</td>
                            <td>{{ ucwords($remita_payment->reason) }}</td>
                            <td>₦{{ number_format($remita_payment->amount) }}</td>
                            <td>{{ $remita_payment->created_at }}</td>
                            <td>
                                @if($remita_payment->paid)
                                    <span class="text-success">Paid</span>
                                @elseif(strtolower($remita_payment->reason) == "access")
                                    <form action="https://login.remita.net/remita/ecomm/finalize.reg" name="SubmitRemitaForm" method="post">
                                        @csrf
                                        <input name="merchantId" value="3986583200" type="hidden">
                                        <input name="hash" value="{{ hash("SHA512", "3986583200".$remita_payment->rrr."S8MAX6QP") }}" type="hidden">
                                        <input name="rrr" value="{{ $remita_payment->rrr }}" type="hidden">
                                        <input name="responseurl" value="http://portal.frenchvillage.edu.ng/pay-remita" type="hidden">
                                        <button type="submit" name="submit_btn" class="btn btn-success btn-sm">Pay Via Remita</button>
                                        
                                        <a href="{{ route('check-remita-payment-status', ['rrr' => $remita_payment->rrr]) }}" class="btn btn-primary btn-sm">Check Status</a>
                                        
                                        
                                    </form>
                                @else
                                    <form action="https://login.remita.net/remita/ecomm/finalize.reg" name="SubmitRemitaForm" method="post">
                                        @csrf
                                        <input name="merchantId" value="4054002435" type="hidden">
                                        <input name="hash" value="{{ hash("SHA512", "4054002435".$remita_payment->rrr."184762") }}" type="hidden">
                                        <input name="rrr" value="{{ $remita_payment->rrr }}" type="hidden">
                                        <input name="responseurl" value="http://portal.frenchvillage.edu.ng/pay-remita" type="hidden">
                                        <button type="submit" name="submit_btn" class="btn btn-success btn-sm">Pay Via Remita</button>
                                        <a href="{{ route('check-remita-payment-status', ['rrr' => $remita_payment->rrr]) }}" class="btn btn-primary btn-sm">Check Status</a>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @php $i++ @endphp
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection

@section("page_scripts")
@endsection
