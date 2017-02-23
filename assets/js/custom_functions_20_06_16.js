$(function() {
	
	$('.is_minor').change(function(){
		var select_value  = $('.is_minor option:selected').val();
		if (select_value == 'Yes') {
			$("#user_contact_name").val('');
                        $(".contact_name").show();
		}else{
			$(".contact_name").hide();
		}
	});
	$('.is_pet').change(function(){
		var select_value  = $('.is_pet option:selected').val();
		if (select_value == 'Yes') {
			$(".pet_type_view").show();
		}else{
			$(".pet_type_view").hide();
			$('.pet_type_value').hide();
		}
	});
	$('.pet_type').on('change',function(){
		var select_value  = $('.pet_type option:selected').val();
		if (select_value == 'Other') {
			$('.pet_type_value').show();
		}else{
			$('.pet_type_value').hide();
		}
                
	});
        $('.is_pet').trigger('change');
	$('.pet_type').trigger('change');
	$.validator.addMethod("emailExist",function (value, element)
	{
	    var returnVal 	= true;
	    $.ajax({
		async:false,
		type: 'post',
		data:{
			'_token'    		:   CSRF_TOKEN,
			'emailAddressR'     	:   value
		},
		url: BASE_URL + '/emailExist',
		beforeSend: function(){
		},
		success: function(data){
			if (parseInt(data) > 0 ) {
				returnVal = false;
			}
		}
	    });
	    return returnVal;
	},'Your email address already exists');
	
	$("#userSignup").validate({
		// Specify the validation rules
		rules: {
		   name				: "required",
		   email              		: {required:true,email :true,emailExist :true},
		   password			: "required",
		   re_password			: {equalTo: "#password",required : true},
		},
		
		// Specify the validation error messages
		messages: {
		    name		: "Please enter First Name",
		    email             	: {required : "Please enter Email Address",
					   email :"Please enter valid email Address"},
		    password		: "Please enter Password",
		    re_password		: {equalTo: "Please enter the same password again.",
					       required : "Please Re-enter Password"}
		},
		
		submitHandler: function(form) {
		    form.submit();
		}
	});
	
	$('#userLogin').validate({
		rules: {
		   email              		: {required:true,email :true},
		   password			: "required",
		},
		// Specify the validation error messages
		messages: {
		    email             	: {required : "Please enter Email Address",
					   email :"Please enter valid email Address"},
		    password		: "Please enter Password",
		},
		
		submitHandler: function(form) {
		    form.submit();
		}
	});
	$('#userForgotPassword').validate({
		rules: {
		   email              		: {required:true,email :true}
		},
		messages: {
		    email             	: {required : "Please enter Email Address",
					   email :"Please enter valid email Address"}
		},
		submitHandler: function(form) {
		    form.submit();
		}
	});
	$("#passwordChange").validate({
		// Specify the validation rules
		rules: {
		   new_password			: "required",
		   re_password			: {equalTo: "#new_password",required : true},
		},
		// Specify the validation error messages
		messages: {
		    new_password		: "Please enter Password",
		    re_password		: {equalTo: "Please enter the same password again.",
					       required : "Please Re-enter Password"},
		},
		
		submitHandler: function(form) {
		    form.submit();
		}
	});
        
        $("#resetPassword").validate({
		// Specify the validation rules
		rules: {
		   password			: "required",
		   re_password			: {equalTo: "#password",required : true},
		},
		// Specify the validation error messages
		messages: {
		    password		: "Please enter Password",
		    re_password		: {equalTo: "Please enter the same password again.",
					       required : "Please Re-enter Password"},
		},
		
		submitHandler: function(form) {
		    form.submit();
		}
	});
	
	$("#editProfile").validate({
		rules: {
		   first_name			: "required",
		   last_name			: "required",
		   phone_no			: "required"
		},
		messages: {
		    first_name		: "Please enter First Name",
		    last_name		: "Please enter Last Name",
		    phone_no		: "Please enter Phone No"
		},
		
		submitHandler: function(form) {
		    form.submit();
		}
	});
	$.validator.addMethod("passwordCheck",function (value, element)
	{
	    var returnVal 	= true;
	    $.ajax({
		async:false,
		type: 'post',
		data:{
			'_token'    		:   CSRF_TOKEN,
			'password'     	:   value
		},
		url: BASE_URL + '/passwordCheck',
		beforeSend: function(){
		},
		success: function(data){
			if (parseInt(data) == 0 ) {
				returnVal = false;
			}
		}
	    });
	    return returnVal;
	},'Please enter correct password');
	
	$("#userEdit").validate({
		rules: {
		   new_password              	: {required:true},
		   re_password			: {equalTo: "#new_password",required : true}
		},
		
		messages: {
		    new_password            	: {required : "Please enter New Password"},
		    re_password			: {equalTo: "Please enter the same password again.",
						   required : "Please Re-enter New Password"},
		},
		
		submitHandler: function(form) {
		    form.submit();
		}
	});
	
	var med_increment = 1;
	var allergy_increment = 1;
	var medicalCondition_increment = 1;
	$('.addMedication').click(function(){
		
		//$('.medicationRemove').parents('.medicationForm').slideUp('slow');
		//$('.medicationRemove').parents('.medicationForm').remove();
			
		var ids = $(this).attr('id');
		
		if (ids == 'medicationID')
		{
			
			
			var html = '<table width="100%" cellspacing="0" cellpadding="0" border="0" class="medicationForm"><tr><td><div class="medicationRemove" style="cursor:pointer;"><img src="'+BASE_URL+'/assets/Images/remove.png" border="0"></div></td><td><input type="text" name="title[]" id="medication_title_'+med_increment+'" placeholder="Name of drug" class="form-control required"></td><td><input type="text" name="dosage[]" id="dosage_'+med_increment+'" placeholder="Dosage" class="form-control required"></td><td><input type="text" name="time_frame[]" id="time_frame_'+med_increment+'" placeholder="How Often (Frequency)" class="form-control required"><input type="hidden" name="type" value="medication"></td></tr></table>';
			
			
			
			/*var html = '<div class="medicationForm"><div class="medicationRemove"><i class="fa fa-minus-circle" aria-hidden="true"></i></div><div><input type="text" name="title[]" id="medication_title_'+med_increment+'" placeholder="Title" class="form-control required"></div><div><input type="text" name="dosage[]" id="dosage_'+med_increment+'" placeholder="Dosage" class="form-control"></div><div><input type="text" name="time_frame[]" id="time_frame_'+med_increment+'" placeholder="Time Frame" class="form-control"><input type="hidden" name="type" value="medication"></div></div>';*/
			var submit = '<input type="submit" name="submit" value="submit" class="medicationSubmit">';
			//Remove others
			$('.allergyHtml').html('');
			$('.allergySubmit').html('');
			$('.medicalConditionHtml').html('');
			$('.medicalConditionSubmit').html('');
			
			$('.medicationHtml').append(html);
			$('.medicationSubmit').html(submit);
		med_increment++;
		}
		else if (ids == 'allergyID')
		{
			
			var html = '<table width="30%" cellspacing="10" cellpadding="10" border="1" class="medicationForm"><tr><td><div class="medicationRemove" style="cursor:pointer;"><img src="'+BASE_URL+'/assets/Images/remove.png" border="0"></div></td><td><input type="text" name="title[]" id="allergy_title_'+allergy_increment+'" placeholder="Name of drug" class="form-control required"><input type="hidden" name="type" value="allergy"></td></tr></table>';
			
			/*var html = '<div class="medicationForm"><div class="medicationRemove"><i class="fa fa-minus-circle" aria-hidden="true"></i></div><div><input type="text" name="title[]" placeholder="Title" class="form-control"><input type="hidden" name="type" value="allergy"></div></div>';*/
			var submit = '<input type="submit" name="submit" value="submit" class="medicationSubmit">';
			
			//Remove others
			$('.medicationHtml').html('');
			$('.medicationSubmit').html('');
			$('.medicalConditionHtml').html('');
			$('.medicalConditionSubmit').html('');
			
			$('.allergyHtml').append(html);
			$('.allergySubmit').html(submit);
		
		allergy_increment++;
		}
		else if (ids == 'medicalConditionID') 
		{
			
			var html = '<table width="30%" cellspacing="10" cellpadding="10" border="1" class="medicationForm"><tr><td><div class="medicationRemove" style="cursor:pointer;"><img src="'+BASE_URL+'/assets/Images/remove.png" border="0"></div></td><td><input type="text" name="title[]" id="medication_con_title_'+medicalCondition_increment+'" placeholder="Name of drug" class="form-control required"><input type="hidden" name="type" value="medical_condition"></td></tr></table>';
			
			/*var html = '<div class="medicationForm"><div class="medicationRemove"><i class="fa fa-minus-circle" aria-hidden="true"></i></div><div><input type="text" name="title[]" id="medication_con_title_'+medicalCondition_increment+'" placeholder="Title" class="form-control required"><input type="hidden" name="type" value="medical_condition"></div></div>';*/
			var submit = '<input type="submit" name="submit" value="submit" class="medicationSubmit">';
			
			//Remove others
			$('.medicationHtml').html('');
			$('.medicationSubmit').html('');
			$('.allergyHtml').html('');
			$('.allergySubmit').html('');
			
			$('.medicalConditionHtml').append(html);
			$('.medicalConditionSubmit').html(submit);
		medicalCondition_increment++
		}
		
		$('.medicationRemove').on('click',function(){ 
			$(this).parents('.medicationForm').slideUp('slow');
			$(this).parents('.medicationForm').remove();
			var length = $('.medicationForm').length;
			if (length == 0) {
				$('.medicationSubmit').html('');
			}
		});
		
	});
	
	//$('#allergyFrmClass').validate();
	$('.test').on('submit',function(e){
		if ($(this).valid()) {
			var idName = $(this).attr('id');
                        //alert(JSON.stringify($(this).serialize()));
		//alert(idName);return false;
		e.preventDefault();
			$.ajax({
			    type: 'post',
			    url: BASE_URL + '/add_medication',
			    dataType : 'JSON',
			    contentType: false,
			    cache: false,
			    processData:false,
			    data: new FormData(this),
			    success: function(response){
				
				$('.medicationRemove').parents('.medicationForm').slideUp('slow');
				$('.medicationRemove').parents('.medicationForm').remove();
				$('.medicationSubmit').html('');
				
				
				if (idName == 'medicalFrmClass')
				{
					
					$('.medicationAdd').empty();
					$.each( response, function( key, value ) {
						var values = '<tr id="Medications_'+value.id+'"><td><span style="color:#FF0000;" id="Medications_remove_'+value.id+'" class="removeTRecord"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></td><td>'+value.title+'</td><td>'+value.dosage+'</td><td>'+value.time_frame+'</td></tr>';
						$('.medicationAdd').append(values);
					});
				}
				else if (idName == 'allergyFrmClass')
				{
					$('.allergyAdd').empty();
					$.each( response, function( key, value ) {
						var values = '<tr id="allergies_'+value.id+'"><td><span style="color:#FF0000;" id="allergies_remove_'+value.id+'" class="removeTRecord"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></td><td>'+value.title+'</td></tr>';
						
						$('.allergyAdd').append(values);
					});
				}
				else if(idName == 'medicalConditionFrmClass')
				{
					$('.medicalConditionAdd').empty();
					$.each( response, function( key, value ) {
						var values = '<tr id="MedicalConditions_'+value.id+'"><td><span style="color:#FF0000;" id="MedicalConditions_remove_'+value.id+'" class="removeTRecord"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></td><td>'+value.title+'</td></tr>';
						$('.medicalConditionAdd').append(values);
					});
				}
				
			    }
			});
		}
		
		return false;
		
		});
	
		
	$(document).on('click', '.removeTRecord', function(){ 
		
		if (confirm('Are you sure?'))
		{
			
			var ids 	= $(this).attr('id').split('_remove_');
			var recordType	= ids[0];
			var recordID	= ids[1];
		
			$.ajax({
				    type: 'POST',
				    url: BASE_URL + '/remove_record',
				    dataType : 'HTML',
				    data:{
					"type":recordType,
					"id":recordID,
					"_token":CSRF_TOKEN
				    },
				    
				    success: function(response){
					
					if (recordType == 'Medications')
					{
						$('#Medications_' + recordID).remove();
					}
					else if (recordType == 'allergies')
					{
						$('#allergies_' + recordID).remove();
					}
					else if(recordType == 'MedicalConditions')
					{
						$('#MedicalConditions_' + recordID).remove();
					}
			            }
			});
		}
	});
	
	$('#easy_open_cap').change(function(){
		
		var capValue 	= $(this).val();
		
		$.ajax({
			    type: 'POST',
			    url: BASE_URL + '/edit_easy_open_cap',
			    dataType : 'HTML',
			    data:{
				"easy_open_cap":capValue,
				"_token":CSRF_TOKEN
			    },
			    
			    success: function(response){
				//alert('You have successfully changed the option');
				$('.changeDrpDwn_msg').show();
				setTimeout(function(){
					$('.changeDrpDwn_msg').slideUp();
				},5000);
			    }	
		});	
	});
	
	$('#prescription_filled').change(function(){
		
		var prescriptionFilledValue 	= $(this).val();
		
		$.ajax({
			    type: 'POST',
			    url: BASE_URL + '/edit_prescription_filled',
			    dataType : 'HTML',
			    data:{
				"prescription_filled":prescriptionFilledValue,
				"_token":CSRF_TOKEN
			    },
			    
			    success: function(response){
				//alert('You have successfully changed the option');
				$('.changeDrpDwn_msg').show();
				setTimeout(function(){
					$('.changeDrpDwn_msg').slideUp();
				},5000);
			    }
		});	
	});
	
	$('.select_state').change(function(){ 
		var state_id = this.value;
		var cityid = $('.get_city').attr('data-attr');
		$.ajax({
			    type: 'POST',
			    url: BASE_URL + '/get_city',
			    dataType : 'JSON',
			    data:{
				"state_id":state_id,
				"_token":CSRF_TOKEN
			    },
			    success: function(response){
				var values = '<option value="">Select City</option>';
				$.each( response, function( key, value ) {
					var selected = '';
					if (cityid != '' && cityid == value.city_id ) {
						selected = 'selected';
					}
					values += '<option value="'+value.city_id+'" '+selected+'>'+value.city_name+'</option>';
				});
				$('.get_city').html(values);
			    }
		});	
	});
	$('.select_state').trigger('change');
	
	$('.billingState').change(function(){
		var state_id = this.value;
		var cityid = $('.billingCity').attr('data-attr');
		$.ajax({
			    type: 'POST',
			    url: BASE_URL + '/get_city',
			    dataType : 'JSON',
			    data:{
				"state_id":state_id,
				"_token":CSRF_TOKEN
			    },
			    success: function(response){
				var values = '<option value="">Select City</option>';
				$.each( response, function( key, value ) {
					var selected = '';
					if (cityid != '' && cityid == value.city_id ) {
						selected = 'selected';
					}
					values += '<option value="'+value.city_id+'" '+selected+'>'+value.city_name+'</option>';
				});
				$('.billingCity').html(values);
			    }
		});	
	});
	$('.billingState').trigger('change');
	
/*
    $('#password').keyup(function(e) {
     var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
     var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
     var enoughRegex = new RegExp("(?=.{6,}).*", "g");
     if (false == enoughRegex.test($(this).val())) {
             $('#passstrength').html('More Characters');
     } else if (strongRegex.test($(this).val())) {
             $('#passstrength').className = 'ok';
             $('#passstrength').html('Strong!');
     } else if (mediumRegex.test($(this).val())) {
             $('#passstrength').className = 'alert';
             $('#passstrength').html('Medium!');
     } else {
             $('#passstrength').className = 'error';
             $('#passstrength').html('Weak!');
     }
     return true;
});*/
    
    
	
});
	function SelectedCity(selected_val,homeCity) {
		var state_id = selected_val;
			var cityid = homeCity;
			$.ajax({
				    type: 'POST',
				    url: BASE_URL + '/get_city',
				    dataType : 'JSON',
				    data:{
					"state_id":state_id,
					"_token":CSRF_TOKEN
				    },
				    success: function(response){
					var values = '';
					$.each( response, function( key, value ) {
						var selected = '';
						if (cityid != '' && cityid == value.city_id ) {
							selected = 'selected';
						}
						values += '<option value="'+value.city_id+'" '+selected+'>'+value.city_name+'</option>';
					});
					$('.billingCity').html(values);
				    }
			});
	}
