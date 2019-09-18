<?php

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


Route::get('jobseeker/auth', 'JobseekerController@showAuthForm')->name('authJobseeker');
Route::post('jobseeker/auth/login' , 'JobseekerController@login');
Route::post('jobseeker/auth/register', 'JobseekerController@register');

Route::get('jobseeker/dashboard', 'JobseekerController@showDashboard');
Route::get('jobseeker/{search}/search', 'JobseekerController@searchJob');

Route::get('jobseeker/job-apply', 'JobseekerController@showApplyJobForm');
Route::put('jobseeker/{id}/edit-about-profile', 'JobseekerController@editProfile');
Route::put('jobseeker/{id}/edit-summary', 'JobseekerController@editSummary');
Route::put('jobseeker/{id}/edit-work-experience', 'JobController@editWorkExp');
Route::put('jobseeker/{id}/{document}/edit-document', 'JobController@editDocument');
Route::post('jobseeker/job-apply', 'JobseekerController@applyJob');

Route::get('jobseeker/{id}/edit-profile', 'JobseekerController@showProfileForm');

Route::get('jobseeker/applications', 'JobseekerController@showApplications');

Route::get('job/{id}/profile', 'JobController@showJobProfile');


Route::get('recruiter/auth', 'RecruiterController@showAuthForm')->name('authRecruiter');
Route::post('recruiter/auth/login' , 'RecruiterController@login');
Route::post('recruiter/auth/register', 'RecruiterController@register');

Route::get('recruiter/dashboard', 'RecruiterController@showDashboard');
Route::get('recruiter/{search}/search', 'RecruiterController@searchJob');

Route::get('recruiter/{id}/edit-company-profile', 'RecruiterController@showCompanyProfile');
Route::put('recruiter/{id}/edit-about-company', 'RecruiterController@editCompanyProfile');
Route::put('recruiter/{id}/edit-summary-company', 'RecruiterController@editSummaryCompany');

Route::get('recruiter/{id}/job-details', 'RecruiterController@showJobDetails');

Route::get('recruiter/jobseeker-summary', 'RecruiterController@showJobseekerSummary');
Route::get('recruiter/{id}/jobseeker-details', 'RecruiterController@showJobseekerDetails');
Route::post('recruiter/{id}/jobseeker-acceptance', 'RecruiterController@acceptJobseeker');
Route::delete('recruiter/{id}/jobseeker-reject', 'RecruiterController@declineJobseeker');




