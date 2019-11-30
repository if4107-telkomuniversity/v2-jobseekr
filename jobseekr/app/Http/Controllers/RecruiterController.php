<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class RecruiterController extends Controller
{
    private $roleName = 'recruiter';

    public function __construct()
    {
        $this->middleware('login:recruiter', [
            'except' => ['showAuthForm', 'register', 'login'],
        ]);
    }

    public function showAuthForm(Request $request)
    {
        $data = [
            'companies' => indexCompany(),
        ];
        return view('test/recruiter/auth', $data);
    }

    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'     => 'required|string|max:50',
            'email'    => 'required|email|unique:user,email,NULL,id,role,recruiter',
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
        $jobs = indexJob(['withApplicant' => true]);
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

    public function searchJob(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'q' => 'required'
        ]);
        if ($validation->fails()) {
            return redirect('/recruiter/dashboard');
        }

        $options = [
            'internalOnly' => true
        ];
        $jobs = searchJobFromDB($request->q, $options);
        return response()->json($jobs);
    }
}
