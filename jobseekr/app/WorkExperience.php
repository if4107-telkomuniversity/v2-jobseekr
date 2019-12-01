<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

   	public function getDurationAttribute() {
      $startDate = Carbon::parse($this->start_date);
      $endDate = Carbon::parse($this->end_date);
   		$dateDiff = $startDate->diff($endDate);
      return $dateDiff->format('%y year(s) %m month(s)');
   	}

    public function getStartDateAttribute() {
      return Carbon::parse($this->attributes['start_date'])->format('Y-m');
    }

    public function getEndDateAttribute() {
      return Carbon::parse($this->attributes['end_date'])->format('Y-m');
    }

    protected $appends = ['duration'];
}
