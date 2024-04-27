@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><b>{{ __('ADD PATIENT HEALTH RECORD') }}</b></div>

        <div class="card-body">


          <div class="form-group row">
            <div class="col-md-2"><b>{{ __('PATIENT') }}:</b></div>

            <div class="col-md-7"><b>{{$pid}}</b></div>
           
          </div>
          <hr/>
          <form method="POST" action="{{route("care_provider_store_patient_data")}}">
            @csrf
          <div class="form-group row">
            <div class="col-md-12" style="margin-bottom: 20px"><b>Add Diagnosis</b></div>

            <div class="col-md-12"><b>{{ __('Summary Title of Diagnosis/Treatment') }}:</b></div>

            <div class="col-md-12"><input id="diagnosis_title" type="text" class="form-control @error('diagnosis_title') is-invalid @enderror" name="diagnosis_title" value="{{ old('diagnosis_title') }}" required placeholder="Enter Summary Title of Diagnosis/Treatment"></div>
            </div>

            <div class="form-group row">
            <div class="col-md-12"><b>{{ __('Details of Diagnosis/Treatment') }}:</b></div>

            <div class="col-md-12"><textarea id="diagnosis_details" class="form-control @error('diagnosis_details') is-invalid @enderror" rows="7" name="diagnosis_details" placeholder="Enter Patient Diagnosis.Treatment Information" required style="resize:none">{{ old('diagnosis_details') }}</textarea></div>

            <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{ $userId }}" />
          </div>

          <div class="form-group row">
              <button class="col-md-12 btn btn-primary btn-md pull-right">Submit</button>
          </div>
        </form>
       </div>
     </div>
   </div>
 </div>
</div>
@endsection
