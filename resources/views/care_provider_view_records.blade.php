@extends('layouts.app')

@section('content')

   
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>PATIENT HEALTH RECORDS</b></div>

                <div class="card-body">
                    <div class="panel panel-default">
                    
                    <button class="btn btn-primary btn-sm" style="float: right; margin-bottom: 15px"> Request Permission For Entire Patient Record</button>
                    <div class="panel-body table-responsive" style="margin-top: 0px; padding-top: 0px">
                            <table class="table table-bordered table-striped" style="color: black; font-size: 12px">
                                <thead>
                                    <tr>
                                        <th class="betty">S/No.</th>
                                        <th class="betty">Document Title</th>
                                        <th class="betty">Document Creator</th>
                                        <th class="betty">Date Added</th>
                                        <th class="betty">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($recordLogs as $log)
                                    <tr>
                                        <td class="betty">{{$loop->index+1}}</td>
                                        <td class="">{{ucwords(strtolower($log->title))}}</td>
                                        <td class="">{{ucwords(strtolower($log->getDocumentCreator($log->user_id, $log->signer)))}}</td>
                                        <td class="">{{date_format($log->created_at, 'jS M, Y')}}</td>
                                        <td class="betty">
                                        @if($log->getPermissionStatus() == 0)
                                        <a href="{{route("request_file_access", [$log->user_id, Auth::user()->id, $log->id, 'Single'])}}"><button class="btn btn-primary btn-sm" onclick="return confirm('To view this file, a request for file access will be sent to the patient and must be authorized.');">Request Access</button></a>
                                        @elseif($log->getPermissionStatus() == 1)
                                        <a href="#"><button class="btn btn-success btn-sm">View File</button></a>
                                        @elseif($log->getPermissionStatus() == 2)
                                        <button data-toggle="modal" data-target="#requestDeclined" data-backdrop="static" data-keyboard="false" class="btn btn-danger btn-sm">Access Denied</button>
                                        @else
                                        <button class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#awaitResponse" data-backdrop="static" data-keyboard="false">Awaiting Response</button>
                                        @endif
                                     </td>
                                    </tr>
                                    @endforeach
                                   
                                </tbody>           
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="requestDeclined" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="padding: 0px; margin: 0px; font-size: 18px"><b> File Access Request Declined</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div style="font-size: 18px; margin-left: 5px">
        
        <div class="col-md-12">
            <div class="row">       
                Your request to access this file has been declined by patient.
            </div>

            <div class="row">
            <div class="col-md-12" style="margin-top:10px">
                <center><button class="btn btn-primary btn-xs" data-dismiss="modal">Close</button></center>
            </div>
            </div>
        </div>
        
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="awaitResponse" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" style="padding: 0px; margin: 0px; font-size: 18px"><b> Awaiting Approval</b></h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div style="font-size: 18px; margin-left: 5px">
      
      <div class="col-md-12">
          <div class="row">       
              Request for file access has been sent to patient. Kindly wait for approval.
          </div>

          <div class="row">
          <div class="col-md-12" style="margin-top:10px">
              <center><button class="btn btn-primary btn-xs" data-dismiss="modal">Close</button></center>
          </div>
          </div>
      </div>
      
      </div>
    </div>
  </div>
</div>
</div>
    
    @endsection
