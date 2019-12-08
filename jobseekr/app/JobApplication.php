<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
    	return $this->belongsTo('App\User');
    }

    public function job() {
    	return $this->hasOne('App\Job', 'id');
    }

    public function cv() {
    	return $this->belongsTo('App\Cv');
    }

    public function resume() {
    	return $this->belongsTo('App\Resume');
    }

    public function experiences() {
        return $this->hasMany('App\SubmittedExperience', 'job_application_id');
    }

    protected function getApplyDateAttribute() {
        $date = Carbon::parse($this->created_at);
        return $date->format('d M Y g:i A');
    }

    protected $appends = ['apply_date'];
}
