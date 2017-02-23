@extends('app')

@section('title', 'Forgot Password')
    
@section('content')
    <div class="container">
    <h2>Forgot Password</h2>
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
					<li>{{Session::get('error_msg') }}</li>
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
            {!! Form::open(array('route'=>'forgot_password_action','id' => 'userForgotPassword','novalidate'=>'novalidate')) !!}
            <div class="form-group">
              <label for="email">Email address:</label>
              {!! Form::email('email',null,array('placeholder'=>'Email address','class'=>'form-control')) !!}
	    </div>
	    <div class="form-group">
	      {!! Form::submit('Forgot Password',array('class'=>'btn btn-default')) !!}
            </div>
            {!! Form::close() !!}
	    <div class="form-group">
	      Never mind, send me back to the <a href='{{URL::route('user_login')}}' class='body'>Log-in</a> screen
            </div>
	    
    </div>
@endsection