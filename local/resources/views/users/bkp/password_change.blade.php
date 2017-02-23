@extends('app')

@section('title', 'Change Password')
    
@section('content')
    
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-2">
				<ul>
					<li>{{ Html::link('dashboard', 'Dashboard',array('class' => Helpers::isActiveRoute('dashboard')))}}</li>
					<li>{{ Html::link('edit_profile', 'Edit profile',array('class' => Helpers::isActiveRoute('edit_profile')))}}</li>
					<li>Change Password</li>
						
					<li>{{ Html::link('logout', 'Logout')}}</li>
				</ul>
			</div>
			<div class="col-lg-10">
				<h2>Change Password</h2>
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
					{!! Form::password('old_password',array('placeholder'=>'Old Password','class'=>'form-control')) !!}
				      </div>
				      <div class="form-group">
					<label for="pwd">New Password:</label>
					{!! Form::password('new_password',array('placeholder'=>'New Password','class'=>'form-control','id'=>'new_password')) !!}
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