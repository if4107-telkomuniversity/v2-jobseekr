<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = 'resume';

    protected $fillable = [
    	'user_id',
    	'title',
    	'file_name',
    	'is_deleted'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function user() {
    	return $this->hasOne('App\User');
    }

    // TODO
    // Add file() to get file directly
}
