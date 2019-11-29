<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Cv;
use App\Industry;
use App\Job;
use App\JobApplication;
use App\JobCategory;
use App\Jobseeker;
use App\Recruiter;
use App\Resume;
use App\User;
use App\WorkExperience;

class ModelTestController extends Controller
{
    public function company(Request $request) {
    	
    }

	public function cv(Request $request) {
    	return response()->json(true);
    }

    public function industry(Request $request) {
    	return response()->json(true);
    }
    
    public function job(Request $request) {
    	return response()->json(true);
    }
    
    public function jobApplication(Request $request) {
    	return response()->json(true);
    }
    
    public function jobCategory(Request $request) {
    	return response()->json(true);
    }
    
    public function jobseeker(Request $request) {
    	return response()->json(true);
    }
    
    public function recruiter(Request $request) {
    	return response()->json(true);
    }
    
    public function resume(Request $request) {
    	return response()->json(true);
    }
    
    public function user(Request $request) {
    	return response()->json(true);
    }
    
    public function workExperience(Request $request) {
    	return response()->json(true);
    }
    
}
