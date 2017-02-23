<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \Validator, \Redirect, \URL, \Hash, \Session, \Helpers;
use App\Patients;

class UserPasswordController extends Controller
{
    public function index()
    {
        $data 			= array();
	$patient_id 		= Session::get('PATIENT_ID');
	$data['user_details']	= Patients::where('id',$patient_id)->first();
        return view('users.password_change',$data);
    }
    
    public function do_password_change(Request $request)
    {   
        $messages = ['new_password.regex' => "Your password must contain 1 lower case character 1 upper case character one number"];
	$validator = Validator::make(
                            $request->all(),
                            ['old_password'     => 'required',
                             'new_password'	=> 'required|min:8|regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
                             're_password'      => 'required|same:new_password'
                            ],$messages);
	
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }
	else
	{
	    $patient_id	= Session::get('PATIENT_ID');
	    $user 	= Patients::where('id', '=', $patient_id)->first();
	    
	    if (Hash::check($request->old_password, $user->password)){
		
		$user->password = $request->new_password;
		$user->token = '';
		$user->save();
		
		return redirect::route('change_password')->with('succ_msg', 'Congratulation! you have successfully changed your password');
		
	    }else{
		return Redirect::back()->with('error_msg', 'Your Old Password is incorrect');
	    }
	}
    }
}
