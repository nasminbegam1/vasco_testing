@extends('app')

@section('title', 'Edit profile')
    
@section('content')
    
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-2">
				<ul>
					<li>{{ Html::link('dashboard', 'Dashboard',array('class' => Helpers::isActiveRoute('dashboard')))}}</li>
					<li>{{ Html::link(route('edit_profile'), 'Edit Profile',array('class' => Helpers::isActiveRoute('edit_profile')))}}</li>
					<!--<li>{{ Html::link(route('edit_billing'), 'Edit Billing',array('class' => Helpers::isActiveRoute('edit_billing')))}}</li>-->
					<li>{{ Html::link(route('change_password'), 'Password Change',array('class' => Helpers::isActiveRoute('change_password')))}}</li>
					<li>{{ Html::link(route('logout'), 'Logout')}}</li>	
				</ul>
			</div>
<div class="col-lg-10">
				<h2>Edit Profile</h2>
				
				@if (count($errors) > 0) 
					    <div class="alert alert-danger">
					    <ul>
						    @foreach ($errors->all() as $error)
							    <li>{{ $error }}</li>
						    @endforeach
					    </ul>
					    </div>
					@endif
					@if(Session::has('success'))
						<div class="alert alert-success">
							<ul>
								<li>{{Session::get('success') }}</li>
							</ul>
						</div>
					@endif
															<h3>Patient Information</h3>
				    <form novalidate="novalidate" id="userEdit" accept-charset="UTF-8" action="http://vasco.dedicatedresource.net/user_edit_action" method="POST"><input type="hidden" value="9xWSdgxDHQEGyeDc007O0Aik2qvUJy0fzZvGH45z" name="_token">
				    <div class="form-group">
				       <label for="name">Patient Name:</label>
				       <input type="text" value="John Smith" name="name" required="required" class="form-control" placeholder="Name">
				    </div>
				     <div class="form-group">
				      <label for="email">Email address:</label>
				      <input type="email" value="johnsmith@gmail.com" name="email" readonly="readonly" required="required" class="form-control" placeholder="Email address">
				    </div>
				    <div class="form-group">
				      <label for="dob">Patient Date Of Birth:</label>
					{{--*/ $year = date('Y') /*--}}
					{!! Form::selectRange('date','1','31',date('j')) !!}
					{!! Form::selectMonth('month',date('m')) !!}
					{!! Form::selectYear('year', $year - 80, $year,date('Y')) !!}
				    </div>
				    <div class="form-group">
				      <label for="gender">Patient Gender:</label>
				      
				      {!! Form::select('gender',[''=>'Select Gender','Male'=>'Male','Female'=>'Female'], $user_details->gender, array('class'=>'form-control')) !!}
					
				    </div>	
				    <div class="form-group">
				      <label for="address">Address:</label>
				      {!! Form::text('address', $user_details->address, array('class'=>'form-control homeAddress','placeholder' => 'Address')) !!}
				    </div>
				
				    <div class="form-group">
				      <label for="state">State:</label>
				       {!! Form::select('state',$state, $user_details->state_id, array('class'=>'form-control homeState select_state')) !!}

				    </div>
					
				   <div class="form-group">
				      <label for="state">City:</label>
				      {!! Form::select('city', array(''=> 'Select City'),'',array('class'=>'form-control homeCity get_city')) !!}
				    </div>
					
				     <div class="form-group">
				      <label for="zip">Zip:</label>
				      {!! Form::text('zip', $user_details->zip,array('class'=>'form-control homeZip','placeholder' => 'Zip')) !!}
				    </div>
				    
				    <div class="form-group">
				      <label for="phone_home">Patient Phone (Home):</label>
				      {!! Form::text('phone_home', $user_details->phone_home, array('class'=>'form-control','placeholder' => 'Home Phone No.')) !!}
				    </div>
				    <div class="form-group">
				      <label for="phone_mobile">Patient Phone (Cell).:</label>
				      {!! Form::text('phone_mobile', $user_details->phone_mobile, array('class'=>'form-control', 'placeholder' => 'Mobile Number')) !!}
				    </div>
				    <div class="form-group">
				      <label for="is_minor">Is this patient a minor?:</label>
					 {!! Form::select('is_minor', array(''=> 'Select any one', 'Yes'=>'Yes','No'=>'No'), $user_details->is_minor, array('class'=>'form-control is_minor')) !!}
				    </div>
				    <div style="display:none;" class="form-group contact_name">
				       <label for="contact_name">Contact Name:</label>
				       {!! Form::text('contact_name', $user_details->contact_name, array('class'=>'form-control', 'placeholder' => 'Contact Name')) !!}
				    </div>	
				    
				    <div class="form-group">
					<label for="is_pet">Is pet?:</label>
					{!! Form::select('is_pet',[''=>'Select any one','Yes'=>'Yes','No'=>'No'], $user_details->is_pet, array('class'=>'form-control is_pet')) !!}
				    </div>
				    
				    <div class="form-group pet_type_view" style="display:none;">
					<label for="pet_type">Pet Type:</label>
					{!! Form::select('pet_type',['Canine'=>'Canine','Feline'=>'Feline','Other'=>'Other'],'',array('class'=>'form-control pet_type')) !!}
				    </div>
				    
				    <div class="form-group pet_type_value" style="display:none;">
					<label for="pet_type">Pet Type:</label>
					{!! Form::text('pet_type_value','',array('class'=>'form-control','placeholder' => 'Enter Pet Type')) !!}
				    </div>
					
				    <h3>Billing Information</h3>
					<label><input type="checkbox" value="yes" name="copyAddress" class="copyAddress"> Same as above</label>
				    
				    <div class="form-group">
				      <label for="billing_address">Address:</label>
				      {!! Form::text('billing_address', $user_details->billing_address, array('placeholder'=>'Billing Address','class'=>'form-control')) !!}
				    </div>
				
				    <div class="form-group">
				      <label for="billing_state">State:</label>
				      {!! Form::select('billing_state',$state, $user_details->billing_state_id, array('class'=>'form-control billingState')) !!}				      
				    </div>
					
				    <div class="form-group">
				      <label for="billing_city">City:</label>
				      {!! Form::select('billing_city', array(''=> 'Select City'),'',array('class'=>'form-control billingCity')) !!}
				    </div>
					
				     <div class="form-group">
				      <label for="billing_zip">Zip:</label>
				      
				      {!! Form::text('billing_zip', $user_details->billing_zip,array('placeholder'=>'Billing Zip','class'=>'form-control billingZip')) !!}
				    </div>
				    
				    
				    <div class="form-group">
				       <label for="first_name">Credit Card Number:</label>
				    {!! Form::text('credit_card','xxxxxxxxxxxx'.$user_details->credit_card,array('placeholder'=>'Credit Card Number','class'=>'form-control')) !!}
				    </div>
					
				    <div class="form-group">
				    <label for="last_name">Expiry Date:</label>
				    {!! Form::selectMonth('exp_month',date('m',strtotime($user_details->expiry_date))) !!}
				      {!! Form::selectYear('exp_year',  date('Y') + 20, date('Y'),$user_details->expiry_date?date('Y',strtotime($user_details->expiry_date)):date('Y')) !!}
				    </div>
					
				    <div class="form-group">
				    <label for="last_name">CVV:</label>
				    {!! Form::text('cvv',$user_details->cvv, array('placeholder'=>'CVV','class'=>'form-control')) !!}
				    </div>
					
				    <!--<div class="form-group">
				      <label for="email">Home address:</label>
				      <textarea class="form-control homeAddress" name="home_address" cols="50" rows="10"></textarea>
				    </div>
					
				     <div class="form-group">
				      <label for="email">Billing address:</label>
					  <label><input class="copyAddress" name="copyAddress" type="checkbox" value="yes"> Same as home address</label>
				      <textarea class="form-control billingAddress" name="billing_address" cols="50" rows="10">hgh</textarea>
				    </div>-->
				    
				
						
				    <h3>Emergency Contact Information</h3>	
				    <div class="form-group">
				      <label for="emergency_contact_name">Name:</label>
				      {!! Form::text('emergency_contact_name',$user_details->emergency_contact_name, array('placeholder'=>'Name','class'=>'form-control')) !!}
				      
				    </div>
				    <div class="form-group">
				      <label for="emergency_contact_number">Phone Number:</label>
				      {!! Form::text('emergency_contact_number',$user_details->emergency_contact_number, array('placeholder'=>'Emergency Contact Number','class'=>'form-control')) !!}
				    </div>
				    <div class="form-group">
				      <label for="relationship">Relationship to Patient:</label>
				      {!! Form::text('relationship',$user_details->relationship, array('placeholder'=>'Relationship to Patient','class'=>'form-control')) !!}
				    </div>
					
				    
				    
				    <input type="submit" value="Submit" class="btn btn-default">
				    </form>
			</div>		</div>
	</div>
    
	<script>
		
		$(function(){
			$('.homeAddress, .homeZip').keyup(function(){
				if($('.copyAddress').is(':checked')){
					$('.billingAddress').val($('.homeAddress').val());
					$('.billingZip').val($('.homeZip').val());
				}
			});
			
			$('.homeAddress, .homeZip').keydown(function(){
				if($('.copyAddress').is(':checked')){
					$('.billingAddress').val($('.homeAddress').val());
					$('.billingZip').val($('.homeZip').val());
				}
			});
			
			$('.homeState').change(function(){
				if($('.copyAddress').is(':checked')){
				        
					$(".billingState option:selected").remove();
					var selected_val = $('.homeState').val();
					$('.billingState option[value='+selected_val+']').attr('selected',true);
					var cityid = $('.homeCity').val();
					SelectedCity(selected_val,cityid);
				}
			});
			
			$('.homeCity').change(function(){
				if($('.copyAddress').is(':checked')){
				
				
					$(".billingCity option:selected").remove();
					var selected_cty = $('.homeCity').val();
					alert(selected_cty);
					$('.billingCity option[value='+selected_cty+']').attr('selected',true);
					//$('.billingCity').val($('.homeCity').val());
				}
			});
			
			$('.copyAddress').on('click',function(){
		
				if ($(this).is(':checked')) {
					$('.billingAddress').val($('.homeAddress').val());
					$(".billingState option:selected").remove();
					var selected_val = $('.homeState').val();
					$('.billingState option[value='+selected_val+']').attr('selected',true);
					var cityid = $('.homeCity').val();
					SelectedCity(selected_val,cityid);
					$('.billingZip').val($('.homeZip').val());
				}else{
					$('.billingAddress').val('');
					$('.billingState').val('');
					$('.billingCity').val('');
					$('.billingZip').val('');
				}
			});
			
		})
		
	</script>
		
	
	
    
@endsection