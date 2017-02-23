@extends('app')

@section('title', 'Dashboard')
    
@section('content')
	
	<div class="row welcomeTop">
		<div class="col-sm-3">
		<span class="welcomeUserName">Welcome <strong>{{ucwords($details->first_name) . ' '. ucwords($details->last_name)}}</strong>!</span>
		</div>
		<div class="col-sm-9">
			<div class="rightDrop">
			<span class="logout">{{ Html::link(route('logout'), 'Logout')}}</span>
			<div class="dropdown">
			<span class="dropdownTitle">Dashboard</span>
			<ul>
					<li>{{ Html::link('dashboard', 'Dashboard',array('class' => Helpers::isActiveRoute('dashboard')))}}</li>
					<li>{{ Html::link(route('edit_profile'), 'Edit Profile and Billing',array('class' => Helpers::isActiveRoute('edit_profile')))}}</li>
					<!--<li>{{ Html::link(route('edit_billing'), 'Edit Billing',array('class' => Helpers::isActiveRoute('edit_billing')))}}</li>-->
					<li>{{ Html::link(route('change_password'), 'Change Password',array('class' => Helpers::isActiveRoute('change_password')))}}</li>
				</ul>
				</div>
				</div>
		</div>
		</div>
		<div class="row welcomeText">
		<div class="col-sm-12">
		<p>
		Thank you for visiting the VascoRX Patient Portal, where you can update your profile and billing information, and let us know about your current medications, allergies and medical conditions, so that we can better serve you.</p>
		</div>
		</div>
		<div class="formFiled">
	<h4>Medications</h4>
	<p>Enter any over the counter, herbal, or prescription medicines that you may be taking, to help our pharmacists look for any known interaction issues. You can do so by clicking on the "Add a Medication" button below.</p>
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th></th>
				<th>Medication (Prescription OTC or Herbal)</th>
				<th>Dosage</th>
				<th>How Often (Frequency)</th>
			</tr>
		</thead>
		<tbody class="medicationAdd">
		@if($medications->count() > 0)
			@foreach($medications as $med)
			<tr id="Medications_{{$med->id}}">
				<td><span style="color:#FF0000;" id="Medications_remove_{{$med->id}}" class="removeTRecord"><img src="{{ asset('assets/Images/remove.png') }}"></span></td>
				<td>{{$med->title}}</td>
				<td>{{$med->dosage}}</td>
				<td>{{$med->time_frame}}</td>
			</tr>
			@endforeach
		@else
		<tr>
			<td></td>
			<td colspan="3">No record found</td>
		</tr>
		@endif
		</tbody>
	</table>
		
	{!! Form::open(array('novalidate'=>'novalidate','class'=>'test','method'=>'post', 'id' => 'medicalFrmClass')) !!}
	{!! Form::hidden('csrf-token',csrf_token()) !!}
	<div class="medicationHtml"></div>
	<div class="medicationSubmit"></div>
	{!! Form::close() !!}
	
        <a class="addMedication" id="medicationID">Add a medication</a>
	</div>
	<div class="formFiled">	
	<h4>Allergies</h4>
	<p>Let us know any allergies you have to medications, by clicking on the "Add an Allergy" button below.</p>
	<table border="1" width="30%" cellpadding="10" cellspacing="10">
		<thead>
			<tr>
				<th></th>
				<th>Allergy</th>
			</tr>
		</thead>
		<tbody class="allergyAdd">
		@if($allergies->count() > 0)
			@foreach($allergies as $allergy)
			<tr id="allergies_{{$allergy->id}}">
				<td><span style="color:#FF0000;" id="allergies_remove_{{$allergy->id}}" class="removeTRecord"><img src="{{ asset('assets/Images/remove.png') }}"></span></td>
				<td>{{$allergy->title}}</td>
			</tr>
			@endforeach
		@else
		<tr>
			<td></td>
			<td colspan="3">No record found</td>
		</tr>
		@endif
		</tbody>
	</table>
	{!! Form::open(array('novalidate'=>'novalidate','class'=>'test','method'=>'post', 'id' => 'allergyFrmClass')) !!}
	{!! Form::hidden('csrf-token',csrf_token()) !!}
	<div class="allergyHtml"></div>
	<div class="allergySubmit"></div>
	{!! Form::close() !!}	
        <a class="addMedication" id="allergyID">Add an Allergy</a>
		
	</div>
	<div class="formFiled">		
	<h4>Medical Conditions</h4>
	<p>Please list your medical conditions by clicking on the "Add Medical Condition" button below.</p>
	<table border="1" width="30%" cellpadding="10" cellspacing="10">
		<thead>
			<tr>
				<th></th>
				<th>Medical Condition</th>
			</tr>
		</thead>
		<tbody class="medicalConditionAdd">
		@if($MedicalConditions->count() > 0)
			@foreach($MedicalConditions as $mc)
			<tr id="MedicalConditions_{{$mc->id}}">
				<td><span style="color:#FF0000;" id="MedicalConditions_remove_{{$mc->id}}" class="removeTRecord"><img src="{{ asset('assets/Images/remove.png') }}"></span></td>
				<td>{{$mc->title}}</td>
			</tr>
			@endforeach
		@else
		<tr>
			<td></td>
			<td colspan="3">No record found</td>
		</tr>
		@endif
		</tbody>
	</table>
	{!! Form::open(array('novalidate'=>'novalidate','class'=>'test','method'=>'post', 'id' => 'medicalConditionFrmClass')) !!}
	{!! Form::hidden('csrf-token',csrf_token()) !!}
	<div class="medicalConditionHtml"></div>
	<div class="medicalConditionSubmit"></div>
	{!! Form::close() !!}	
        <a class="addMedication" id="medicalConditionID">Add a Medical Condition</a>
	</div>
	<div>I
	@if($details->easy_open_cap != '')
		{{--*/ $easy_open_cap = $details->easy_open_cap /*--}}
	@else
		{{--*/ $easy_open_cap = 'No' /*--}}
	@endif
	{!! Form::select('easy_open_cap',['Yes'=>'Would','No'=>'Would Not'],$easy_open_cap,array('id'=>'easy_open_cap'))!!}
	like easy-open caps on my prescription bottles.</div>
	<br>	
	<div>I would like my prescriptions to be filed with
	@if($details->prescription_filled != '')
		{{--*/ $prescription_filled = $details->prescription_filled /*--}}
	@else
		{{--*/ $prescription_filled = 'Generic' /*--}}
	@endif
	{!! Form::select('prescription_filled',['Generic'=>'Generic','Brand'=>'Brand'],$prescription_filled,array('id'=>'prescription_filled'))!!}
		whenever possibile.</div>
	<br>
		<div class="changeDrpDwn_msg" style="display:none">
			Your Patient Information has been successfully updated
		</div>
	<br>
        <p>Any changes you make above are automatically saved. Thank you for recording your information on this page so that we may better serve you.  If you have any questions, comments or concerns, please contact us.</p>
        
@endsection