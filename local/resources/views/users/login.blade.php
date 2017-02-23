@extends('app')

@section('title', 'Login')
    
@section('content')
    <div class="container">
    <h2>Login</h2>
		@if (count($errors) > 0)
			
                    <div class="alert alert-danger">
                    <ul>
                            @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                            @endforeach
                    </ul>
                    </div>
		@endif
		
		@if(Session::has('error_msg'))
			<div class="alert alert-danger">
				<ul>
					<li>{!! Session::get('error_msg') !!}</li>
				</ul>
			</div>
		@endif
                @if(Session::has('success_msg'))
			<div class="alert alert-success">
				<ul>
					<li>{{Session::get('success_msg') }}</li>
				</ul>
			</div>
		@endif
            {!! Form::open(array('route'=>'user_login_action','id' => 'userLogin','novalidate'=>'novalidate')) !!}
	   <!-- <input type="hidden" name="_token" value="csrf_token()">-->
            <div class="form-group">
              <label for="email">Email address:</label>
              {!! Form::email('email',null,array('placeholder'=>'Email address','class'=>'form-control')) !!}
            </div>
            <div class="form-group">
              <label for="pwd">Password:</label>
              {!! Form::password('password',array('placeholder'=>'Password','class'=>'form-control','id'=>'password')) !!}
            </div>
	     
	    <div class="form-group">
	      {{ Html::link('forgot-password', 'Forgot Password?')}}
	      {{ Html::link('signup', 'Patient Registration')}}
            </div>
	    <div class="form-group">
	      {!! Form::submit('Login',array('class'=>'btn btn-default')) !!}
            </div>
            {!! Form::close() !!}
	    
    </div>
@endsection