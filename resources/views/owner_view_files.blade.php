@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>YOUR HEALTH RECORDS</b></div>

                <div class="card-body">
                    <div class="panel panel-default">
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
                                    @foreach($recordLods as $log)
                                    <tr>
                                        <td class="betty">{{$loop->index+1}}</td>
                                        <td class="">{{ucwords(strtolower($log->title))}}</td>
                                        <td class="">{{ucwords(strtolower($log->getDocumentCreator($log->user_id, $log->signer)))}}</td>
                                        <td class="">{{date_format($log->created_at, 'jS M, Y')}}</td>
                                        <td class="betty">
                                            <a href="{{route("viewFile", [$log->id])}}"><button class="btn btn-primary btn-sm" style="margin-right: 11px; color: white; font-size: 10px"> View File</button></a>
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
    @endsection
