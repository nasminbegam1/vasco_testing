<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \Session;
use App\Medications;
use App\allergies;
use App\MedicalConditions;
use App\Patients;

class DashboardController extends Controller
{
    public function index(){
        $data = array();
        $patient_id = Session::get('PATIENT_ID');
        $data['details'] = Patients::find($patient_id);
        
        $data['medications'] = Medications::where('patient_id',$patient_id)->get();
        $data['allergies'] = allergies::where('patient_id',$patient_id)->get();
        $data['MedicalConditions'] = MedicalConditions::where('patient_id',$patient_id)->get();
        
        
        return view('users.dashboard',$data);
    }
    
    public function add_medication(Request $request)
    {
        $patient_id = Session::get('PATIENT_ID');
        $type = $request->type;
        if($type == 'medication')
        {
            for($i=0;$i<count($request->title);$i++){
                $medications                    = new Medications();
                $medications['patient_id']      = Session::get('PATIENT_ID');
                $medications['title']           = $request->title[$i];
                $medications['dosage']          = $request->dosage[$i];
                $medications['time_frame']      = $request->time_frame[$i];
                $medications->save();
               }
                $recordDetails =  Medications::where('patient_id',$patient_id)->get();
                $final_array=array();
                foreach($recordDetails as $med)
                {
                    $final_array [] = array('id'=>$med->id,'title'=>$med->title,'dosage'=>$med->dosage,'time_frame'=>$med->time_frame);
                }  
        }
        else if($type == 'allergy')
        {
            for($i=0;$i<count($request->title);$i++){
                $allergy                    = new allergies();
                $allergy['patient_id']      = Session::get('PATIENT_ID');
                $allergy['title']           = $request->title[$i];
                $allergy->save();
             }
                $recordDetails =  allergies::where('patient_id',$patient_id)->get();
                
                $final_array=array();
                foreach($recordDetails as $aler)
                {
                    $final_array [] = array('id'=>$aler->id,'title'=>$aler->title);
                }   
        }
        else
        {
            for($i=0;$i<count($request->title);$i++){
                $medicalconditions                    = new MedicalConditions();
                $medicalconditions['patient_id']      = Session::get('PATIENT_ID');
                $medicalconditions['title']           = $request->title[$i];
                $medicalconditions->save();
             }
            
                $recordDetails =  MedicalConditions::where('patient_id',$patient_id)->get();
                $final_array=array();
                foreach($recordDetails as $medical_condition)
                {
                    $final_array [] = array('id'=>$medical_condition->id,'title'=>$medical_condition->title);
                }
        }
        
        //$medicationsDetails =  Medications::where('patient_id',$patient_id)->get();
        echo json_encode($final_array);
    }
    
    public function destroy_record(Request $request)
    {
        $record_type    = $request->type;
        $record_id      = $request->id;
        
        if($record_type == 'Medications')
        {
            Medications::where('id','=',$record_id)->delete();
        }
        else if($record_type == 'allergies')
        {
            allergies::where('id','=',$record_id)->delete();
        }
        else if($record_type == 'MedicalConditions')
        {
            MedicalConditions::where('id','=',$record_id)->delete();
        }
    }
    
    public function update_easy_open_cap(Request $request)
    {
        $patient_id                 = Session::get('PATIENT_ID');
        $patients                   = Patients::where('id',$patient_id)->first();
        $patients['easy_open_cap']  = $request->easy_open_cap;
	    
	$patients_save = $patients->save();
    }
    
    public function update_prescription_filled(Request $request)
    {
        $patient_id                 = Session::get('PATIENT_ID');
        $patients                   = Patients::where('id',$patient_id)->first();
        $patients['easy_open_cap']  = $request->easy_open_cap;
	    
	$patients_save = $patients->save();
    }
    
    
}
