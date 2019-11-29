<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job';

    protected $fillable = [
    	'position',
    	'summary',
    	'employment_type',
    	'min_education',
    	'expire_date',
    	'salary',
    	'company_id',
    	'category_id',
    	'is_deleted',
    	'created_at'
    ];

    protected $hidden = [
    	'updated_at'
    ];

    protected function company() {
    	return $this->hasOne('App\Company');
    }

    protected function category() {
    	return $this->hasOne('App\JobCategory', 'category_id');
    }
}
