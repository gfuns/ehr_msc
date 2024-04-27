@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6" style="font-weight:bold">{{ __('You are logged in!') }}</div>

                            <div class=" col-md-6 pull-right" style="font-weight:bold">{{ __('PROVIDER ID:') }} {{Auth::user()->pid}}</div>
                        </div>
                            @if(Auth::user()->show_keys == 1)
                        <div class="row" style="margin-top:10px">                        
                            <div class="col-md-12" style="font-weight:bold;">Please find your keys below.</div>
                            <div class="col-md-12" style="font-weight:bold">{{ __('PUBLIC KEY:') }} {{Auth::user()->public_key}}</div>
                            <div id="falseDoctorKey" class="col-md-12" style="font-weight:bold; word-wrap: break-word;">{{ __('PRIVATE KEY:') }} ************************** <button class="btn btn-warning btn-xs" style="padding: 2px; font-size: 10px" onclick="showDoctorKey()"><i class="fa fa-eye"></i> Reveal Key</button></div>
                            <div id="trueDoctorKey" class="col-md-12" style="font-weight:bold; word-wrap: break-word; display:none">{{ __('PRIVATE KEY:') }} {{Auth::user()->private_key}} <button class="btn btn-warning btn-xs" style="padding: 2px; font-size: 10px" onclick="hideDoctorKey()"><i class="fa fa-eye-slash"></i> Hide Key</button></div>

                            <div class="col-md-12" style="font-weight:bold; color:red">Warning! please keep your keys in a safe place. We suggest you write it down somewhere safe.</div>
                        </div>
                        @endif
                    <div class="row" style="margin-top:30px">

                        <div class="col-md-6">
                            <button class="btn btn-primary btn-small" data-toggle="modal" data-target="#addPatientData" data-backdrop="static" data-keyboard="false">Add Patient Health Data</button>
                        </div>
             
                        <div class="col-md-6">
                            <button class="btn btn-success btn-small" data-toggle="modal" data-target="#viewPatientHealthRecord" data-backdrop="static" data-keyboard="false">View Patient Medical Records</button>
                        </div>


                       
                    </div>
                    <div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addPatientData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="padding: 0px; margin: 0px; font-size: 18px"><b> Add Emergency Contact</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div style="font-size: 18px; margin-left: 5px">
        <form id="update-form" name="update-form" method="post" action="{{route("add_patient_data")}}" class="form-horizontal">
        @csrf
        <div class="col-md-12">
            <div class="row">       
                <label for="inputEmail3" class="col-md-4"><b>Patient ID:</b></label>
                <div class="col-md-6">
                  <input id="patient_id" type="text" class="form-control{{ $errors->has('patient_id') ? ' has-error' : '' }}" name="patient_id" placeholder = "Enter Patient ID" required="required">
                  @if ($errors->has('patient_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('patient_id') }}</strong>
                  </span>
                  @endif
                </div>
            </div>

            <div class="row">
            <div class="col-md-12" style="margin-top:10px">
                <center><button class="btn btn-primary btn-xs">Submit</button></center>
            </div>
            </div>
        </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="viewPatientHealthRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="padding: 0px; margin: 0px; font-size: 18px"><b> Add Personal Health Data</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div style="font-size: 18px; margin-left: 5px">
        <form id="update-form" name="update-form" method="post" action="{{route("view_patient_data")}}" class="form-horizontal">
        @csrf
        <div class="col-md-12">
            <div class="row">       
                <label for="inputEmail3" class="col-md-4"><b>Patient ID:</b></label>
                <div class="col-md-6">
                  <input id="patient_id2" type="text" class="form-control{{ $errors->has('patient_id') ? ' has-error' : '' }}" name="patient_id" placeholder="Enter Patient ID" required="required">
                  @if ($errors->has('patient_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('patient_id') }}</strong>
                  </span>
                  @endif
                </div>
            </div>

            <div class="row">
            <div class="col-md-12" style="margin-top:10px">
                <center><button class="btn btn-primary btn-xs">Submit</button></center>
            </div>
            </div>
        </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function showDoctorKey() {
    var x = document.getElementById("trueDoctorKey").style.display="block";
    var y = document.getElementById("falseDoctorKey").style.display="none";
}

function hideDoctorKey() {
  var x = document.getElementById("trueDoctorKey").style.display="none";
  var y = document.getElementById("falseDoctorKey").style.display="block";
}
    </script>

@endsection
