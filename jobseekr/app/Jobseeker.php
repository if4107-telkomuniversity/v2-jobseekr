<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobseeker extends Model
{
    protected $table = 'jobseeker';

    protected $fillable = ['address', 'summary', 'user_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function user() {
    	return $this->hasOne('App\User');
    }
}
