<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $table = 'cv';

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
