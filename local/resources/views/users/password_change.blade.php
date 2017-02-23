@extends('app')

@section('title', 'Change Password')
    
@section('content')
    
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-12 right-align">
	     
			<div class="logout2">{{ Html::link(route('logout'), 'Logout')}}</div>
			 <div class="dash-btn" href="javascript:void(0)"><span>Change Password</span>		
			   <ul class="dropdown">
			     <li>{{ Html::link('dashboard', 'Dashboard',array('class' => Helpers::isActiveRoute('dashboard')))}}</li>
			     <li>{{ Html::link(route('edit_profile'), 'Edit Profile and Billing',array('class' => Helpers::isActiveRoute('edit_profile')))}}</li>
			     <li>{{ Html::link(route('change_password'), 'Password Change',array('class' => Helpers::isActiveRoute('change_password')))}}</li>		  
			   </ul>
			 </div>
			   
		       </div>
			
			
			<div class="col-lg-12">
				<h3 class="heading">Change Password</h3>
					@if (count($errors) > 0) 
					    <div class="alert alert-danger">
					    <ul>
						    @foreach ($errors->all() as $error)
							    <li>{{ $error }}</li>
						    @endforeach
					    </ul>
					    </div>
					@endif
					@if(Session::has('succ_msg'))
						<div class="alert alert-success">
							<ul>
								<li>{{Session::get('succ_msg') }}</li>
							</ul>
						</div>
					@endif
					@if(Session::has('error_msg'))
						<div class="alert alert-danger">
							<ul>
								<li>{{Session::get('error_msg') }}</li>
							</ul>
						</div>
					@endif
					
				    {!! Form::open(array('route'=>'password_change_action','id' => 'passwordChange','novalidate'=>'novalidate')) !!}
				      <div class="form-group">
					<label for="pwd">Old Password:</label>
					{!! Form::password('old_password',array('placeholder'=>'Old Password','class'=>'form-control required')) !!}
				      </div>
				      <div class="form-group">
					<label for="pwd">New Password:</label>
					{!! Form::password('new_password',array('placeholder'=>'New Password','class'=>'form-control chk-pwd','id'=>'new_password')) !!}
                                        <span id="passstrength"></span>
					
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
					<label for="pwd">Re-enter New Password:</label>
					{!! Form::password('re_password',array('placeholder'=>'Re-enter New Password','class'=>'form-control')) !!}
				      </div>
				      <div class="form-group">
					 {!! Form::submit('Submit',array('class'=>'btn btn-default')) !!}
				      </div>
				    {!! Form::close() !!}
			</div>
		</div>
	</div>
    
    
@endsection