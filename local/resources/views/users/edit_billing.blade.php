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
				<h2>Edit Billing</h2>
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
				    {!! Form::open(array('route'=>'update_billing','id' => 'editProfile','novalidate'=>'novalidate')) !!}
				    <div class="form-group">
				       <label for="first_name">Credit Card Number:</label>
				    {!! Form::text('credit_card','xxxxxxxxxxxx'.$billing->credit_card,array('placeholder'=>'Credit Card Number','class'=>'form-control')) !!}
				    </div>
				    <div class="form-group">
				    <label for="last_name">Expiry Date:</label>
				    {!! Form::selectMonth('exp_month',date('m',strtotime($billing->exp_date))) !!}
				      {!! Form::selectYear('exp_year',  date('Y') + 20, date('Y'),$billing->exp_date?date('Y',strtotime($billing->exp_date)):date('Y')) !!}
				    </div>
				    <div class="form-group">
				    <label for="last_name">CVV:</label>
				    {!! Form::text('cvv',$billing->	cvv_code,array('placeholder'=>'CVV','class'=>'form-control')) !!}
				    </div>
				    <div class="form-group">
				      <label for="email">Home address:</label>
				      {!! Form::textarea('home_address',$billing->home_address,array('class'=>'form-control homeAddress')) !!}
				    </div>
					
					<div class="form-group">
				      <label for="email">Billing address:</label>
					  <label>{!! Form::checkbox('copyAddress','yes','',array('class'=>'copyAddress')) !!} Same as home address</label>
				      {!! Form::textarea('billing_address',$billing->billing_address,array('class'=>'form-control billingAddress')) !!}
				    </div>
				    {!! Form::submit('Submit',array('class'=>'btn btn-default')) !!}
				    {!! Form::close() !!}
			</div>
		</div>
	</div>
    
	<script>
		
		$(function(){
			$('.homeAddress').keypress(function(){
				if($('.copyAddress').is(':checked')){
					$('.billingAddress').val($('.homeAddress').val());
				}
			});
			$('.copyAddress').on('click',function(){
		
				if ($(this).is(':checked')) {
					$('.billingAddress').val($('.homeAddress').val());
				}else{
					$('.billingAddress').val('');
				}
			});
			
		})
		
	</script>
		
	
	
    
@endsection