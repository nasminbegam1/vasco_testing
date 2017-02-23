<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \Session, \Redirect;
use App\PatientBilling;

class BillingController extends Controller
{
    
    public function edit_billing(){
        $patient_id 	= Session::get('PATIENT_ID');
        $data['billing'] = PatientBilling::where('patient_id',$patient_id)->first();
        
        if(!$data['billing']){
            $data['billing'] = new PatientBilling();
        }
        
        return view('users.edit_billing',$data);
    }
    
    
    public function update_billing(Request $request){
        $patient_id 	= Session::get('PATIENT_ID');
        
        $billing = PatientBilling::where('patient_id',$patient_id)->first();
        
        if(!$billing){
            $billing = new PatientBilling();
            $billing->patient_id = $patient_id;
        }
        $creditCard = trim($request->credit_card);
        $billing->credit_card = substr($creditCard,strlen($creditCard)-4,strlen($creditCard));
        
        $billing->exp_date  = $request->exp_year . '-' . $request->exp_month . '-01';
        $billing->cvv_code = $request->cvv;
        $billing->billing_address   = $request->billing_address;
        $billing->home_address      = $request->home_address;
        $billing->save();
        return Redirect::back()->with('succ_msg','Your billing details has been updated!');
        
    }
}
