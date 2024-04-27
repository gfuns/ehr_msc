<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class LogRecords extends Model
{
    use HasFactory;

    public function getDocumentCreator($owner, $signer){

        if($signer == Auth::user()->id){
            return "Document Created By You";
        }else if($owner == $signer){
            return "Document Created By Patient";
        }else{
            $user = User::find($signer);
            return "Document Created By ".$user->physician." from ".$user->care_provider;
        }
      
    }

    
    public function getPermissionStatus(){
        $permission = Permissions::where("user_id", $this->user_id)->where("requester_id", Auth::user()->id)->where("logg_id", $this->id)->first();
        if($permission == null){
            return 0;
        }else if($permission->status == 1){
            return 1;
        }else if($permission->status == 2){
            return 2;
        }else{
            return 3;
        }
    }
}
