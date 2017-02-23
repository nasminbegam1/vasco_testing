<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \Validator, \Redirect, \URL, \Hash, \Session, \Helpers;
use App\Patients;
use App\States;
use App\Cities;
use Crypt;

class UserController extends Controller
{
    public function login(){
        if (Session::has('PATIENT_ID')){
            return Redirect::route('dashboard');
        }
        $data = array();
        return view('users.login',$data);
    }
    public function login_action(Request $request){
        
        $validator = Validator::make(
                            $request->all(),
                            ['email'             => 'required|email',
                             'password'          => 'required'
                            

                            ]);
        if ($validator->fails())
        {
            $messages = $validator->messages();
            
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
           
          
           //$user = Patients::where("email = AES_ENCRYPT(:email, :aesKey)", ['email' => $request->email, 'aesKey' =>'ffff'])->first();
            $result = Patients::where('email', '=', $request->email)->first();
            
            
            if(!empty($result)){
                if (Hash::check($request->password, $result->password) && $result->email_verified == 'Yes'){
                    Session::set('PATIENT_ID',$result->id);
                    return Redirect::route('dashboard');
                }elseif($result->email_verified == 'No'){
                    return Redirect::back()->with('error_msg', 'Your email has not been verified. Please verify your email , to resend verification mail <a href="'.URL::route('resend_verify_code',md5($request->email)).'">CLICK HERE.</a>');
                }else{
                    return Redirect::back()->with('error_msg', 'Your Email and Password is incorrect');
                }
            }else{
                return Redirect::back()->with('error_msg', 'Your Email and Password is incorrect');
            }
        }
    }
    
