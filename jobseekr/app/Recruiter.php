<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    protected $table = 'recruiter';

    protected $fillable = ['user_id', 'company_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function user() {
    	return $this->hasOne('App\User');
    }

    public function company() {
    	return $this->belongsTo('App\Company');
    }
}
