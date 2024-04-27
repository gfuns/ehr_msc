<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});






















































































Auth::routes();

Route::get('/pa', [App\Http\Controllers\EHRController::class, 'notify_patient'])->name('pa');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/onboard-patients', [App\Http\Controllers\EHRController::class, 'show_patient_onboarding_form'])->name('onboard_patients');

Route::post('/process-patient-onboarding', [App\Http\Controllers\EHRController::class, 'onboard_patients'])->name('process_patient_onboarding');

Route::post('/addEmergencyContact', [App\Http\Controllers\EHRController::class, 'addEmergencyContact'])->name('addEmergencyContact');

Route::get('/removeEmergencyContact/{id}', [App\Http\Controllers\EHRController::class, 'removeEmergencyContact'])->name('removeEmergencyContact');

Route::get('/onboard-care-providers', [App\Http\Controllers\EHRController::class, 'show_care_provider_onboarding_form'])->name('onboard_care_providers');

Route::post('/process-care-provider-onboarding', [App\Http\Controllers\EHRController::class, 'onboard_care_providers'])->name('process_care_provider_onboarding');

Route::post('/addPersonalHealthRecord', [App\Http\Controllers\EHRController::class, 'addPersonalHealthRecord'])->name('addPersonalHealthRecord');

Route::post('/viewFile/{id}', [App\Http\Controllers\EHRController::class, 'viewFile'])->name('viewFile');

Route::get('/patientViewMedicalRecords', [App\Http\Controllers\EHRController::class, 'patientViewMedicalRecords'])->name('patientViewMedicalRecords');

Route::post('/add-patient-data', [App\Http\Controllers\EHRController::class, 'add_patient_data'])->name('add_patient_data');

Route::get('/addPatientData/{id}', [App\Http\Controllers\EHRController::class, 'show_care_provider_add_data_form'])->name('show_care_provider_add_data_form');

Route::post('/care-provider-store-patient-data', [App\Http\Controllers\EHRController::class, 'care_provider_store_patient_data'])->name('care_provider_store_patient_data');

Route::get('/viewPatientData/{id}', [App\Http\Controllers\EHRController::class, 'show_patient_health_record'])->name('show_patient_health_record');

Route::post('/view-patient-data', [App\Http\Controllers\EHRController::class, 'view_patient_data'])->name('view_patient_data');

Route::get('/request-file-access/{owner}/{requester}/{logid}/{type}', [App\Http\Controllers\EHRController::class, 'request_file_access'])->name('request_file_access');

Route::get('/approve-request/{id}', [App\Http\Controllers\EHRController::class, 'approve_request'])->name('approve_request');

Route::get('/decline-request/{id}', [App\Http\Controllers\EHRController::class, 'decline_request'])->name('decline_request');


// Route::get('/createFile', [App\Http\Controllers\EHRController::class, 'createFile'])->name('createFile');
