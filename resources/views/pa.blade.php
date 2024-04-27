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

                            <div class=" col-md-6 pull-right" style="font-weight:bold">{{ __('PATIENT ID:') }} {{Auth::user()->pid}}</div>
                        </div>
                            @if(Auth::user()->show_keys == 1)
                        <div class="row" style="margin-top:10px">                        
                            <div class="col-md-12" style="font-weight:bold;">Please find your keys below.</div>
                            <div class="col-md-12" style="font-weight:bold; word-wrap: break-word;">{{ __('PUBLIC KEY:') }} {{Auth::user()->public_key}}</div>
                            <div id="falsePatientKey" class="col-md-12" style="font-weight:bold; word-wrap: break-word;">{{ __('PRIVATE KEY:') }} ************************** <button class="btn btn-warning btn-xs" style="padding: 2px; font-size: 10px"><i class="fa fa-eye"></i> Reveal Key</button></div>
                            <div id="truePatientKey" class="col-md-12" style="font-weight:bold; word-wrap: break-word; display:none">{{ __('PRIVATE KEY:') }} {{Auth::user()->private_key}}</div>

                            <div class="col-md-12" style="font-weight:bold; color:red">Warning! please keep your keys in a safe place. We suggest you write it down somewhere safe.</div>
                        </div>
                        @endif
                    <div class="row" style="margin-top:30px">

                        <div class="col-md-4">
                            <button class="btn btn-primary btn-small" data-toggle="modal" data-target="#newPHD" data-backdrop="static" data-keyboard="false">Add Personal Health Record</button>
                        </div>
             
                        <div class="col-md-4">
                            <a href="{{route('patientViewMedicalRecords')}}"><button class="btn btn-success btn-small">View Medical Records</button></a>
                        </div>

                        <div class="col-md-4">
                            @if(Auth::user()->contactExist() == 1)
                            <button class="btn btn-danger btn-small" data-toggle="modal" data-target="#showEmergencyContact" data-backdrop="static" data-keyboard="false">View Emergency Contact</button>
                            @else
                            <button class="btn btn-danger btn-small" data-toggle="modal" data-target="#newEmergencyContact" data-backdrop="static" data-keyboard="false">Add Emergency Contact</button>
                            @endif
                        </div>

                       
                    </div>
                    <div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<a id="gfuns" data-toggle="modal" data-target="#accessRequestNotification" data-backdrop="static" data-keyboard="false"></a>

<div class="modal fade" id="newEmergencyContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

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
        <form id="update-form" name="update-form" method="post" action="{{route("addEmergencyContact")}}" class="form-horizontal">
        @csrf
        <div class="col-md-12">
            <div class="row">       
                <label for="inputEmail3" class="col-md-2"><b>Name:</b></label>
                <div class="col-md-8">
                  <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' has-error' : '' }}" name="name" placeholder = "Enter Emergency Contact's Name" required="required">
                  @if ($errors->has('name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
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


<div class="modal fade" id="newPHD" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

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
        <form id="update-form" name="update-form" method="post" action="{{route("addPersonalHealthRecord")}}" class="form-horizontal">
        @csrf
        <div class="col-md-12">
            <div class="row">       
                <label for="inputEmail3" class="col-md-4"><b>Blood Sugar Reading:</b></label>
                <div class="col-md-6">
                  <input id="blood_sugar_reading" type="text" class="form-control{{ $errors->has('blood_sugar_reading') ? ' has-error' : '' }}" name="blood_sugar_reading" placeholder="Enter Reading frommyour device" required="required">
                  @if ($errors->has('blood_sugar_reading'))
                  <span class="help-block">
                    <strong>{{ $errors->first('blood_sugar_reading') }}</strong>
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



@if(Auth::user()->contactExist() == 1)
<div class="modal fade" id="showEmergencyContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="padding: 0px; margin: 0px; font-size: 18px"><b> Emergency Contact Details</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div style="font-size: 18px; margin-left: 5px">
        
        <div class="col-md-12">
            <div class="row">       
                <label for="inputEmail3" class="col-md-4"><b>Name:</b></label>
                <div class="col-md-6">{{Auth::user()->getcontactInfo()->name}}</div>
            </div>

            <div class="row" style="word-wrap: break-word;">       
                <label for="inputEmail3" class="col-md-4"><b>Public Key:</b></label>
                <div class="col-md-6">{{Auth::user()->getcontactInfo()->public_key}}</div>
            </div>

            <div class="row" style="word-wrap: break-word;">       
                <label for="inputEmail3" class="col-md-4"><b>Private Key:</b></label>
                <div id="falseContactKey" class="col-md-6">************** <button class="btn btn-warning btn-xs" style="padding: 2px; font-size: 10px"><i class="fa fa-eye"></i> Reveal Key</button></div>
                <div id="trueContactKey" class="col-md-6" style="display: none">{{Auth::user()->getcontactInfo()->private_key}}</div>
            </div>

            <div class="row">
            <div class="col-md-12" style="margin-top:10px">
                <a href="{{route('removeEmergencyContact', [Auth::user()->getcontactInfo()->id])}}" onclick="return confirm('Are you sure you want to delete this contact?');"><center><button class="btn btn-danger btn-xs">Remove</button></center></a>
            </div>
            </div>
        </div>
      
        </div>
      </div>
    </div>
  </div>
</div>


@if($permission != null)

<div class="modal fade" id="accessRequestNotification" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="padding: 0px; margin: 0px; font-size: 18px"><b> Access Request Notification</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div style="font-size: 18px; margin-left: 5px">
        <div class="col-md-12">
           {{$permission->requester()}} has requested to view @php echo $permission->details(); @endphp

            <div class="row" style="margin-top: 15px">
            <div class="col-md-12" style="margin-top:10px">
                <center>
                    <a href="{{route("approve_request", [$permission->id])}}"><button class="btn btn-success btn-xs">Approve Request</button></a>
                    <a href="{{route("decline_request", [$permission->id])}}"><button class="btn btn-danger btn-xs">Decline Request</button></a>
                </center>
            </div>
            </div>
        </div>
        
        </div>
      </div>
    </div>
  </div>
</div>
       
@endif

@if($permission != null && $permission->status == 0)
<script type="text/javascript">
 window.onload=function(){
     document.getElementById("gfuns").click();
 }
</script>

@else

<script>
    setTimeout(function(){
   window.location.reload(1);
}, 5000);

</script>

@endif


<script type="text/javascript">
function hidePatientKey() {
  var x = document.getElementById("patientkey");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
  </script>
@endif
@endsection
