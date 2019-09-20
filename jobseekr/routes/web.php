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

Route::prefix('auth')->group(function(){
    Route::get('', 'JobseekerController@showAuthForm')->name('authJobseeker');
    Route::post('login' , 'JobseekerController@login');
    Route::post('register', 'JobseekerController@register');
    Route::post('logout', 'JobseekerController@logout');
});

Route::get('dashboard', 'JobseekerController@showDashboard');
Route::get('job/search', 'JobController@search');

Route::get('job-apply', 'JobseekerController@showApplicationForm');
Route::put('profile/about/edit', 'JobseekerController@updateProfile');
Route::put('summary/edit', 'JobseekerController@updateSummary');
Route::put('experience/edit', 'JobController@updateWorkExperience');
Route::put('document/edit/{document}', 'JobController@updateDocument');
Route::post('jobseeker/job/apply', 'JobseekerController@applyJob');

Route::get('jobseeker/edit-profile', 'JobseekerController@showProfileForm');

Route::get('jobseeker/application', 'JobseekerController@showApplication');

Route::get('job/profile', 'JobController@showJobProfile');

Route::prefix('recruiter')->group(function(){
    Route::prefix('auth')->group(function(){
        Route::get('', 'RecruiterController@showAuthForm')->name('authRecruiter');
        Route::post('login' , 'RecruiterController@login');
        Route::post('register', 'RecruiterController@register');
        Route::post('logout', 'RecruiterController@logout');
    });

    Route::get('dashboard', 'RecruiterController@showDashboard');
    Route::get('job/search', 'RecruiterController@searchJob');

    Route::get('company/profile/edit', 'CompanyController@showCompanyProfile');
    Route::put('company/about/edit', 'CompanyController@updateCompanyProfile');
    Route::put('company/summary/edit', 'CompanyController@updateSummaryCompany');

    Route::get('job-detail', 'JobController@showJobDetail');
    
    Route::get('application/{id}/confirm', 'JobApplicationController@showJobseekerDetail');
    Route::post('applicant/confirm', 'JobApplicationController@confirmationJobseeker');
});