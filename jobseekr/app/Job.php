<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job';

    protected $fillable = [
    	'position',
    	'summary',
    	'type',
    	'min_education',
    	'expired_at',
    	'salary',
    	'company_id',
    	'category_id',
    	'is_deleted',
    	'created_at'
    ];

    protected $hidden = [
    	'updated_at'
    ];

    public function company() {
    	return $this->hasOne('App\Company');
    }

    public function category() {
    	return $this->hasOne('App\JobCategory', 'category_id');
    }

    public function applicants() {
        return $this->hasMany('App\JobApplication');
    }
}
