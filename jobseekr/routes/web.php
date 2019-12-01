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

use App\User;

Route::get('check', function(Request $request) {
    dd(Auth::user());
});
Route::get('logout', function (Request $request) {
    Auth::logout();
});
Route::prefix('auth')->group(function() {
    Route::get('', 'JobseekerController@showAuthForm')->name('authJobseeker');
    Route::post('login' , 'JobseekerController@login');
    Route::post('register', 'JobseekerController@register');
    Route::post('logout', 'JobseekerController@logout');
});

Route::prefix('profile')->group(function() {
    Route::get('', 'JobseekerController@showProfileForm');
    Route::put('about', 'JobseekerController@updateProfile');
});

Route::get('dashboard', 'JobseekerController@showDashboard');
Route::put('summary', 'JobseekerController@updateSummary');
Route::prefix('experience')->group(function() {
    Route::post('', 'WorkExperienceController@store');
    Route::put('', 'WorkExperienceController@update');
});
Route::put('document/{document}', 'JobController@updateDocument');
Route::get('application', 'JobseekerController@showApplication');

Route::prefix('job')->group(function() {
    Route::get('search', 'JobController@search');
    Route::get('{id}', 'JobseekerController@showJobDetail');
    Route::get('{id}/apply', 'JobseekerController@showApplicationForm');
    Route::post('{id}/apply', 'JobseekerController@applyJob');
});

Route::prefix('recruiter')->group(function() {
    Route::prefix('auth')->group(function() {
        Route::get('', 'RecruiterController@showAuthForm')->name('authRecruiter');
        Route::post('login' , 'RecruiterController@login');
        Route::post('register', 'RecruiterController@register');
        Route::post('logout', 'RecruiterController@logout');
    });

    Route::prefix('job')->group(function() {
        Route::get('search', 'RecruiterController@searchJob');
        Route::get('new', 'JobController@create');
        Route::post('new', 'JobController@store');
        Route::get('{id}', 'JobController@showJobDetail');
    });

    Route::prefix('company')->group(function() {
        Route::get('profile', 'CompanyController@showCompanyProfile');
        Route::put('about', 'CompanyController@updateCompanyProfile');
        Route::put('summary', 'CompanyController@updateSummaryCompany');
    });

    Route::get('dashboard', 'RecruiterController@showDashboard');
    Route::get('application/{id}/confirm', 'JobApplicationController@showJobseekerDetail');
    Route::post('applicant/confirm', 'JobApplicationController@confirmationJobseeker');
});
