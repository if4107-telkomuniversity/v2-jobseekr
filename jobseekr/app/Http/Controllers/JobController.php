<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class JobController extends Controller
{
	private $recruiterRole = 'recruiter';
	private $jobseekerRole = 'jobseeker';

    public function __construct()
    {
        $this->middleware('login:recruiter', [
            'only' => ['store', 'create', 'showJobDetail'],
        ]);
        $this->middleware('login:jobseeker', [
            'only' => ['search'],
        ]);
    }


    public function create(Request $request) {
    	$categories = indexJobCategory();
    	$data = [
    		'categories' => $categories
    	];
    	return view('test/recruiter/job/create', $data);
    }

    public function store(Request $request) {
        $validation = Validator::make($request->all(), [
        	'position' => 'required|string|max:191',
        	'summary' => 'required|string|max:65535',
        	'type' => 'required|in:internship,part_time,full_time',
	    	'min_education' => 'required|in:high_school,diploma,bachelor,master,doctor',
	    	'expired_at' => 'required|date',
	    	'salary' => 'required|min:0',
	    	'category' => 'required|exists:job_category,id',
        ]);
        if ($validation->fails()) {
        	dd($validation);
        	return redirect()->back()
                ->withInput($request->all())->withErrors($validation);
        }

        try {
        	DB::beginTransaction();
	        $job = newJob($request);
	        DB::commit();
        } catch (QueryException $e) {
        	DB::rollback();
            return redirect()->back()
                ->withInput($request->all())->withErrors([
                'general' => "Failed to save data: $e",
            ]);
        }
        return redirect('/recruiter/dashboard');
    }

    public function showJobDetail(Request $request, $id) {
    	try {
	    	$internalOnly = true;
	    	$job = showJob($id, $internalOnly);
    	} catch (ModelNotFoundException $e) {
    		return redirect('/recruiter/dashboard');
    	}
    	return response()->json($job);
    }

    public function search(Request $request) {
    	$validation = Validator::make($request->all(), [
            'q' => 'required'
        ]);
        if ($validation->fails()) {
            return redirect('/dashboard');
        }

        $jobs = searchJobFromDB($request->q);
        return response()->json($jobs);
    }
}
