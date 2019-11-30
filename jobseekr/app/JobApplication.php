<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $table = 'job_application';

    protected $fillable = [
    	'user_id',
    	'job_id',
    	'summary',
    	'cv_id',
    	'resume_id',
    	'is_accepted',
    	'is_deleted'
    ];

    protected $hidden = ['updated_at'];

    public function user() {
    	return $this->hasOne('App\User');
    }

    public function job() {
    	return $this->hasOne('App\Job');
    }

    public function cv() {
    	return $this->hasOne('App\Cv');
    }

    public function resume() {
    	return $this->hasOne('App\Resume');
    }
}
