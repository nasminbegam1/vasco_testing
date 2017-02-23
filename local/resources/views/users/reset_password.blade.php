@extends('app')

@section('title', 'Forgot Password')
    
@section('content')
	<h2>Reset Password</h2>
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
            {!! Form::open(array('route'=>'reset_password_action','id' => 'resetPassword','novalidate'=>'novalidate')) !!}
	    {!! Form::hidden('token',$token) !!}
            <div class="form-group">
              <label for="pwd">Password:</label>
              {!! Form::password('password',array('placeholder'=>'Password','class'=>'form-control required','id'=>'password')) !!}
            </div>
	    <div class="form-group">
              <label for="pwd">Re-enter Password:</label>
              {!! Form::password('re_password',array('placeholder'=>'Password','class'=>'form-control required')) !!}
            </div>
	    <div class="form-group">
	      {!! Form::submit('Submit',array('class'=>'btn submitBtn btn-default')) !!}
		  {{ Html::link('/', 'Login',array('class' => 'btn loginBtn btn-default'))}}
            </div>
            {!! Form::close() !!}
	   
@endsection