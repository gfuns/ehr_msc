@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>{{ __('Create Your Care Provider Account') }}</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('process_care_provider_onboarding') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="physician_name" class="col-md-4 col-form-label text-md-right"><b>{{ __('Physician Name') }}</b></label>

                            <div class="col-md-6">
                                <input id="physician_name" type="text" class="form-control @error('physician_name') is-invalid @enderror" name="physician_name" value="{{ old('physician_name') }}" required placeholder="Enter Your Name" autofocus>

                                @error('physician_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="facility_name" class="col-md-4 col-form-label text-md-right"><b>{{ __('Name of Health Care Facility') }}</b></label>

                            <div class="col-md-6">
                                <input id="facility_name" type="text" class="form-control @error('facility_name') is-invalid @enderror" name="facility_name" value="{{ old('facility_name') }}" required placeholder="Enter Name of Your Health Care Facility">

                                @error('facility_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="facility_address" class="col-md-4 col-form-label text-md-right"><b>{{ __('Health Care Facility Address') }}</b></label>

                            <div class="col-md-6">
                                <textarea id="facility_address" type="text" class="form-control @error('facility_address') is-invalid @enderror" name="facility_address" required placeholder="Enter Address of Your Health Care Facility" style="resize:none">{{ old('facility_address') }}</textarea>
                               
                                @error('facility_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><b>{{ __('Password') }}</b></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Choose a Secure Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><b>{{ __('Confirm Password') }}</b></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm your password selection">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
