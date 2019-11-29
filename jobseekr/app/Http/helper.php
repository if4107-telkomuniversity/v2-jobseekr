<?php

use App\User;
use App\Jobseeker;
use App\Recruiter;

if (!function_exists('newBasicUser')) {
	function newBasicUser($request, $type) {
		return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $type
        ]);
	}
}

if (!function_exists('newBasicJobseeker')) {
	function newBasicJobseeker($request, $userId) {
		return Jobseeker::create([
            'user_id' => $userId
        ]);
	}
}

if (!function_exists('newBasicRecruiter')) {
	function newBasicRecruiter($request, $userId) {
		return Recruiter::create([
            'user_id' => $userId
        ]);
	}
}


if (!function_exists('registerUser')) {
	function registerUser($request, $type) {
		$user = newBasicUser($request, $type);
		if ($type == 'jobseeker') {
			newBasicJobseeker($request, $user->id);
			return $user;
		}
		newBasicRecruiter($request, $user->id);
		return $user;
	}
}