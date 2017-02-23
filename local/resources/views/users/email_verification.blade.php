@extends('app')

@section('title', 'Email Verification')
    
@section('content')
<div class="subPages">
	<h2>Email Verification</h2>
		
		<div class="clearfix patientinfo">
				@if($verify_flag == 'success')
				<div class="emailVerifySuccMsg">
					
					Congratulations! Your email address has been verified. You may now <a href="{{URL::route('user_login')}}">Log in</a>
				</div>
				@else
				<div class="emailVerifyErrMsg">
					Sorry! we are unable to verify your email id or may be your email id  has been verified already. 
				</div>	
				@endif
		</div>	
		</div>	
			
@endsection