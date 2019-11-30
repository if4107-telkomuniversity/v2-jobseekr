<?php

use App\Company;
use App\Job;
use App\Jobseeker;
use App\JobCategory;
use App\Recruiter;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

if (!function_exists('newBasicUser')) {
    function newBasicUser($request, $type)
    {
        return User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $type,
        ]);
    }
}

if (!function_exists('newBasicJobseeker')) {
    function newBasicJobseeker($request, $userId)
    {
        return Jobseeker::create([
            'user_id' => $userId,
        ]);
    }
}

if (!function_exists('newBasicRecruiter')) {
    function newBasicRecruiter($request, $userId)
    {
        return Recruiter::create([
            'user_id'    => $userId,
            'company_id' => $request->company,
        ]);
    }
}

if (!function_exists('registerUser')) {
    function registerUser($request, $type)
    {
        $user = newBasicUser($request, $type);
        if ($type == 'jobseeker') {
            newBasicJobseeker($request, $user->id);
            return $user;
        }
        newBasicRecruiter($request, $user->id);
        return $user;
    }
}

if (!function_exists('indexCompany')) {
    function indexCompany()
    {
        $companies = Company::where('is_deleted', false)->with('industry')->get();
        return $companies;
    }
}

if (!function_exists('authUser')) {
    function authUser($request, $role)
    {
        try {
            $user = User::where('email', $request->email)->where('role', $role)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return null;
        }
        if (!Hash::check($request->password, $user->password)) {
            return null;
        }
        return $user;
    }
}

if (!function_exists('indexJob')) {
    function indexJob($options = [])
    {
        $withCompany        = $options['withCompany'] ?? false;
        $withApplicant      = $options['withApplicant'] ?? false;
        $includeExpiredJobs = $options['includeExpiredJobs'] ?? false;

        $query = Job::where('expired_at', '>=', date('Y-m-d'));
        if ($withCompany) {
            $query = $query->with('company');
        }
        if ($withApplicant) {
            $query = $query->withCount('applicants');
        }
        return $query->get();
    }
}

if (!function_exists('newJob')) {
    function newJob($request)
    {
        $companyId = Recruiter::where('user_id', Auth::id())->first()->company_id;
        return Job::create([
            'position' => $request->position,
            'summary' => $request->summary,
            'type' => $request->type,
            'min_education' => $request->min_education,
            'expired_at' => $request->expired_at,
            'salary' => $request->salary,
            'company_id' => $companyId,
            'category_id' => $request->category
        ]);
    }
}

if (!function_exists('indexJobCategory')) {
    function indexJobCategory()
    {
        return JobCategory::where('is_deleted', false)->get();
    }
}
