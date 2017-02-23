@extends('app')

@section('title', 'Dashboard')
    
@section('content')
	
	<div class="row welcomeTop">
		<div class="col-sm-3">
		<span class="welcomeUserName">Welcome <strong>{{$details->name}}</strong>!</span>
		</div>
		<div class="col-sm-9">
			<div class="rightDrop">
			<span class="logout">{{ Html::link(route('logout'), 'Logout')}}</span>
			<div class="dropdown">
			<span class="dropdownTitle">Dashboard</span>
			<ul>
					<li>{{ Html::link('dashboard', 'Dashboard',array('class' => Helpers::isActiveRoute('dashboard')))}}</li>
					<li>{{ Html::link(route('edit_profile'), 'Edit Profile',array('class' => Helpers::isActiveRoute('edit_profile')))}}</li>
					<!--<li>{{ Html::link(route('edit_billing'), 'Edit Billing',array('class' => Helpers::isActiveRoute('edit_billing')))}}</li>-->
					<li>{{ Html::link(route('change_password'), 'Password Change',array('class' => Helpers::isActiveRoute('change_password')))}}</li>
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
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th></th>
				<th>Medication (Prescription OTC or Herbal)</th>
				<th>Dosage</th>
				<th>Time Frame</th>
			</tr>
		</thead>
		<tbody class="medicationAdd">
		@if($medications->count() > 0)
			@foreach($medications as $med)
			<tr id="Medications_{{$med->id}}">
				<td><span style="color:#FF0000;" id="Medications_remove_{{$med->id}}" class="removeTRecord">remove</span></td>
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
				<td><span style="color:#FF0000;" id="allergies_remove_{{$allergy->id}}" class="removeTRecord">remove</span></td>
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
		
        <a class="addMedication" id="allergyID">Add an Allergy</a>
		
	{!! Form::open(array('novalidate'=>'novalidate','class'=>'test','method'=>'post', 'id' => 'allergyFrmClass')) !!}
	{!! Form::hidden('csrf-token',csrf_token()) !!}
	<div class="allergyHtml"></div>
	<div class="allergySubmit"></div>
	{!! Form::close() !!}
	
</div>
<div class="formFiled">		
	<h4>Medical Conditions</h4>
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
				<td><span style="color:#FF0000;" id="MedicalConditions_remove_{{$mc->id}}" class="removeTRecord">remove</span></td>
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
		
        <a class="addMedication" id="medicalConditionID">Add an Medical Condition</a>
	
	{!! Form::open(array('novalidate'=>'novalidate','class'=>'test','method'=>'post', 'id' => 'medicalConditionFrmClass')) !!}
	{!! Form::hidden('csrf-token',csrf_token()) !!}
	<div class="medicalConditionHtml"></div>
	<div class="medicalConditionSubmit"></div>
	{!! Form::close() !!}
</div>
	<div>I <select name="easy_open_cap" id="easy_open_cap"><option name="Yes" <?php if($details['easy_open_cap'] == 'Yes'){?>selected<?php } ?> >would</option><option name="No" <?php if($details['easy_open_cap'] == 'No'){?>selected<?php } ?>>would not</option></select> like easy-open caps on my prescription bottles.</div>
	<br>	
	<div>I would like my prescriptions to be filed with <select name="prescription_filled" id="prescription_filled"><option name="Generic" <?php if($details['prescription_filled'] == 'Generic'){?>selected<?php } ?>>Generic</option><option name="Brand" <?php if($details['prescription_filled'] == 'Brand'){?>selected<?php } ?>>Brand</option></select>
		whenever possibile.</div>
	<br><br>
	<script>
	//$(function(){
	//	$('.addMedication').click(function(){
	//	var html = '<div class="medicationRemove">Remove</div><div><input type="text" name="title" placeholder="title" class="form-control" id="title"></div><div><input type="text" name="dosage" placeholder="dosage" class="form-control" id="dosage"></div><div><input type="text" name="time_frame" placeholder="time_frame" class="form-control" id="time_frame"></div>';
	//	$('.medicationForm').append(html);
	//});
	//})
    
	</script>
    
@endsection