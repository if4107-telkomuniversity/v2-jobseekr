<?php

namespace App\Http\Transformers;
use App\WorkExperience;
use Illuminate\Database\Eloquent\Collection;

class WorkExperienceTransformer
{
	public static function transform(WorkExperience $experience)
	{
		return [
			'id' => $experience->id,
            'position' =>  $experience->position,
            'company' =>  $experience->company_name,
            'duration' =>  $experience->duration,
            'img_url' =>  '/img/company/default.png',
        ];
	}

	public static function array(Collection $experiences)
	{
		$transformer = new WorkExperienceTransformer();
		$_experiences = [];
		foreach ($experiences as $experience) {
			array_push($_experiences, $transformer->transform($experience));
		}
		return $_experiences;
	}
}