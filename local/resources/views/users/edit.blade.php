@extends('app')

@section('title', 'Edit profile')
    
@section('content')
    
	<div class="row">        
	  
	  
	  
	  <div class="col-lg-12 right-align">
	     <span class="username">{{$user_details->name}}</span>
	     <div class="logout2">{{ Html::link(route('logout'), 'Logout')}}</div>
	      <div class="dash-btn" href="javascript:void(0)"><span>Edit Profile and Billing</span>		
		<ul class="dropdown">
		  <li>{{ Html::link('dashboard', 'Dashboard',array('class' => Helpers::isActiveRoute('dashboard')))}}</li>
		  <li>{{ Html::link(route('edit_profile'), 'Edit Profile and Billing',array('class' => Helpers::isActiveRoute('edit_profile')))}}</li>
		  <li>{{ Html::link(route('change_password'), 'Password Change',array('class' => Helpers::isActiveRoute('change_password')))}}</li>		  
		</ul>
	      </div>
		
	    </div>
	    <div class="col-lg-12">
			     <!-- <h2>Edit Profile</h2>-->
			      
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
				      
				      <div class="clearfix"></div>
                                      {!! Form::open(array('route'=>'user_edit_action','id' => 'userEdit','novalidate'=>'novalidate')) !!}
                                      <p>Those items marked with a (<span class="asterisk">*</span>) are requied fields</p>
				      <h3 class="heading">Patient Information</h3>
					<div class="clearfix">
					
                    <div class="field_div">
                    
					<div class="form-group">
				       <label for="name">First Name <span class="asterisk">*</span></label>
				       {!! Form::text('first_name', $user_details->first_name, array('class'=>'form-control required','placeholder' => 'Name')) !!}
				       
				    </div>
					<div class="form-group">
				       <label for="name">Last Name <span class="asterisk">*</span></label>
				       {!! Form::text('last_name', $user_details->last_name, array('class'=>'form-control required','placeholder' => 'Name')) !!}
				       
				    </div>
					  
				     <div class="form-group">
				      <label for="email">Email address</label>
				       {!! Form::text('email', $user_details->email, array('class'=>'form-control','placeholder' => 'Name','readonly'=>'true')) !!}
				    </div>
                                    </div>    
				    <div class="form-group">
				      <label for="dob">Patient Date Of Birth <span class="asterisk">*</span></label>
					{{--*/ $year = date('Y');
						$get_data = explode('-',$user_details->date_of_birth);
						$get_year = $get_data[0];
						$get_month = $get_data[1];
						$get_date = $get_data[2];
					/*--}}
					{!! Form::selectMonth('month',$get_month) !!}
                                        {!! Form::selectRange('date','1','31',$get_date) !!}
					{!! Form::selectYear('year', $year - 80, $year,$get_year) !!}
				    </div>	
				    
				    <div class="form-group">
				      <label for="gender">Patient Gender <span class="asterisk">*</span></label>
				      
				      {!! Form::select('gender',[''=>'Select Gender','Male'=>'Male','Female'=>'Female'], $user_details->gender, array('class'=>'form-control required')) !!}
					
				    </div>
				   
					
				   
					
				    
				    
				    <div class="form-group">
				      <label for="phone_home">Patient Phone (Home) <span class="asterisk">*</span></label>
				      {!! Form::text('phone_home', $user_details->phone_home, array('class'=>'form-control required','placeholder' => 'Home Phone No.')) !!}
				    </div>
				    <div class="form-group">
				      <label for="phone_mobile">Patient Phone (Cell) <span class="asterisk">*</span></label>
				      {!! Form::text('phone_mobile', $user_details->phone_mobile, array('class'=>'form-control required', 'placeholder' => 'Mobile Number')) !!}
				    </div>
				    <div class="form-group">
				      <label for="is_minor">Is this patient a minor?</label>
					 {!! Form::select('is_minor', array(''=> 'Choose your selection...', 'Yes'=>'Yes','No'=>'No'), $user_details->is_minor, array('class'=>'form-control is_minor')) !!}
				    </div>
					
				
				    <div {{ $user_details->is_minor === 'Yes' ? '':'style=display:none' }} class="form-group contact_name">
				       <label for="contact_name">Contact Name:</label>
				       {!! Form::text('contact_name', $user_details->contact_name, array('class'=>'form-control', 'placeholder' => 'Contact Name' ,'id'=>'user_contact_name')) !!}
				    </div>	
				    
				    <div class="form-group">
					<label for="is_pet">Is pet?</label>
					{!! Form::select('is_pet',[''=>'Choose your selection...','Yes'=>'Yes','No'=>'No'], $user_details->is_pet, array('class'=>'form-control is_pet')) !!}
				    </div>
				    @if($user_details->is_pet == 'Yes')
					{{--*/ $pet_type = $user_details->pet_type /*--}}
					@if($pet_type != 'Canine' && $pet_type != 'Feline')
					{{--*/ $pet_type = 'Other'/*--}}
					@endif
                                     @else
                                      {{--*/$pet_type=''/*--}}
                                     @endif    
					<div class="form-group pet_type_view">
					<label for="pet_type">Pet Type</label>
					{!! Form::select('pet_type',['Canine'=>'Canine','Feline'=>'Feline','Other'=>'Other'],$pet_type,array('class'=>'form-control pet_type')) !!}
                                        </div>
					
				    <div class="form-group pet_type_value">
					<label for="pet_type">Pet Type</label>
					{!! Form::text('pet_type_value',$user_details->pet_type,array('class'=>'form-control','placeholder' => 'Enter Pet Type')) !!}
				    </div>
                                       
				</div>	
				<h3 class="heading">Address Information</h3>
				<div class="clearfix billinginfo">
						<div class="form-group">
								<label for="address">Address <span class="asterisk">*</span></label>
								{!! Form::text('address', $user_details->address, array('class'=>'form-control homeAddress required','placeholder' => 'Address')) !!}
						</div>
						<div class="form-group">
								<label for="state">City <span class="asterisk">*</span></label>
								{!! Form::text('city',$user_details->city_id,array('class'=>'form-control homeCity required','placeholder'=>'City')) !!}
						</div>
						<div class="form-group">
								<label for="state">State <span class="asterisk">*</span></label>
								{!! Form::select('state',$state, $user_details->state_id, array('class'=>'form-control homeState required')) !!}
						</div>
						<div class="form-group">
								<label for="zip">Zip <span class="asterisk">*</span></label>
								{!! Form::text('zip', $user_details->zip,array('class'=>'form-control homeZip required','placeholder' => 'Zip')) !!}
						</div>
				</div>
				  
				  <br />
				  <h3 class="heading">Billing Information
				   <label><input type="checkbox" value="Yes" name="copyAddress" class="copyAddress" @if($user_details->is_same_above=='Yes') checked @endif> Same as above</label>
				  </h3>
					<div class="clearfix billinginfo">				    
				  
				  
				  <div class="form-group">
				    <label for="billing_address">Address <span class="asterisk">*</span></label>
				    {!! Form::text('billing_address', $user_details->billing_address, array('placeholder'=>'Billing Address','class'=>'form-control billingAddress required')) !!}
				  </div>
			      
					<div class="form-group">
				    <label for="billing_city">City <span class="asterisk">*</span></label>
				    {!! Form::text('billing_city',$user_details->billing_city_id,array('class'=>'form-control billingCity required','placeholder'=>'City')) !!}
				  </div>	
						
						
				  <div class="form-group">
				    <label for="billing_state">State <span class="asterisk">*</span></label>
				    {!! Form::select('billing_state',$state, $user_details->billing_state_id, array('class'=>'form-control billingStates required')) !!}				      
				  </div>
				      
				  
				      
				   <div class="form-group">
				    <label for="billing_zip">Zip <span class="asterisk">*</span></label>
				    
				    {!! Form::text('billing_zip', $user_details->billing_zip,array('placeholder'=>'Billing Zip','class'=>'form-control billingZip required')) !!}
				  </div>
				  
				  
				  <div class="form-group">
				     <label for="first_name">Credit Card Number</label>
				  {!! Form::text('credit_card','xxxxxxxxxxxx'.$user_details->credit_card,array('placeholder'=>'Credit Card Number','class'=>'form-control')) !!}
				  </div>
				      
				  <div class="form-group">
				  <label for="last_name">Expiry Date</label>
				  {!! Form::selectMonth('exp_month',date('m',strtotime($user_details->expiry_date)),array('style'=>'width:auto !important')) !!}
				    {!! Form::selectYear('exp_year',  date('Y') + 20, date('Y'),$user_details->expiry_date?date('Y',strtotime($user_details->expiry_date)):date('Y'),array('style'=>'width:auto !important')) !!}
				  </div>
				      
				  <div class="form-group">
				  <label for="last_name">CVV</label>
				  {!! Form::text('cvv',$user_details->cvv, array('placeholder'=>'CVV','class'=>'form-control')) !!}
				  </div>
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
				  
			      
					      
				  <h3 class="heading">Emergency Contact Information</h3>
					<div class="clearfix billinginfo">
				  <div class="form-group">
				    <label for="emergency_contact_name">Name</label>
				    {!! Form::text('emergency_contact_name',$user_details->emergency_contact_name, array('placeholder'=>'Name','class'=>'form-control')) !!}
				    
				  </div>
				  <div class="form-group">
				    <label for="emergency_contact_number">Phone Number</label>
				    {!! Form::text('emergency_contact_number',$user_details->emergency_contact_number, array('placeholder'=>'Emergency Contact Number','class'=>'form-control')) !!}
				  </div>
				  <div class="form-group">
				    <label for="relationship">Relationship to Patient</label>
				    {!! Form::text('relationship',$user_details->relationship, array('placeholder'=>'Relationship to Patient','class'=>'form-control')) !!}
				  </div>
				</div>      
				  
				  
				  <input type="submit" value="Submit" class="btn btn-default addMedication">
				  </form>
	  </div>		
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
				        
					$(".billingStates option:selected").remove();
					var selected_val = $('.homeState').val();
					$('.billingStates option[value='+selected_val+']').attr('selected',true);
					$('.billingCity').val($('.homeCity').val());
				}
			});
			
			$('.homeCity').change(function(){
				if($('.copyAddress').is(':checked')){
				
					//$(".billingCity option:selected").remove();
					//var selected_cty = $('.homeCity').val();
					$('.billingCity').val($('.homeCity').val());
					//$('.billingCity option[value='+selected_cty+']').attr('selected',true);
					//$('.billingCity').val($('.homeCity').val());
				}
			});
			
			$('.copyAddress').on('click',function(){
				
				if ($(this).is(':checked')) {
					$('.billingAddress').val($('.homeAddress').val());
					$(".billingStates").find('option').removeAttr("selected");
					var selected_val = $('.homeState').val();
					//alert(selected_val);
					$('.billingStates option[value='+selected_val+']').prop('selected',true);
					var cityid = $('.homeCity').val();
					$('.billingCity').val($('.homeCity').val());
					//SelectedCity(selected_val,cityid);
					$('.billingZip').val($('.homeZip').val());
				}else{
					$('.billingAddress').val('');
					$('.billingStates').val('');
					$('.billingCity').val('');
					$('.billingZip').val('');
				}
			});
			
		})
		
	</script>
		
	
	
    
@endsection