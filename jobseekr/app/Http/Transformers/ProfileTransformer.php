<?php

namespace App\Http\Transformers;
use App\Jobseeker;
use App\User;
use App\WorkExperience;
use Illuminate\Database\Eloquent\Collection;

class ProfileTransformer
{
	public static function jobseeker(User $user, Jobseeker $jobseeker, Collection $experiences)
	{

		return [
			'name' => $user->name,
		    'img_url' => $jobseeker->img_url,
		    'phone' => $user->phone,
		    'experience' => WorkExperienceTransformer::array($experiences)
		];
	}
}