<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmittedExperience extends Model
{
    protected $table = 'submitted_experience';

    protected $fillable = [
    	'job_application_id',
    	'job_experience_id'
    ];

    public function object() {
    	return $this->belongsTo('App\WorkExperience', 'job_application_id');
    }
}
