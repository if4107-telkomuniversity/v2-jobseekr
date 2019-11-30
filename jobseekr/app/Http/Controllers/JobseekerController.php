<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\User;
use App\Jobseeker;

class JobseekerController extends Controller
{
    private $roleName = 'jobseeker';

    public function __construct() {
    	$this->middleware('login:jobseeker', [
    		'except' => ['showAuthForm', 'register', 'login']
		]);
    }

    public function showAuthForm(Request $request) {
    	return view('test/jobseeker/auth');
    }

    public function register(Request $request) {
    	$validation = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:user,email,NULL,id,role,jobseeker',
            'password' => 'required|min:8|confirmed'
        ]);
        if ($validation->fails()) {
            return redirect()->back()
                ->withInput($request->all())->withErrors($validation);
        }

        try {
            DB::beginTransaction();
            $user = registerUser($request, $this->roleName);
            DB::commit();
        } catch(QueryException $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput($request->all())->withErrors([
                    'general' => "Failed to save data: $e"
            ]);
        }

        Auth::login($user);
        return redirect('/dashboard');
    }

    public function showDashboard(Request $request) {
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

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }

    public function showJobDetail(Request $request, $id) {
        try {
            $job = showJob($id);
        } catch (ModelNotFoundException $e) {
            return redirect('/dashboard');
        }
        return response()->json($job);
    }
}
