<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';

    protected $fillable = [
    	'name',
    	'address',
    	'city',
    	'website',
    	'about',
    	'industry_id',
    	'img_name',
    	'is_deleted'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function industry() {
    	return $this->hasOne('App\Industry');
    }

    public function jobs() {
    	return $this->hasMany('App\Job');
    }
}
