<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Transformers\WorkExperienceTransformer;

class WorkExperienceController extends Controller
{
    public function __construct() {
    	$this->middleware('login:jobseeker');
    }

    public function store(Request $request) {
    	$validation = Validator::make($request->all(), [
	    	'company_name' => 'required|string|max:50',
	    	'position' => 'required|string|max:30',
	    	'start_date' => 'required|date_format:Y-m',
	    	'end_date' => 'required|date_format:Y-m',
        ]);
        if ($validation->fails()) {
        	return response()->json($validation->errors());
            return redirect()->back()
                ->withInput($request->all())->withErrors($validation);
        }

        $user = getLoggedinUser();
        try {
            DB::beginTransaction();
            addWorkExperience($request);
            $workExperiences = getWorkExperience($user->id);
            DB::commit();
        } catch(QueryException $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput($request->all())->withErrors([
                    'general' => "Failed to save data: $e"
            ]);
        }
        $data = WorkExperienceTransformer::array($workExperiences);
        // $data = [
        // 	'workExperiences' => $workExperiences
        // ];
        return response()->json($data);
    }
}
