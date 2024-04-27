<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;

    public function requester(){
        $requester = User::find($this->requester_id);

        return $requester->physician." From ".$requester->care_provider;
    }

    public function details(){
        if($this->request_type == "Single"){
            $file = LogRecords::find($this->logg_id);
            return "Your Medical Record With Title: <b>".$file->title."</b>";
        }else{
            return "All Your Medical Records.";
        }
    }


}
