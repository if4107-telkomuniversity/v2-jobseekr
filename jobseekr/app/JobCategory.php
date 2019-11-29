<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    protected $table = 'job_category';

    protected $fillable = ['name', 'is_deleted'];

    protected $hidden = ['created_at', 'updated_at'];

    public function jobs() {
    	return $this->hasMany('App\Job', 'category_id');
    }
}
