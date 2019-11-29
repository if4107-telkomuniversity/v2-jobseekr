<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    protected $table = 'work_experience';

    protected $fillable = [
    	'user_id',
    	'company_id',
    	'company_name',
    	'position',
    	'start_date',
    	'end_date',
    	'is_deleted'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function user() {
    	return $this->hasOne('App\User');
    }

   	public function company() {
   		if (is_null($this->company_id)) {
   			return null;
   		}
   		return $this->hasOne('App\Company');
   	}

   	public function duration() {
   		return date_diff($this->start_date, $this->end_date);
   	}
}
