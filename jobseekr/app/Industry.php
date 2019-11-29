<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $table = 'Industry';

    protected $fillable = ['name', 'is_deleted'];

    protected $hidden = ['created_at', 'updated_at'];

    public function companies() {
    	return $this->hasMany('App\Company');
    }
}
