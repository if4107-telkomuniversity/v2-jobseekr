<?php

use App\Company;
use App\Jobseeker;
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
