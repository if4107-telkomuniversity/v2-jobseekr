<?php

namespace App\Http\Transformers;
use App\Jobseeker;
use App\User;
use App\WorkExperience;
use Illuminate\Database\Eloquent\Collection;

class JobTransformer
{
	public static function apply(User $user, Jobseeker $jobseeker, Collection $experiences, $jobId)
	{
		$data = [
			'name' => $user->name,
		    'address' => $jobseeker->address,
		    'email' => $user->email,
		    'phone' => $user->phone,
		    'job_id' => $jobId,
			'img_url' => $jobseeker->img_url,
			'experience' => WorkExperienceTransformer::array($experiences)
		];
		return $data;
	}
}