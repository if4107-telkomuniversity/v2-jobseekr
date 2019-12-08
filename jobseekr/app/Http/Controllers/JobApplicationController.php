<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class JobApplicationController extends Controller
{
	private $roleName = 'recruiter';

    public function __construct()
    {
        $this->middleware('login:recruiter');
    }

    public function confirmationJobseeker(Request $request)
    {
    	$validation = Validator::make($request->all(), [
            'job_application_id' => 'required|exists:job_application,id',
            'is_accepted' => 'required|in:1,0'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        $user = getLoggedInUser();
        $recruiter = getUserDetail($user->id, $this->roleName);
        try {
        	DB::beginTransaction();
        	$jobApplication = getJobApplication($request->job_application_id);
        	if (!validateJobApplication($recruiter, $jobApplication)) {
        		return redirect()->back()->withErrors([
        			'job_application_id' => 'Job application is not available'
        		]);
        	}
        	confirmJobApplication($jobApplication, $request->is_accepted);
        	DB::commit();
        } catch (ModelNotFoundException $e) {
        	DB::rollback();
        	return redirect()->back()->withErrors([
        		'job_application_id' => 'Job application is not available'
        	]);
        } catch (QueryException $e) {
        	DB::rollback();
        	return redirect()->back()->withErrors([
        		'job_application_id' => 'Failed to confirm job. General failure: '. $e
        	]);
        }
        
        return redirect(sprintf('/recruiter/job/%s/applicants', $jobApplication->job_id));
    }

    public function showJobseekerDetail(Request $request, $id)
    {
        try {
            $application = getApplication($id);
            $applicant = getUserDetail($application->user->id, 'jobseeker');
        } catch (ModelNotFoundException $e) {
            return redirect()->back();
        }
        $data = [
            'application' => $application,
            'applicant' => $applicant
        ];
        return view('recruiter/job/application', $data);
    }
}
