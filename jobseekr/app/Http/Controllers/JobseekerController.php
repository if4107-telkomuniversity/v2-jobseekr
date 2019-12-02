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

class JobseekerController extends Controller
{
    private $roleName = 'jobseeker';

    public function __construct()
    {
        $this->middleware('login:jobseeker', [
            'except' => ['showAuthForm', 'register', 'login'],
        ]);
    }

    public function showAuthForm(Request $request)
    {
        return view('test/jobseeker/auth');
    }

    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'     => 'required|string|max:50',
            'email'    => 'required|email|unique:user,email,NULL,id,role,jobseeker',
            'password' => 'required|min:8|confirmed',
        ]);
        if ($validation->fails()) {
            return redirect()->back()
                ->withInput($request->all())->withErrors($validation);
        }

        try {
            DB::beginTransaction();
            $user = registerUser($request, $this->roleName);
            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput($request->all())->withErrors([
                'general' => "Failed to save data: $e",
            ]);
        }

        Auth::login($user);
        return redirect('/dashboard');
    }

    public function showDashboard(Request $request)
    {
        $jobs = indexJob(['withCompany' => true]);
        return response()->json($jobs);
    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        if ($validation->fails()) {
            return redirect()->back()
                ->withInput($request->all())->withErrors($validation);
        }

        $user = authUser($request, $this->roleName);
        if (is_null($user)) {
            return redirect()->back()
                ->withInput($request->all())->withErrors([
                'msg' => 'Invalid email/password',
            ]);
        }
        Auth::login($user);
        return redirect('/recruiter/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function showJobDetail(Request $request, $id)
    {
        try {
            $job = showJob($id);
        } catch (ModelNotFoundException $e) {
            return redirect('/dashboard');
        }
        return response()->json($job);
    }

    public function showProfileForm(Request $request)
    {
        $user            = getLoggedinUser();
        $userDetail      = getUserDetail($user->id, $user->role);
        $workExperiences = getWorkExperience($user->id);
        $data            = ProfileTransformer::jobseeker($user, $userDetail, $workExperiences);
        return response()->json($data);
    }

    public function showApplicationForm(Request $request, $id)
    {
        $validation = Validator::make(['jobId' => $id], [
            'jobId' => 'exists:job,id'
        ]);
        if ($validation->fails()) {
            return redirect('/dashboard')->withErrors($validation);
        }

        $user            = getLoggedinUser();
        $userDetail      = getUserDetail($user->id, $user->role);
        $workExperiences = getWorkExperience($user->id);
        $data            = JobTransformer::apply($user, $userDetail, $workExperiences, $id);
        return response()->json($data);
    }

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
