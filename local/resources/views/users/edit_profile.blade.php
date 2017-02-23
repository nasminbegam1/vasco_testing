@extends('app')

@section('title', 'Edit profile')
    
@section('content')
    
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-2">
				<ul>
					<li>{{ Html::link('dashboard', 'Dashboard',array('class' => Helpers::isActiveRoute('dashboard')))}}</li>
					<li>{{ Html::link(route('edit_profile'), 'Edit Profile',array('class' => Helpers::isActiveRoute('edit_profile')))}}</li>
					<li>{{ Html::link(route('edit_billing'), 'Edit Billing',array('class' => Helpers::isActiveRoute('edit_billing')))}}</li>
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
					@if(Session::has('succ_msg'))
						<div class="alert alert-success">
							<ul>
								<li>{{Session::get('succ_msg') }}</li>
							</ul>
						</div>
					@endif
				    {!! Form::open(array('route'=>'edit_profile_action','id' => 'editProfile','novalidate'=>'novalidate')) !!}
				    <div class="form-group">
				       <label for="first_name">First Name:</label>
				    {!! Form::text('first_name',$users->first_name,array('placeholder'=>'First Name','class'=>'form-control')) !!}
				    </div>
				    <div class="form-group">
				    <label for="last_name">Last Name:</label>
				    {!! Form::text('last_name',$users->last_name,array('placeholder'=>'Last Name','class'=>'form-control')) !!}
				    </div>
				    <div class="form-group">
				    <label for="last_name">Phone No.:</label>
				    {!! Form::text('phone_no',$users->phone_no,array('placeholder'=>'Phone No.','class'=>'form-control')) !!}
				    </div>				    <div class="form-group">
				      <label for="email">Email address:</label>
				      {!! Form::email('email',$users->email,array('placeholder'=>'Email address','class'=>'form-control','readonly'=>'readonly')) !!}
				    </div>
				    {!! Form::submit('Submit',array('class'=>'btn btn-default')) !!}
				    {!! Form::close() !!}
			</div>
		</div>
	</div>
    
    
@endsection