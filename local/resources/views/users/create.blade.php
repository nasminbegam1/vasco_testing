@extends('app')

@section('title', 'Patient Registration')
    
@section('content')
	<h2>Patient Registration</h2>
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
                 {!! Form::open(array('route'=>'user_signup_action','id' => 'userSignup','novalidate'=>'novalidate')) !!}
                 <p>Those items marked with a (<span class="asterisk">*</span>) are requied fields</p>
                 <h3 class="heading">Patient Information</h3>			
            <div class="clearfix patientinfo">
	   
	    
            <div class="form-group">
                <label for="name">First Name <span class="asterisk">*</span></label>
               {!! Form::text('first_name',null,array('placeholder'=>'First Name','class'=>'form-control','required'=>'required')) !!}
            </div>
		   <div class="form-group">
               <label for="name">Last Name <span class="asterisk">*</span></label>
               {!! Form::text('last_name',null,array('placeholder'=>'Last Name','class'=>'form-control','required'=>'required')) !!}
            </div>	
            <div class="form-group">
              <label for="email">Email address <span class="asterisk">*</span></label>
              {!! Form::email('email',null,array('placeholder'=>'Email address','class'=>'form-control','required'=>'required')) !!}
            </div>
	    <div class="form-group">
              <label for="pwd">Password <span class="asterisk">*</span></label>
              {!! Form::password('password',array('placeholder'=>'Password','class'=>'form-control chk-pwd','id'=>'password','required'=>'required')) !!}
	      <div id="pswd_info">
			<h4>Password must meet the following requirements:</h4>
			<ul>
				<li id="letter" class="invalid">At least <strong>one letter</strong></li>
				<li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
				<li id="number" class="invalid">At least <strong>one number</strong></li>
				<li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
			</ul>
	      </div>
            </div>
	    <div class="form-group">
              <label for="dob">Patient Date Of Birth</label>
		{{--*/ $year = date('Y') /*--}}
	      {!! Form::selectMonth('month',date('m')) !!}
              {!! Form::selectRange('date','1','31',date('j')) !!}
              {!! Form::selectYear('year', $year - 100, $year,date('Y')) !!}
            </div>
	    <div class="form-group">
              <label for="pwd">Re-enter Password <span class="asterisk">*</span></label>
              {!! Form::password('re_password',array('placeholder'=>'Password','class'=>'form-control','required'=>'required')) !!}
	      
            </div>	
	    <div class="form-group">
              <label for="gender">Patient Gender <span class="asterisk">*</span></label>
              {!! Form::select('gender',[''=>'Select Gender','Male'=>'Male','Female'=>'Female'],'',array('class'=>'form-control','required'=>'required')) !!}
            </div>	
	   
	    
	   <div class="form-group">
              <label for="phone_home">Phone (Home) <span class="asterisk">*</span></label>
              {!! Form::text('phone_home',null,array('placeholder'=>'Home Phone No.','class'=>'form-control','required'=>'required')) !!}
            </div>
            <div class="form-group">
              <label for="phone_mobile">Phone (Cell) <span class="asterisk">*</span></label>
              {!! Form::text('phone_mobile',null,array('placeholder'=>'Mobile No.','class'=>'form-control','required'=>'required')) !!}
            </div>	
	    <div class="form-group">
              <label for="is_minor">Is this patient a minor?</label>
              {!! Form::select('is_minor',[''=>'Choose your selection...','Yes'=>'Yes','No'=>'No'],'',array('class'=>'form-control is_minor')) !!}
            </div>
	    <div class="form-group contact_name" style="display:none;">
               <label for="contact_name">Contact Name</label>
               {!! Form::text('contact_name',null,array('placeholder'=>'Contact Name','class'=>'form-control','id'=>'user_contact_name')) !!}
            </div>	
	    <div class="form-group padding-left">
              <label for="is_pet">Is this a pet?</label>
              {!! Form::select('is_pet',[''=>'Choose your selection...','Yes'=>'Yes','No'=>'No'],'',array('class'=>'form-control is_pet')) !!}
            </div>
	    <div class="form-group pet_type_view" style="display:none;">
              <label for="pet_type">Pet Type</label>
              {!! Form::select('pet_type',['Canine'=>'Canine','Feline'=>'Feline','Other'=>'Other'],'',array('class'=>'form-control pet_type')) !!}
            </div>
	    <div class="form-group pet_type_value" style="display:none;">
              <label for="pet_type">Pet Type</label>
              {!! Form::text('pet_type_value','',array('class'=>'form-control','placeholder' => 'Enter Pet Type')) !!}
            </div>
</div>		
				<h3 class="heading">Address Information</h3>
				<div class="clearfix billinginfo">			
						<div class="form-group">
								<label for="address">Address <span class="asterisk">*</span></label>
								{!! Form::text('address',null,array('placeholder'=>'Address','class'=>'form-control homeAddress','required'=>'required')) !!}
						</div>
						<div class="form-group">
								<label for="city">City <span class="asterisk">*</span></label>
								{!! Form::text('city','',array('class'=>'form-control homeCity','placeholder'=>'City' ,'required'=>'required')) !!}
						</div>
						<div class="form-group">
								<label for="state">State <span class="asterisk">*</span></label>
								{!! Form::select('state',$state,'',array('class'=>'form-control homeState' , 'required'=>'required')) !!}
						</div>
						<div class="form-group">
								<label for="zip">Zip <span class="asterisk">*</span></label>
								{!! Form::text('zip',null,array('placeholder'=>'Zip','class'=>'form-control homeZip','required'=>'required')) !!}
						</div>	
				</div>
			
		
		<h3 class="heading">Billing Information
				   <label><input type="checkbox" value="Yes" name="copyAddress" class="copyAddressInSignup" > Same as above</label>
				  </h3>
		<div class="clearfix billinginfo">				    
		  
		  
		  <div class="form-group">
			<label for="billing_address">Address <span class="asterisk">*</span></label>
			{!! Form::text('billing_address', '', array('placeholder'=>'Billing Address','class'=>'form-control billingAddress','required'=>'required')) !!}
		  </div>
		  
			 <div class="form-group">
			<label for="billing_city">City <span class="asterisk">*</span></label>
			{!! Form::text('billing_city','',array('class'=>'form-control billingCity','placeholder'=>'City', 'required'=>'required')) !!}
		  </div>
			
		  <div class="form-group">
			<label for="billing_state">State <span class="asterisk">*</span></label>
			{!! Form::select('billing_state',$state, '', array('class'=>'form-control billingStates', 'required'=>'required')) !!}				      
		  </div>
			  
		   <div class="form-group">
			<label for="billing_zip">Zip <span class="asterisk">*</span></label>
			{!! Form::text('billing_zip', '',array('placeholder'=>'Billing Zip','class'=>'form-control billingZip','required'=>'required')) !!}
		  </div>
		  
		  
		  <div class="form-group">
			 <label for="first_name">Credit Card Number</label>
		  {!! Form::text('credit_card','',array('placeholder'=>'Credit Card Number','class'=>'form-control')) !!}
		  </div>
			  
		  <div class="form-group">
		  <label for="last_name">Expiry Date</label>
		  {!! Form::selectMonth('exp_month','') !!}
			{!! Form::selectYear('exp_year',  date('Y') + 20, date('Y'),date('Y')) !!}
		  </div>
			  
		  <div class="form-group">
		  <label for="last_name">CVV</label>
		  {!! Form::text('cvv','', array('placeholder'=>'CVV','class'=>'form-control')) !!}
		  </div>
		</div>
						
		
	    <h3 class="heading">Emergency Contact Information</h3>
		
		<div class="clearfix billinginfo">	
		
		<div class="form-group">
		  <label for="emergency_contact_name">Name</label>
		  {!! Form::text('emergency_contact_name',null,array('placeholder'=>'Name','class'=>'form-control')) !!}
		</div>
		<div class="form-group">
		  <label for="emergency_contact_number">Phone Number</label>
		  {!! Form::text('emergency_contact_number',null,array('placeholder'=>'Emergency Contact Number','class'=>'form-control')) !!}
		</div>
		<div class="form-group">
		  <label for="relationship">Relationship to Patient</label>
		  {!! Form::text('relationship',null,array('placeholder'=>'Relationship to Patient','class'=>'form-control')) !!}
		</div>
	      </div>
            <div class="clearfix billinginfo">
                <div class="form-group">
                    <label for="relationship">{!!captcha_img('flat')!!}</label>
                    {!! Form::text('captcha','',array('placeholder'=>'Captcha text','class'=>'form-control','id'=>'captcha')) !!}
                </div>
             </div>    
		
            {!! Form::submit('Submit',array('class'=>'btn btn-default signup2')) !!}
            {!! Form::close() !!}
	    
	    
	    	
	    
	    
	    
	    <script>
				$(function(){
				
				$('.homeAddress, .homeZip').keyup(function(){
					if($('.copyAddressInSignup').is(':checked')){
						$('.billingAddress').val($('.homeAddress').val());
						$('.billingZip').val($('.homeZip').val());
					}
				});
				
				$('.homeAddress, .homeZip').keydown(function(){
					if($('.copyAddressInSignup').is(':checked')){
						$('.billingAddress').val($('.homeAddress').val());
						$('.billingZip').val($('.homeZip').val());
					}
				});
				
				$('.homeState').change(function(){
					if($('.copyAddressInSignup').is(':checked')){
						
						$(".billingStates option:selected").removeAttr();
						var selected_val = $('.homeState').val();
						if (selected_val != '' ) {
						$('.billingStates option[value='+selected_val+']').prop('selected',true);
						}
					}
				});
				
				$('.homeCity').change(function(){
					if($('.copyAddressInSignup').is(':checked')){
						$('.billingCity').val($('.homeCity').val());
					}
				});
				
				$('.copyAddressInSignup').on('click',function(){
				
						if ($(this).is(':checked')) {
							$('.billingAddress').val($('.homeAddress').val());
							$(".billingStates").find('option').removeAttr("selected");
							var selected_val = $('.homeState').val();
							if (selected_val != '' ) {
								$('.billingStates option[value='+selected_val+']').prop('selected',true);
							}
							$('.billingCity').val($('.homeCity').val());
							//var cityid = $('.homeCity').val();
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