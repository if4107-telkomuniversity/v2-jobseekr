<?php

namespace App;

use Carbon\Carbon;
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
        'created_at',
    ];

    protected $hidden = [
        'updated_at',
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function category()
    {
        return $this->hasOne('App\JobCategory', 'id', 'category_id');
    }

    public function applicants()
    {
        return $this->hasMany('App\JobApplication');
    }

    protected function getJobTypeAttribute()
    {
        switch ($this->type) {
            case 'full_time':
                return 'Full time';
            case 'part_time':
                return 'Part time';
            case 'internship':
                return 'Internship';
            default:
                return 'Full time';
        }
    }

    public function getPostDateAttribute()
    {
        $date = Carbon::parse($this->created_at);
        return $date->format('d M Y');
    }

    public function getExpireDateAttribute()
    {
        $date = Carbon::parse($this->expired_at);
        return $date->format('d M Y');
    }

    public function getMinQualificationAttribute()
    {
        switch ($this->min_education) {
            case 'high_school':
                return 'High school';
            case 'diploma':
                return 'Diploma';
            case 'bachelor':
                return 'Bachelor';
            case 'master':
                return 'Master';
            case 'doctor':
                return 'Doctor';
            default:
                return 'Not specified';
        }
    }

    protected $appends = ['job_type', 'post_date', 'expire_date', 'min_qualification'];
}
