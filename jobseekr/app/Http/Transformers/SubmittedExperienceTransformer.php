<?php

namespace App\Http\Transformers;

class SubmittedExperienceTransformer
{
	public static function prepareBulkInsertion($workExperienceIds, $jobApplicationId)
	{
		return array_map(function ($experienceId) use ($jobApplicationId) {
            return [
                'job_application_id' => $jobApplicationId,
                'job_experience_id' => $experienceId,
                'created_at' => now()
            ];
        }, $workExperienceIds);
	}
}