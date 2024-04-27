<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\EmergencyContacts;
use App\Models\LogRecords;
use App\Models\Permissions;
use Illuminate\Support\Str;
use Auth;
use Session;
use Illuminate\Support\Facades\Crypt;

use SweetAlert;
use Response;
use View;
use File;

class EHRController extends Controller
{
    //


    //Displays the Patients Onboarding Form
    public function show_patient_onboarding_form()
    {
        return view('onboard_patients');
    }

    public function onboard_patients(Request $request)
    {

        $validatedData = $request->validate([
			'date_of_birth' => 'required',
			'gender' => 'required',
			'genotype' => 'required',
			'blood_group' => 'required',
            'password' => 'required|confirmed',
			]);

        $user = new User;
        $user->pid = $this->generateUserId();
        $user->role = "Patient";
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            $userData = array(
            'userId' => strval($user->pid),
            'dateOfBirth' => strval($request->date_of_birth),
            'gender' => strval($request->gender),
            'genotype' => strval($request->genotype),
            'bloodGroup' => strval($request->blood_group),
            );

            $data = json_encode($userData);

            //Call IPFS
            $title = "Patient Biodata";
            return $this->sendFileToIPFS($user->id, $title, $data);
            
        } else {
            return $this->customErrorHandler();
        }
        
        //dd($data);
      
        // $jsongFile = time() . '_file.json';
  
        // File::put(public_path('/upload/json/'.$jsongFile), $data);
  
