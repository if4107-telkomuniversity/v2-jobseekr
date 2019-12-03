<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Transformers\ProfileTransformer;
use App\Http\Transformers\JobTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class ApplyJobController extends Controller
{
    public function applyJob(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'summary' => 'required|string|max:200',
            'experiences' => 'required',
            'cv' => 'required|mimes:pdf|max:2048',
            'resume' => 'required|mimes:pdf|max:2048'
        ]);
        if ($validation->fails()) {
            return redirect()->back()
                ->withInput($request->all())->withErrors($validation);
        }
        $experiences = arrStringToArr($request->experiences);
        if (! validateExperiences($experiences)) {
            return redirect()->back()
                ->withInput($request->all())->withErrors([
                    'experiences' => 'Invalid work experience'
                ]);
        }
        if (! validateJob($id)) {
            return redirect()->back()
                ->withInput($request->all())->withErrors([
                    'job' => 'Job is unavailable'
                ]);
        }

        $options = ['user' => getLoggedinUser()];
        try {
            DB::beginTransaction();
            $jobApplication = submitApplication($id, $request, $options);
            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();
            return response()->json($e);
        }
        return response()->json($jobApplication);

    }
}