    public function signup(){
        
        $data = array();
        $data['state'] = [''=>'Select State'] + States::lists('state_abbr','state_id')->all();
        return view('users.create',$data);
    }
    public function signup_action(Request $request){
         
        $messages = ['password.regex' => "Your password must contain 1 lower case character 1 upper case character one number",
                     'captcha.required' => 'Please enter captcha code',
                    'captcha.captcha' => 'Incorrect captcha code',
                     ];
        
        $validator = Validator::make(
                            $request->all(),
                            [
                             'first_name'        => 'required',
                             'last_name'         => 'required',
                             'email'             => 'required|email|unique:patients',
                             'password'          => 'required|min:8|regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
                             'state'             => 'required',
                             'city'              => 'required',
                             'captcha'           => 'required|captcha'
                            ],$messages);
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            //dd($request->all());
            $patients = new Patients();
            $patients['first_name']                 = $request->first_name;
            $patients['last_name']                  = $request->last_name;
            $patients['email']                      = $request->email;
            $patients['password']                   = $request->password;
            $patients['date_of_birth']	            = $request->year.'-'.$request->month.'-'.$request->date;
            $patients['gender']	                    = $request->gender;
            $patients['state_id']	            = $request->state;
            $patients['city_id']	            = $request->city;
            $patients['address']	            = $request->address;
            $patients['zip']	            	    = $request->zip;
            $patients['phone_home']	            = $request->phone_home;
            $patients['phone_mobile']	            = $request->phone_mobile;
            $patients['is_minor']	            = $request->is_minor;
            if($patients['is_minor'] == 'Yes'){
                $patients['contact_name']	    = $request->contact_name;
            }
            $patients['is_pet']	                    = $request->is_pet;
            if($patients['is_pet'] == 'Yes'){
                $patients['pet_type']	            = $request->pet_type;
                if($patients['pet_type'] == 'Other'){
                    $patients['pet_type']	            = $request->pet_type_value;
                }
            }
            $patients['emergency_contact_name']	    = $request->emergency_contact_name;
            $patients['emergency_contact_number']   = $request->emergency_contact_number;
            $patients['relationship']               = $request->relationship;
            
            $patients['email_verification_code']   = $verification_code = base64_encode(rand().time());
            
            
            //Billing Details
            $creditCard = trim($request->credit_card);
            $patients['credit_card'] = substr($creditCard,0,-4);
            
            $patients['expiry_date']  = $request->exp_year . '-' . $request->exp_month . '-01';
            $patients['cvv'] = $request->cvv;
            $patients['billing_address']      = $request->billing_address;
            $patients['billing_state_id']     = $request->billing_state;
            $patients['billing_state_id']     = $request->billing_state;
            $patients['billing_city_id']      = $request->billing_city;
            $patients['billing_zip']          = $request->billing_zip;
           
           
            
            $patients_save = $patients->save();
            if($patients_save){
            
            $data['fullname'] 	= $request->first_name .' '. $request->last_name;
            $data['verification_code'] = $verification_code;
            
            \Mail::send('emails.email_verification', $data, function($message) use ($patients)
	    {
		$message->subject('Welcome to the Vasco RX Patient Portal');
		//$message->from($mail_config['from_mail'], $mail_config['from_name']);
                $message->from('patients@vascorx.com','Vasco Rx');
		$message->to($patients['email']);
                //$message->to('nasmin.begam@webskitters.com');
	    });
            }
            return Redirect::route('user_signup_success')->with('success', 'Registration Success');
        }
    }
    
    public function get_verify_code($email)
    {
	if($email!='')
	{
	    $result = Patients::whereRaw('md5(email) = "'.$email.'"')->first();
	    
	    if($result->count() > 0)
	    {
                            $verification_code = base64_encode(rand().time());
                            $result->email_verification_code = $verification_code;
                            $result->save();
		            $data['fullname'] 	= $result->first_name .' '. $result->last_name;
			    
			    $data['verification_code'] = $verification_code;
			    $email_rst = $result->email;
			    \Mail::send('emails.resend_verify_email', $data, function($message) use ($email_rst)
			    {
				$message->subject('Account Verification Link For Patient Portal');
				$message->from('patients@vascorx.com','Vasco Rx');
				$message->to($email_rst);
				
			    });
			    return Redirect::back()->with('error_msg', 'Your email has not been verified. Please verify your email , to resend verification mail <a href="'.URL::route('resend_verify_code',$email).'">CLICK HERE.</a>');
	    }
	    else
	    {
		return Redirect::back()->with('error_msg', 'Please give proper email id');
	    }
	}
	else
	{
		return Redirect::back()->with('error_msg', 'Please give proper email id');
	}
    }
    
    
    
    public function email_verification($vcode){
        $patient = Patients::where('email_verified','No')->where('email_verification_code',$vcode)->first();
        $data = array();
        $data['verify_flag'] = 'fail';
        if($patient){
            $data['verify_flag'] = 'success';
            $patient->email_verification_code = '';
            $patient->email_verified = 'Yes';
            $savePatient = $patient->save();
            if($savePatient){
                \Mail::send('emails.account_active', $data, function($message) use ($patient)
                {
                    $message->subject('VascoRX - Your account has been activated');
                    $message->from('patients@vascorx.com','Vasco Rx');
                    $message->to($patient['email']);
                    //$message->to('nasmin.begam@webskitters.com');
                });
            }
        }
        return view('users.email_verification',$data);
    }
    
    public function signup_success(){
         
        if(!\Session::has('success')){
            return Redirect::route('user_login');
        }
        
        return view('users.signup_success');
    }
    
    public function emailExist(Request $request){
        $emailAddressR = $request->emailAddressR;
        $result = Patients::where('email', '=', $request->emailAddressR)->exists();
        echo $result;
    }
    
    public function logout(){
        Session::forget('PATIENT_ID');
        return redirect::to('/');
    }
    
    public function forgot_password(){
        $data = array();
        return view('users.forgot_password',$data);
    }
    public function forgot_password_action(Request $request){
        $validator = Validator::make($request->all(),['email'=> 'required|email']);
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $result = Patients::where('email', '=', $request->email)->first();
            $token  =  Helpers::randomString().time();
            if(!empty($result)){
                $result->token = $token;
                $result->save();
                \Mail::send('emails.forgot_password', array( 'first_name' => $result->first_name,'last_name'=>$result->last_name, 'token'=> base64_encode( $token)), function($message) use ($result)
                {			
                        $message->to($result->email, $result->first_name)->subject('Vasco Rx Patient Portal Password Reset')->from('patients@vascorx.com','Vasco Rx');
                });
                return Redirect::back()->with('success_msg', 'A password reset link has been sent to your email. Please check your email.');
            }else{
                return Redirect::back()->with('error_msg', 'Sorry! we did not find your username in our system.');
            }
        }
    }
    
    public function reset_password($token){
        $data = array();
        $data['token']  = $token;
        return view('users.reset_password',$data);
    }
    public function reset_password_action(Request $request){
        $messages = ['password.regex' => "Your password must contain 1 lower case character 1 upper case character one number"];
        $validator = Validator::make(
                            $request->all(),
                            [
                                'password'          => 'required|min:8|regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
                                're_password'       => 'required|same:password'
                            ],$messages);
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
            $token  = $request->token;
            $user = Patients::where('token',base64_decode($token))->first();
            if($user && $user->count()){
               $user->password = $request->password;
               $user->token = '';
               $user->save();
               return redirect::route('success')->with('succ_msg', 'Congratulations!  You have reset your password successfully.  Please <a href="'.URL::route('user_login').'">click here</a> to log in with your new password.');
            }else{
               return redirect::back()->with('error_msg', 'Sorry! token miss match.');
            }
        }
    }
    public function success(){
        $data = array();
        return view('success',$data);
    }

    public function edit_profile(){
        $data 		= array();
	$patient_id 	= Session::get('PATIENT_ID');
	$data['user_details']	= Patients::where('id',$patient_id)->first();
	$data['state'] = [''=>'Select State'] + States::lists('state_abbr','state_id')->all();
        return view('users.edit',$data);
    }
    
    public function user_edit(Request $request)
    {
         $validator = Validator::make(
                            $request->all(),
                            [
                             'first_name'             => 'required',
                             'last_name'             => 'required',
                             'state'             => 'required',
                             'city'              => 'required'
			    ]);
	 
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else
        {
	    $patient_id 	= Session::get('PATIENT_ID');
            $patients = Patients::where('id',$patient_id)->first();
            $patients['first_name']                       = $request->first_name;
            $patients['last_name']                       = $request->last_name;
            $patients['date_of_birth']	            = $request->year.'-'.$request->month.'-'.$request->date;
            $patients['gender']	                    = $request->gender;
            $patients['address']	            = $request->address;
	    $patients['state_id']	            = $request->state;
	    $patients['city_id']	            = $request->city;
	    $patients['zip']	            	    = $request->zip;
            $patients['phone_home']	            = $request->phone_home;
            $patients['phone_mobile']	            = $request->phone_mobile;
            $patients['is_minor']	            = $request->is_minor;
            if($patients['is_minor'] == 'Yes'){
                $patients['contact_name']	    = $request->contact_name;
            }
            $patients['is_pet']	                    = $request->is_pet;
            if($patients['is_pet'] == 'Yes'){
                $patients['pet_type']	            = $request->pet_type;
                if($patients['pet_type'] == 'Other'){
                    $patients['pet_type']	            = $request->pet_type_value;
                }
            }
	    
	    $patients['is_same_above'] = $request->copyAddress;
	    if($patients['is_same_above'] == 'Yes'){
		
		$patients['is_same_above'] = $request->copyAddress;
	    }
	    else
	    {
		$patients['is_same_above'] = 'No';
	    }
            $patients['emergency_contact_name']	    	= $request->emergency_contact_name;
            $patients['emergency_contact_number']	= $request->emergency_contact_number;
            $patients['relationship']               	= $request->relationship;
	    $patients['easy_open_cap']              	= $request->easy_open_cap;
	    $patients['prescription_filled']        	= $request->prescription_filled;
	    
	    
	    $creditCard = trim($request->credit_card);
        $patients['credit_card'] = substr($creditCard,strlen($creditCard)-4,strlen($creditCard));
        
        $patients['expiry_date']  = $request->exp_year . '-' . $request->exp_month . '-01';
        $patients['cvv'] = $request->cvv;
        $patients['billing_address']   = $request->billing_address;
        $patients['billing_state_id']     = $request->billing_state;
        
       
        if($request->billing_state) {
            $patients['billing_state_id']     = $request->billing_state;
        } else {
           $patients['billing_state_id']      = NULL; 
        }
        if($request->billing_city) {
	   $patients['billing_city_id']          = $request->billing_city;
        } else {
            $patients['billing_city_id']      = NULL;
        }
	   $patients['billing_zip']       = $request->billing_zip;
       
	    
	    $patients_save = $patients->save();
	    
	    if($patients_save){
		return Redirect::route('edit_profile')->with('success', 'You have successfuly edited the record');
	    }
	    else
	    {
		return Redirect::route('edit_profile')->with('error_msg', "Can't update User");
	    }
        }
    }
    public function get_city(Request $request){
        $state_id = $request->state_id;
        $cities = Cities::where('state_id',$state_id)->where('city_status','Active')->get();
        echo json_encode($cities);
    }

}