        // return Response::download(public_path('/upload/json/'.$jsongFile));
    }


    //Generate Patient ID
    public function generateUserId()
    {
        $pin = range(0, 9);
        $set = shuffle($pin);
        $fiveDigits = "";
        $j = 0;
        for($i = 0; $i<5; $i++){
          $fiveDigits = $fiveDigits."".$pin[$j]; 
          if($j == 9){
            $j = 0;
          }else{
            $j++;       
          }
        }
      
        return "MDS".$fiveDigits;
    }


    //Send File to IPFS
    public function sendFileToIPFS($userId, $title, $data){

        $ipfsHash = Str::random(32);

        //Call Blockchain
        return $this->pushMetadataToBlockchain($userId, $title, $ipfsHash);
    }


    //Send Hash To Blockchain
    public function pushMetadataToBlockchain($userId, $title, $ipfsHash){

        $blockchainHash = "Blockchain Hash";

        $user = User::find($userId);
        $user->public_key = "0x881AaA7564c0ED9876B57f5E9b5A2D92d66c87c7";
        $user->private_key = "0x47d791a4de4919ea9352c1a75fbb0afe99de286a7448a4f146159dd1166b06f3";
        if($user->save()){
            $logRecord = new LogRecords;
            $logRecord->user_id = $userId;
            $logRecord->title = $title;
            $logRecord->signer = Auth::user() == null ? $userId : Auth::user()->id;
            $logRecord->ipfs_hash = $ipfsHash;
            $logRecord->blockchain_hash = $blockchainHash;
            if($logRecord->save()){
                Auth::login($user);
                return redirect()->route("home");                
            }else{
                return $this->customErrorHandler();
            }
            
        }else{
            return $this->customErrorHandler();
        }
    }

    public function customErrorHandler(){
        alert()->error('Something went wrong!', 'Error')->persistent("Dismiss");
        return back();
    }


    //Add Emergency Contact
    public function addEmergencyContact(Request $request){
        $validatedData = $request->validate([
			'name' => 'required',			
			]);

            $emergencyContact = new EmergencyContacts;
            $emergencyContact->user_id = Auth::user()->id;
            $emergencyContact->name = $request->name;
            $emergencyContact->public_key = "0x881AaA7564c0ED9876B57f5E9b5A2D92d66uyt676g";
            $emergencyContact->private_key = "0x47d791a4de4919ea9352c1a75fbb0afe99de286a7448a4f146159dd1166b0";
            if($emergencyContact->save()){
                alert()->success('Emergency Contact Added', 'Success')->persistent("Dismiss");
                return back();
            }else{
                return $this->customErrorHandler();
            }

    }

    //Remove Emergency Contact
    public function removeEmergencyContact($id){
        $emergencyContact = EmergencyContacts::find($id);
        if($emergencyContact->delete()){
            alert()->success('Emergency Contact removed', 'Success')->persistent("Dismiss");
            return back();
        }else{
            return $this->customErrorHandler();
        }
    }

      //Add Personal Health Record
      public function addPersonalHealthRecord(Request $request){
        $validatedData = $request->validate([
			'blood_sugar_reading' => 'required',			
			]);

            $blockchainHash = 'Blockchain Hash';
            $ipfsHash = "QmdS4d3kEyBnuV1tMUXAntRaYQj4ELRjqEWTKhmULkSBvy";
            $title = "Blood Sugar Level Reading";


            $logRecord = new LogRecords;
            $logRecord->user_id = Auth::user()->id;
            $logRecord->title = $title;
            $logRecord->signer = Auth::user()->id;
            $logRecord->ipfs_hash = $ipfsHash;
            $logRecord->blockchain_hash = $blockchainHash;
            if($logRecord->save()){
                alert()->success('Personal Health Record Added', 'Success')->persistent("Dismiss");
                return back();             
            }else{
                return $this->customErrorHandler();
            }

    }

    //Patients View Medical Records
    public function patientViewMedicalRecords(){

        $recordLods = LogRecords::where("user_id", Auth::user()->id)->get();
        return view('owner_view_files', compact("recordLods"));
    }

    //Displays the Care Providers Onboarding Form
    public function show_care_provider_onboarding_form()
    {
        return view('onboard_care_providers');
    }


    public function onboard_care_providers(Request $request)
    {

        $validatedData = $request->validate([
			'physician_name' => 'required',
			'facility_name' => 'required',
			'facility_address' => 'required',			
            'password' => 'required|confirmed',
			]);

        $user = new User;
        $user->pid = $this->generateUserId();
        $user->role = "Care Provider";
        $user->physician = $request->physician_name;
        $user->care_provider = $request->facility_name;
        $user->facility_address = $request->facility_address;
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            $userData = array(
            'userId' => strval($user->pid),
            'physician_name' => strval($request->physician_name),
            'facility_name' => strval($request->facility_name),
            'facility_address' => strval($request->facility_address),
            );

            $data = json_encode($userData);

            //Call IPFS
            $title = "Care Provider Biodata";
            return $this->sendFileToIPFS($user->id, $title, $data);
            
        } else {
            return $this->customErrorHandler();
        }
        
       
    }


    public function add_patient_data(Request $request){
        $validatedData = $request->validate([
			'patient_id' => 'required',
			]);

            $patientInfo = User::where("pid", $request->patient_id)->first();

            if($patientInfo != null){
                return redirect()->route("show_care_provider_add_data_form", [Crypt::encryptString($request->patient_id)]);
            }else{
                alert()->error('Patient with the provided ID does not exist.', 'Error')->persistent("Dismiss");
                return back();
            }
    }


    public function  show_care_provider_add_data_form($id){
        $patientInfo = User::where("pid", Crypt::decryptString($id))->first();
        $userId = $patientInfo->id;
        $pid = $patientInfo->pid;

        return view('care_provider_add_record', compact('userId', 'pid'));
    }


    public function care_provider_store_patient_data(Request $request){
        $validatedData = $request->validate([
			'diagnosis_title' => 'required',
			'diagnosis_details' => 'required',
			'user_id' => 'required',			
			]);
            
            $ipfsHash = "QmdS4d3kEyBnuV1tMUXAntRaYQj4ELRjqEWTKhmULkSBvy";
            $blockchainHash = 'Blockchain Hash';


            $logRecord = new LogRecords;
            $logRecord->user_id = $request->user_id;
            $logRecord->title = $request->diagnosis_title;
            $logRecord->signer = Auth::user()->id;
            $logRecord->ipfs_hash = $ipfsHash;
            $logRecord->blockchain_hash = $blockchainHash;
            if($logRecord->save()){
                alert()->success('Patient Health Record Added', 'Success')->persistent("Dismiss");
                return back();             
            }else{
                return $this->customErrorHandler();
            }

    }


    public function view_patient_data (Request $request){
        $validatedData = $request->validate([
			'patient_id' => 'required',
			]);

            $patientInfo = User::where("pid", $request->patient_id)->first();

            if($patientInfo != null){
                Session::put("request_recipient", "Owner");
                return redirect()->route("show_patient_health_record", [Crypt::encryptString($request->patient_id)]);
            }else{
                alert()->error('Patient with the provided ID does not exist.', 'Error')->persistent("Dismiss");
                return back();
            }
    }


    public function show_patient_health_record($id){
        $patientInfo = User::where("pid", Crypt::decryptString($id))->first();
        $recordLogs = LogRecords::where("user_id", $patientInfo->id)->get();
        return view('care_provider_view_records', compact('recordLogs'));
    }



    public function notify_patient(){
        $permission = Permissions::where("user_id", Auth::user()->id)->where("status", 0)->first();
        return view('pa', compact('permission'));
    }

    public function request_file_access($owner, $requester, $logId, $type){
       
            $permission = new Permissions;
            $permission->user_id = $owner;
            $permission->requester_id = $requester;
            $permission->logg_id = $logId;
            $permission->request_type = $type;
            if($permission->save()){
                alert()->success('Request for file access has been sent.', 'Error')->persistent("success");
                return back();
            }else{
                alert()->error('Something went wrong!', 'Success')->persistent("Dismiss");
                return back();
            }

    }


    public function approve_request($id){
        $permission = Permissions::find($id);
        $permission->status = 1;
        if($permission->save()){
            alert()->success('Request for file access approved.', 'Success')->persistent("success");
            return redirect("home");
        }else{
            alert()->error('Something went wrong!', 'Error')->persistent("Dismiss");
            return back();
        }
    }

    public function decline_request($id){
        $permission = Permissions::find($id);
        $permission->status = 2;
        if($permission->save()){
            alert()->success('Request for file access declined.', 'Success')->persistent("success");
            return redirect("home");
        }else{
            alert()->error('Something went wrong!', 'Error')->persistent("Dismiss");
            return back();
        }
    }

}
